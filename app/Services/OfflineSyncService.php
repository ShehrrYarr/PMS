<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvalidSaleItemException;
use App\Exceptions\InvalidSalePaymentException;
use App\Exceptions\UnbalancedPaymentSplitException;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\HeldOrder;
use App\Models\PosDevice;
use App\Models\Sale;
use App\Models\SaleSyncConflict;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Replays sales that were rung up while the till had no connection.
 *
 * The governing rule is that a queued sale is never silently dropped: the
 * customer already paid and walked out with the goods, so losing the money
 * record is worse than any stock discrepancy that replaying it causes. A sale
 * that oversells its batch is still written, the batch is allowed to go
 * negative (which self-corrects when the next purchase of that batch lands),
 * and a SaleSyncConflict row is raised so an admin sees it.
 */
class OfflineSyncService
{
    public function __construct(private readonly SaleService $saleService) {}

    /**
     * @param  list<array<string, mixed>>  $queuedSales
     * @return list<array<string, mixed>> One result per queued sale, keyed back to its
     *                                    client_uuid so the till clears only what the
     *                                    server actually confirmed.
     */
    public function syncSales(array $queuedSales, User $user, PosDevice $device): array
    {
        // Replay in the order the sales were actually made. Ledger running
        // balances are chained by insert order, so an out-of-order batch
        // would still end on the right total but leave a statement that
        // reads backwards.
        usort($queuedSales, fn (array $a, array $b) => strcmp(
            (string) ($a['occurred_at'] ?? ''),
            (string) ($b['occurred_at'] ?? ''),
        ));

        $results = [];

        foreach ($queuedSales as $queued) {
            $results[] = $this->syncOne($queued, $user, $device);
        }

        return $results;
    }

    /**
     * @param  array<string, mixed>  $queued
     * @return array<string, mixed>
     */
    private function syncOne(array $queued, User $user, PosDevice $device): array
    {
        $clientUuid = (string) ($queued['client_uuid'] ?? '');

        if ($clientUuid === '') {
            return ['client_uuid' => null, 'status' => 'rejected', 'message' => 'Missing client_uuid.'];
        }

        try {
            return DB::transaction(function () use ($queued, $clientUuid, $user, $device) {
                // Idempotency check lives INSIDE the transaction: outside it,
                // two concurrent syncs of the same queue (a double-clicked
                // Sync, or two tabs) could both pass it and race to insert.
                $existing = Sale::query()->where('client_uuid', $clientUuid)->first();

                if ($existing !== null) {
                    return [
                        'client_uuid' => $clientUuid,
                        'status' => 'duplicate',
                        'sale_id' => $existing->id,
                        'invoice_number' => $existing->invoice_number,
                    ];
                }

                /** @var list<array{batch_id: int, quantity: string, unit_price: string, discount_type?: ?string, discount_value?: ?string}> $items */
                $items = $queued['items'] ?? [];

                $shortfalls = $this->detectShortfalls($items);
                $invoiceNumber = $this->resolveInvoiceNumber($queued, $device);
                $occurredAt = $this->resolveOccurredAt($queued);
                $customer = $this->resolveCustomer($queued);
                $seller = $this->resolveSeller($queued, $user);

                $sale = $this->saleService->create(
                    customer: $customer,
                    items: $items,
                    paymentLines: $queued['payment_lines'] ?? [],
                    user: $seller,
                    photo: null,
                    clientUuid: $clientUuid,
                    invoiceNumber: $invoiceNumber,
                    occurredAt: $occurredAt,
                    allowOverdraw: true,
                    discountType: $queued['discount_type'] ?? null,
                    discountValue: $queued['discount_value'] ?? null,
                );

                foreach ($shortfalls as $shortfall) {
                    SaleSyncConflict::query()->create([
                        'shop_id' => $seller->shop_id,
                        'sale_id' => $sale->id,
                        'batch_id' => $shortfall['batch_id'],
                        'requested_quantity' => $shortfall['requested'],
                        'available_quantity' => $shortfall['available'],
                        'shortfall' => $shortfall['shortfall'],
                    ]);
                }

                return [
                    'client_uuid' => $clientUuid,
                    'status' => 'synced',
                    'sale_id' => $sale->id,
                    'invoice_number' => $sale->invoice_number,
                    'had_conflict' => $shortfalls !== [],
                ];
            });
        } catch (UniqueConstraintViolationException) {
            // Lost a race with a concurrent sync of the same queue. The other
            // request created the sale, so this is a duplicate, not a failure.
            $existing = Sale::query()->where('client_uuid', $clientUuid)->first();

            return [
                'client_uuid' => $clientUuid,
                'status' => 'duplicate',
                'sale_id' => $existing?->id,
                'invoice_number' => $existing?->invoice_number,
            ];
        } catch (InsufficientStockException|InvalidSaleItemException|InvalidSalePaymentException|UnbalancedPaymentSplitException $e) {
            // Our own domain exceptions carry messages written for a human,
            // so these are safe (and useful) to show at the till.
            return [
                'client_uuid' => $clientUuid,
                'status' => 'rejected',
                'message' => $e->getMessage(),
            ];
        } catch (Throwable $e) {
            // Anything else — a QueryException, a missing batch — would leak
            // schema details or a stack-trace-flavoured string to the cashier.
            // Log the detail, return something they can act on.
            Log::error('Offline sale replay failed', [
                'client_uuid' => $clientUuid,
                'exception' => $e,
            ]);

            return [
                'client_uuid' => $clientUuid,
                'status' => 'rejected',
                'message' => __('sync.replay_failed'),
            ];
        }
    }

