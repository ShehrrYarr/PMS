<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Bank;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\PosDevice;
use App\Models\ReceiptSetting;
use App\Models\ThemeSetting;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

/**
 * Builds the snapshot a till downloads when it goes offline: everything the
 * client-side POS needs to ring up a sale with no server — stock, customers
 * and their balances, banks, and the branding used on printed receipts.
 *
 * Deliberately excludes anything the offline POS can't act on (vendors,
 * purchases, reports), both to keep the payload small and to keep the
 * blast radius small if a till is ever stolen.
 */
class OfflineDataService
{
    /**
     * @return array<string, mixed>
     */
    public function snapshotFor(User $user, PosDevice $device): array
    {
        return [
            'generated_at' => now()->toIso8601String(),
            'device' => [
                'id' => $device->id,
                // The till formats its own invoice numbers offline, but the
                // sequence itself is owned here — a browser that lost its
                // storage would otherwise restart at 1 and collide with
                // invoices it has already synced.
                'next_invoice_seq' => $device->last_invoice_seq + 1,
                'invoice_prefix' => sprintf('SL-OFF%d-', $device->id),
            ],
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
            ],
            'batches' => $this->batches(),
            'customers' => $this->customers(),
            'banks' => $this->banks(),
            'settings' => $this->settings(),
        ];
    }

    /**
     * Only batches that can actually be sold. A batch at or below zero is
     * omitted rather than sent with a zero count — the offline till has no
     * use for it and it would bloat the payload for a large catalogue.
     *
     * @return list<array<string, mixed>>
     */
    private function batches(): array
    {
        return Batch::query()
            ->with('product:id,name,default_sale_price,unit')
            ->where('quantity_remaining', '>', 0)
            ->whereHas('product', fn ($query) => $query->where('is_active', true))
            ->get()
            ->map(fn (Batch $batch) => [
                'id' => $batch->id,
                'barcode' => $batch->barcode,
                'product_name' => $batch->product->name,
                'unit' => $batch->product->unit,
                'unit_price' => (string) $batch->product->default_sale_price,
                'quantity_remaining' => (string) $batch->quantity_remaining,
                'expiry_date' => $batch->expiry_date->toDateString(),
            ])
            ->values()
            ->all();
    }

    /**
     * Balances are a point-in-time snapshot and go stale the moment anyone
     * records a payment elsewhere, which is why the offline UI stamps them
     * "as of <time>" and why the server always re-derives the real balance
     * on sync rather than trusting what comes back.
     *
     * @return list<array<string, mixed>>
     */
    private function customers(): array
    {
        // Balances come from a correlated subquery rather than calling
        // currentBalance() per row. That accessor issues its own query, so a
        // shop with 2,000 customers would fire 2,001 queries here — on every
        // "Go Offline" AND every background refresh, for every prepared till.
        $latestBalance = CustomerLedger::query()
            ->selectRaw('running_balance')
            ->whereColumn('customer_ledgers.customer_id', 'customers.id')
            ->latest('id')
            ->limit(1);

        return Customer::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->select(['id', 'name', 'phone'])
            ->selectSub($latestBalance, 'ledger_balance')
            ->get()
            ->map(fn (Customer $customer) => [
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                // Mirrors Customer::currentBalance()'s own default.
                'balance' => (string) ($customer->getAttribute('ledger_balance') ?? '0.00'),
            ])
            ->values()
            ->all();
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function banks(): array
    {
        return Bank::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (Bank $bank) => ['id' => $bank->id, 'name' => $bank->name])
            ->values()
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    private function settings(): array
    {
        $theme = ThemeSetting::current();
        $receipt = ReceiptSetting::current();

        return [
            'shop_name' => $theme->displayName(),
            'logo_url' => $theme->logo_path !== null
                ? Storage::disk('public')->url($theme->logo_path)
                : null,
            // The offline shell is a standalone document and can't include
            // layouts/partials/head.blade.php (which is what normally injects
            // these), so the branding travels with the snapshot instead.
            // Without it a blue-branded shop turns default green the moment it
            // goes offline, and the shop's font-size setting is ignored.
            'theme' => [
                'navbar_primary_color' => $theme->navbar_primary_color,
                'navbar_accent_color' => $theme->navbar_accent_color,
                'sidebar_primary_color' => $theme->sidebar_primary_color,
                'sidebar_accent_color' => $theme->sidebar_accent_color,
                'font_size_percent' => $theme->font_size_percent,
                'locale' => $theme->default_locale,
            ],
            'receipt' => [
                'header_text' => $receipt->header_text,
                'footer_text' => $receipt->footer_text,
                'show_logo' => $receipt->show_logo,
                'paper_width' => $receipt->paper_width,
            ],
        ];
    }
}
