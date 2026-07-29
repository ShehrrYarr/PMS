<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <title>{{ __('receipt.title') }} — {{ $sale->invoice_number }}</title>
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: 'Noto Sans Arabic', Arial, Helvetica, sans-serif;
                color: #000;
                background: #e5e5e5;
                display: flex;
                justify-content: center;
                padding: 16px;
            }
            .receipt {
                width: {{ $receiptSettings->paper_width === '58mm' ? '58mm' : '80mm' }};
                background: #fff;
                padding: 8px;
                font-size: 12px;
                line-height: 1.4;
            }
            .center { text-align: center; }
            .logo { max-width: 60%; max-height: 60px; margin: 0 auto 6px; display: block; }
            .shop-name { font-size: 15px; font-weight: 700; }
            .divider { border-top: 1px dashed #000; margin: 6px 0; }
            table { width: 100%; border-collapse: collapse; font-size: 11px; }
            th { text-align: start; border-bottom: 1px solid #000; padding-bottom: 2px; }
            td { padding: 2px 0; vertical-align: top; }
            .text-end { text-align: end; }
            .totals-row { display: flex; justify-content: space-between; font-size: 12px; }
            .grand-total { font-size: 14px; font-weight: 700; }
            .footer-text { white-space: pre-line; font-size: 11px; }
            .print-bar { margin-top: 16px; text-align: center; }
            @media print {
                body { background: #fff; padding: 0; }
                .receipt { width: 100%; }
                .print-bar { display: none; }
            }
        </style>
    </head>
    <body>
        <div>
            <div class="receipt" id="receipt">
                <div class="center">
                    @if ($receiptSettings->show_logo && $themeSettings->logo_path)
                        <img class="logo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($themeSettings->logo_path) }}" alt="{{ $themeSettings->displayName() }}">
                    @endif
                    <div class="shop-name">{{ $themeSettings->displayName() }}</div>
                    @if ($receiptSettings->header_text)
                        <div class="footer-text">{{ $receiptSettings->header_text }}</div>
                    @endif
                </div>

                <div class="divider"></div>

                <div>
                    <div>{{ __('receipt.invoice') }}: {{ $sale->invoice_number }}</div>
                    <div>{{ __('receipt.date') }}: {{ $sale->created_at->format('Y-m-d H:i') }}</div>
                    <div>{{ __('receipt.cashier') }}: {{ $sale->user->name }}</div>
                    <div>{{ __('receipt.customer') }}: {{ $sale->customer?->name ?? __('pos.walk_in') }}</div>
                </div>

                <div class="divider"></div>

                <table>
                    <thead>
                        <tr>
                            <th>{{ __('receipt.item') }}</th>
                            <th class="text-end">{{ __('receipt.qty') }}</th>
                            <th class="text-end">{{ __('receipt.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->items as $item)
                            <tr>
                                <td>{{ $item->batch->product->name }}</td>
                                <td class="text-end">{{ rtrim(rtrim(number_format((float) $item->quantity, 2), '0'), '.') }}</td>
                                <td class="text-end">{{ number_format((float) $item->line_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="divider"></div>

                <div class="totals-row grand-total">
                    <span>{{ __('receipt.total') }}</span>
                    <span>{{ number_format((float) $sale->total_amount, 2) }}</span>
                </div>

                <div class="divider"></div>

                <div>
                    <div style="font-weight:700;">{{ __('receipt.payment') }}</div>
                    @foreach ($payments as $payment)
                        <div class="totals-row">
                            <span>{{ __('ledger.'.$payment->method->value) }}</span>
                            <span>{{ number_format((float) $payment->amount, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                @if ($receiptSettings->footer_text)
                    <div class="divider"></div>
                    <div class="center footer-text">{{ $receiptSettings->footer_text }}</div>
                @endif
            </div>

            <div class="print-bar">
                <button onclick="window.print()">{{ __('batches.print') }}</button>
            </div>
        </div>
    </body>
</html>
