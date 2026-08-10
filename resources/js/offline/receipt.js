/**
 * Client-side thermal receipt.
 *
 * Mirrors resources/views/receipts/thermal-receipt.blade.php, which can't be
 * used offline because it's rendered by the server. Printing goes through the
 * browser's own dialog, so it reaches the same till printer the online receipt
 * does — and "Save as PDF" there works as a fallback.
 */

import { formatMoney } from './money';

/**
 * Falls back to English only if the page somehow failed to pass its
 * translations through — the real labels come from the server's lang files so
 * an Urdu shop's offline receipts match its online ones.
 */
const FALLBACK = {
    dir: 'ltr',
    lang: 'en',
    invoice: 'Invoice',
    date: 'Date',
    cashier: 'Cashier',
    customer: 'Customer',
    item: 'Item',
    qty: 'Qty',
    amount: 'Amount',
    total: 'Total',
    payment: 'Payment',
    walk_in: 'Walk-in Customer',
    print: 'Print',
    pending_sync: 'Recorded offline · pending sync',
    methods: { cash: 'Cash', bank: 'Bank Transfer', ledger: 'On Account' },
};

function escapeHtml(value) {
    return String(value ?? '').replace(
        /[&<>"']/g,
        (character) =>
            ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[character],
    );
}

export function buildReceiptHtml(sale, snapshot, translations = {}) {
    const settings = snapshot.settings;
    const receipt = settings.receipt;
    const width = receipt.paper_width === '58mm' ? '58mm' : '80mm';
    const customer = snapshot.customers.find((entry) => entry.id === sale.customer_id);
    const t = { ...FALLBACK, ...translations, methods: { ...FALLBACK.methods, ...(translations.methods ?? {}) } };
    // Urdu needs the Nastaliq face and RTL, exactly as the server-rendered
    // receipt does — an offline receipt must not silently come out in English.
    const fontStack =
        t.lang === 'ur'
            ? "'Noto Nastaliq Urdu', 'Noto Sans Arabic', Arial, sans-serif"
            : 'Arial, Helvetica, sans-serif';

    const itemRows = sale.display.lines
        .map(
            (line) => `
                <tr>
                    <td>${escapeHtml(line.product_name)}</td>
                    <td class="text-end">${escapeHtml(line.quantity)}</td>
                    <td class="text-end">${escapeHtml(formatMoney(line.line_total))}</td>
                </tr>`,
        )
        .join('');

    const paymentRows = sale.payment_lines
        .map(
            (line) => `
                <div class="totals-row">
                    <span>${escapeHtml(t.methods[line.method] ?? line.method)}</span>
                    <span>${escapeHtml(formatMoney(line.amount))}</span>
                </div>`,
        )
        .join('');

    return `<!DOCTYPE html>
<html lang="${escapeHtml(t.lang)}" dir="${escapeHtml(t.dir)}">
<head>
<meta charset="utf-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@500;700&family=Noto+Sans+Arabic:wght@500;700&display=swap" rel="stylesheet">
<title>${escapeHtml(t.title ?? 'Receipt')} — ${escapeHtml(sale.invoice_number)}</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: ${fontStack}; color: #000; background: #e5e5e5; display: flex; justify-content: center; padding: 16px; }
    .receipt { width: ${width}; background: #fff; padding: 8px; font-size: 12px; line-height: 1.4; }
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
    .offline-note { margin-top: 6px; font-size: 10px; }
    .print-bar { margin-top: 16px; text-align: center; }
    @media print { body { background: #fff; padding: 0; } .receipt { width: 100%; } .print-bar { display: none; } }
</style>
</head>
<body>
<div>
    <div class="receipt">
        <div class="center">
            ${receipt.show_logo && settings.logo_url ? `<img class="logo" src="${escapeHtml(settings.logo_url)}" alt="">` : ''}
            <div class="shop-name">${escapeHtml(settings.shop_name)}</div>
            ${receipt.header_text ? `<div class="footer-text">${escapeHtml(receipt.header_text)}</div>` : ''}
        </div>
        <div class="divider"></div>
        <div>
            <div>${escapeHtml(t.invoice)}: ${escapeHtml(sale.invoice_number)}</div>
            <div>${escapeHtml(t.date)}: ${escapeHtml(new Date(sale.occurred_at).toLocaleString(t.lang === 'ur' ? 'ur-PK' : undefined))}</div>
            <div>${escapeHtml(t.cashier)}: ${escapeHtml(snapshot.user.name)}</div>
            <div>${escapeHtml(t.customer)}: ${escapeHtml(customer?.name ?? t.walk_in)}</div>
        </div>
        <div class="divider"></div>
        <table>
            <thead><tr><th>${escapeHtml(t.item)}</th><th class="text-end">${escapeHtml(t.qty)}</th><th class="text-end">${escapeHtml(t.amount)}</th></tr></thead>
            <tbody>${itemRows}</tbody>
        </table>
        <div class="divider"></div>
        <div class="totals-row grand-total">
            <span>${escapeHtml(t.total)}</span><span>${escapeHtml(formatMoney(sale.total_amount))}</span>
        </div>
        <div class="divider"></div>
        <div>
            <div style="font-weight:700;">${escapeHtml(t.payment)}</div>
            ${paymentRows}
        </div>
        ${receipt.footer_text ? `<div class="divider"></div><div class="center footer-text">${escapeHtml(receipt.footer_text)}</div>` : ''}
        <div class="center offline-note">${escapeHtml(t.pending_sync)}</div>
    </div>
    <div class="print-bar"><button onclick="window.print()">${escapeHtml(t.print)}</button></div>
</div>
</body>
</html>`;
}

/**
 * Opened in a new window rather than printed straight from the till page, so
 * the cashier keeps their cart on screen and can reprint without losing it.
 */
export function printReceipt(sale, snapshot, translations = {}) {
    const printWindow = window.open('', '_blank');

    if (!printWindow) {
        return false;
    }

    printWindow.document.write(buildReceiptHtml(sale, snapshot, translations));
    printWindow.document.close();

    return true;
}
