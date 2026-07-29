<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ __('batches.label') }} — {{ $batch->barcode }}</title>
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: Arial, Helvetica, sans-serif;
                color: #000;
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                padding: 16px;
            }
            .label {
                width: 320px;
                border: 1px solid #000;
                border-radius: 4px;
                padding: 12px;
                text-align: center;
            }
            .product-name { font-size: 16px; font-weight: 700; margin-bottom: 4px; }
            .meta { font-size: 12px; margin-bottom: 8px; }
            .barcode-svg { margin: 8px 0; }
            .print-button { margin-top: 16px; text-align: center; }
            @media print {
                .print-button { display: none; }
                body { padding: 0; }
                .label { border: none; }
            }
        </style>
    </head>
    <body>
        <div>
            <div class="label">
                <div class="product-name">{{ $batch->product->name }}</div>
                <div class="meta">
                    {{ __('batches.manufacturing_date') }}: {{ $batch->manufacturing_date->format('Y-m-d') }}<br>
                    {{ __('batches.expiry_date') }}: {{ $batch->expiry_date->format('Y-m-d') }}
                </div>
                <div class="barcode-svg">{!! $barcodeSvg !!}</div>
            </div>
            <div class="print-button">
                <button onclick="window.print()">{{ __('batches.print') }}</button>
            </div>
        </div>
    </body>
</html>