    /**
     * Compares each line against live stock BEFORE the sale is written, since
     * afterwards the batch has already been decremented.
     *
     * @param  list<array{batch_id: int, quantity: string, unit_price: string}>  $items
     * @return list<array{batch_id: int, requested: string, available: string, shortfall: string}>
     */
    private function detectShortfalls(array $items): array
    {
        $shortfalls = [];

        foreach ($items as $item) {
            $batch = Batch::query()->find($item['batch_id']);

            if ($batch === null) {
                continue;
            }

            $available = (string) $batch->quantity_remaining;
            $requested = (string) $item['quantity'];

            if (bccomp($requested, $available, 2) > 0) {
                $shortfalls[] = [
                    'batch_id' => $batch->id,
                    'requested' => $requested,
                    'available' => $available,
                    'shortfall' => bcsub($requested, $available, 2),
                ];
            }
        }

        return $shortfalls;
    }

    /**
     * The till prints its own number and we keep it, so the paper the
     * customer walked out with always matches the system. The exception is a
     * sequence at or below what this device has already used — which happens
     * when browser storage is cleared and the local counter restarts — where
     * we mint the next free number instead of letting a unique-constraint
     * violation fail the sale.
     *
     * @param  array<string, mixed>  $queued
     */
    private function resolveInvoiceNumber(array $queued, PosDevice $device): string
    {
        // Lock the device row for the rest of this transaction. Without it two
        // parallel syncs each read the same counter and the slower one writes
        // back a LOWER value — after which a queued sale can format a number
        // that already exists and then fail the unique index identically on
        // every retry, stranding a paid sale forever.
        $locked = PosDevice::query()->lockForUpdate()->findOrFail($device->id);

        $sequence = (int) ($queued['invoice_seq'] ?? 0);

        if ($sequence <= $locked->last_invoice_seq) {
            $sequence = $locked->last_invoice_seq + 1;
        }

        $locked->forceFill(['last_invoice_seq' => $sequence])->save();

        // Keep the caller's instance in step so the response reports the
        // sequence that was actually consumed.
        $device->setAttribute('last_invoice_seq', $sequence);

        return $locked->formatInvoiceNumber($sequence);
    }

    /**
     * How far back a queued sale may claim to have happened.
     *
     * Deliberately generous — a shop could be off the network for weeks — but
     * bounded, so a till with a badly wrong clock can't drop a sale into a
     * long-closed accounting period. Device registration time is NOT used as
     * the floor: a device that re-registers (its stored id no longer
     * recognised) would then have every genuinely older queued sale silently
     * dragged forward to the moment it re-registered.
     */
    private const MAX_BACKDATE_DAYS = 90;

    /**
     * @param  array<string, mixed>  $queued
     */
    private function resolveOccurredAt(array $queued): CarbonImmutable
    {
        $raw = $queued['occurred_at'] ?? null;
        $now = CarbonImmutable::now();

        if (! is_string($raw) || $raw === '') {
            return $now;
        }

        try {
            $occurredAt = CarbonImmutable::parse($raw);
        } catch (Throwable) {
            return $now;
        }

        return $occurredAt
            ->max($now->subDays(self::MAX_BACKDATE_DAYS))
            ->min($now);
    }

    /**
     * @param  array<string, mixed>  $queued
     */
    private function resolveCustomer(array $queued): ?Customer
    {
        $customerId = $queued['customer_id'] ?? null;

        // The global shop scope means a customer id belonging to another
        // tenant simply won't be found here, so a tampered queue can't
        // attach a sale to someone else's customer.
        return $customerId !== null
            ? Customer::query()->findOrFail((int) $customerId)
            : null;
    }

    /**
     * Attributes the sale to the cashier who actually made it, not whoever
     * happens to be syncing — but only after confirming that user belongs to
     * the same shop.
     *
     * @param  array<string, mixed>  $queued
     */
    private function resolveSeller(array $queued, User $user): User
    {
        $sellerId = $queued['user_id'] ?? null;

        if ($sellerId === null || (int) $sellerId === $user->id) {
            return $user;
        }

        $seller = User::query()
            ->where('id', (int) $sellerId)
            ->where('shop_id', $user->shop_id)
            ->first();

        return $seller ?? $user;
    }

    /**
     * Merges held orders, treating the till's list as authoritative for its
     * own user.
     *
     * The till sends everything it currently holds, so anything the server has
     * that the till does NOT is an order that was resumed or discarded offline
     * and must be deleted. Only creating would resurrect a parked cart that
     * has already been sold, letting the cashier ring it a second time.
     *
     * @param  list<array<string, mixed>>  $heldOrders
     * @return list<array<string, mixed>>
     */
    public function syncHeldOrders(array $heldOrders, User $user): array
    {
        $seen = [];

        foreach ($heldOrders as $held) {
            $clientUuid = (string) ($held['client_uuid'] ?? '');

            if ($clientUuid === '') {
                continue;
            }

            $seen[] = $clientUuid;

            HeldOrder::query()->updateOrCreate(
                ['client_uuid' => $clientUuid, 'user_id' => $user->id],
                [
                    'shop_id' => $user->shop_id,
                    'label' => $held['label'] ?? null,
                    'payload' => $held['payload'] ?? [],
                ],
            );
        }

        HeldOrder::query()
            ->where('user_id', $user->id)
            ->when($seen !== [], fn ($query) => $query->whereNotIn('client_uuid', $seen))
            ->delete();

        return HeldOrder::query()
            ->where('user_id', $user->id)
            ->latest('id')
            ->get()
            ->map(fn (HeldOrder $order) => [
                'id' => $order->id,
                'client_uuid' => $order->client_uuid,
                'label' => $order->label,
                'payload' => $order->payload,
                'updated_at' => $order->updated_at?->toIso8601String(),
            ])
            ->values()
            ->all();
    }
}
