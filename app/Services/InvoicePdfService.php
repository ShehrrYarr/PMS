<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PayableType;
use App\Models\Payment;
use App\Models\ReceiptSetting;
use App\Models\Sale;
use App\Models\ThemeSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\Response;

/**
 * Renders a formal A4 invoice for a sale — distinct from ReceiptRenderService's
 * thermal (58mm/80mm) POS receipt, which stays print-in-browser only. This
 * produces an actual downloadable PDF file, for a customer's own records or
 * accounting rather than a till printout.
 */
class InvoicePdfService
{
    public function download(Sale $sale): Response
    {
        $sale->loadMissing(['items.batch.product', 'customer', 'user']);

        $payments = Payment::query()
            ->where('payable_type', PayableType::Sale->value)
            ->where('payable_id', $sale->id)
            ->get();

        $pdf = Pdf::loadView('invoices.sale-invoice', [
            'sale' => $sale,
            'payments' => $payments,
            'themeSettings' => ThemeSetting::current(),
            'receiptSettings' => ReceiptSetting::current(),
        ])->setPaper('a4');

        return $pdf->download("invoice-{$sale->invoice_number}.pdf");
    }
}
