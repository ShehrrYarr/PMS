<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PayableType;
use App\Models\Payment;
use App\Models\ReceiptSetting;
use App\Models\Sale;
use App\Models\ThemeSetting;
use Illuminate\Contracts\View\View;

/**
 * Resolves a sale plus the shop's current receipt_settings/theme_settings
 * into the printable thermal receipt view (see prd.md §2.6, design.md §4.4).
 */
class ReceiptRenderService
{
    public function render(Sale $sale): View
    {
        $sale->loadMissing(['items.batch.product', 'customer', 'user']);

        $payments = Payment::query()
            ->where('payable_type', PayableType::Sale->value)
            ->where('payable_id', $sale->id)
            ->get();

        return view('receipts.thermal-receipt', [
            'sale' => $sale,
            'payments' => $payments,
            'receiptSettings' => ReceiptSetting::current(),
            'themeSettings' => ThemeSetting::current(),
        ]);
    }
}
