<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\PosDevice;
use App\Services\OfflineSyncService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Receives a till's queued offline sales and held orders.
 *
 * Every queued sale comes back with its own result keyed by client_uuid. The
 * till clears only the entries explicitly acknowledged here — never the whole
 * queue on a "looks like it worked" response — so a partial failure strands
 * nothing.
 */
class SyncController extends Controller
{
    public function __invoke(Request $request, OfflineSyncService $offlineSyncService): JsonResponse
    {
        $validated = $request->validate([
            'device_id' => ['required', 'integer'],

            'sales' => ['present', 'array'],
            'sales.*.client_uuid' => ['required', 'uuid'],
            'sales.*.occurred_at' => ['required', 'date'],
            'sales.*.invoice_seq' => ['required', 'integer', 'min:1'],
            'sales.*.customer_id' => ['nullable', 'integer'],
            'sales.*.user_id' => ['nullable', 'integer'],
            'sales.*.items' => ['required', 'array', 'min:1'],
            'sales.*.items.*.batch_id' => ['required', 'integer'],
            'sales.*.items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'sales.*.items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'sales.*.payment_lines' => ['required', 'array', 'min:1'],
            'sales.*.payment_lines.*.method' => ['required', 'in:cash,bank,ledger'],
            'sales.*.payment_lines.*.amount' => ['required', 'numeric', 'min:0.01'],
            'sales.*.payment_lines.*.bank_id' => ['nullable', 'integer'],

            'held_orders' => ['present', 'array'],
            'held_orders.*.client_uuid' => ['required', 'uuid'],
            'held_orders.*.label' => ['nullable', 'string', 'max:255'],
            'held_orders.*.payload' => ['required', 'array'],
        ]);

        $user = $request->user();

        $device = PosDevice::query()
            ->where('id', $validated['device_id'])
            ->where('shop_id', $user->shop_id)
            ->firstOrFail();

        $results = $offlineSyncService->syncSales($validated['sales'], $user, $device);
        $heldOrders = $offlineSyncService->syncHeldOrders($validated['held_orders'], $user);

        $device->forceFill(['last_synced_at' => now()])->save();

        return response()->json([
            'ok' => true,
            'results' => $results,
            'held_orders' => $heldOrders,
            'next_invoice_seq' => $device->fresh()->last_invoice_seq + 1,
            'synced_at' => now()->toIso8601String(),
        ]);
    }
}
