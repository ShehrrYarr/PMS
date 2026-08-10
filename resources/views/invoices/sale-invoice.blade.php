<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ __('invoice.title') }} — {{ $sale->invoice_number }}</title>
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: 'DejaVu Sans', Arial, Helvetica, sans-serif;
                color: #1a202c;
                font-size: 12px;
                line-height: 1.5;
            }
            .header {
                width: 100%;
                border-bottom: 2px solid #1a202c;
                padding-bottom: 12px;
                margin-bottom: 20px;
            }
            .header td { vertical-align: top; }
            .logo { max-width: 140px; max-height: 70px; }
            .shop-name { font-size: 18px; font-weight: bold; }
            .shop-meta { font-size: 10px; color: #4a5568; white-space: pre-line; margin-top: 4px; }
            .invoice-title { font-size: 24px; font-weight: bold; text-align: right; }
            .invoice-meta { font-size: 11px; color: #4a5568; text-align: right; margin-top: 6px; }
            .section-title { font-size: 10px; font-weight: bold; text-transform: uppercase; color: #718096; margin-bottom: 4px; }
            .bill-to { margin-bottom: 20px; }
            table.items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            table.items th {
                text-align: left;
                font-size: 10px;
                text-transform: uppercase;
                color: #718096;
                border-bottom: 1px solid #cbd5e0;
                padding: 6px 8px;
            }
            table.items td {
                padding: 8px;
                border-bottom: 1px solid #edf2f7;
            }
            .text-end { text-align: right; }
            .totals-table { width: 260px; margin-left: auto; }
            .totals-table td { padding: 4px 8px; }
            .grand-total-row td { font-size: 14px; font-weight: bold; border-top: 2px solid #1a202c; padding-top: 8px; }
            .payments { margin-top: 20px; }
            .footer { margin-top: 30px; padding-top: 12px; border-top: 1px dashed #cbd5e0; font-size: 10px; color: #718096; white-space: pre-line; text-align: center; }
        </style>
    </head>
    <body>
        <table class="header">
            <tr>
                <td style="width: 55%;">
                    @if ($receiptSettings->show_logo && $themeSettings->logo_path)
                        <img class="logo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->path($themeSettings->logo_path) }}" alt="{{ $themeSettings->displayName() }}">
                    @endif
                    <div class="shop-name">{{ $themeSettings->displayName() }}</div>
                    @if ($receiptSettings->header_text)
                        <div class="shop-meta">{{ $receiptSettings->header_text }}</div>
                    @endif
                </td>
                <td style="width: 45%;">
                    <div class="invoice-title">{{ __('invoice.title') }}</div>
                    <div class="invoice-meta">
                        {{ __('invoice.invoice_number') }}: {{ $sale->invoice_number }}<br>
                        {{ __('invoice.date') }}: {{ $sale->created_at->format('d M Y') }}<br>
                        {{ __('invoice.served_by') }}: {{ $sale->user->name }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="bill-to">
            <div class="section-title">{{ __('invoice.bill_to') }}</div>
            <div>{{ $sale->customer->name ?? __('invoice.walk_in') }}</div>
            @if ($sale->customer?->phone)
                <div>{{ $sale->customer->phone }}</div>
            @endif
            @if ($sale->customer?->address)
                <div>{{ $sale->customer->address }}</div>
            @endif
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>{{ __('invoice.item') }}</th>
                    <th class="text-end">{{ __('invoice.quantity') }}</th>
                    <th class="text-end">{{ __('invoice.unit_price') }}</th>
                    <th class="text-end">{{ __('invoice.line_total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                    <tr>
                        <td>{{ $item->batch->product->name }}</td>
                        <td class="text-end">{{ number_format((float) $item->quantity, 0) }}</td>
                        <td class="text-end">{{ money($item->unit_price) }}</td>
                        <td class="text-end">{{ money($item->line_total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            @if (bccomp($sale->totalDiscountAmount(), '0', 2) > 0)
                <tr>
                    <td>{{ __('invoice.subtotal') }}</td>
                    <td class="text-end">{{ money($sale->subtotalBeforeDiscount()) }}</td>
                </tr>
                <tr>
                    <td>{{ __('invoice.discount') }}</td>
                    <td class="text-end">-{{ money($sale->totalDiscountAmount()) }}</td>
                </tr>
            @endif
            <tr class="grand-total-row">
                <td>{{ __('invoice.total') }}</td>
                <td class="text-end">{{ money($sale->total_amount) }}</td>
            </tr>
        </table>

        <div class="payments">
            <div class="section-title">{{ __('invoice.payment') }}</div>
            <table class="totals-table" style="margin-left: 0;">
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ __('ledger.'.$payment->method->value) }}</td>
                        <td class="text-end">{{ money($payment->amount) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if ($receiptSettings->footer_text)
            <div class="footer">{{ $receiptSettings->footer_text }}</div>
        @endif
    </body>
</html>
