/**
 * Client-side A4 invoice PDF.
 *
 * Mirrors the layout of resources/views/invoices/sale-invoice.blade.php, which
 * is produced by dompdf on the server and therefore can't run in a browser.
 * jsPDF is bundled only into the offline till's own entry point so its weight
 * isn't paid on every page of the app.
 *
 * English-only, matching the server invoice, which likewise has no RTL
 * handling today.
 */

import { jsPDF } from 'jspdf';
import autoTable from 'jspdf-autotable';

import { compare, formatMoney } from './money';

const PAYMENT_LABELS = {
    cash: 'Cash',
    bank: 'Bank Transfer',
    ledger: 'On Account',
};

const INK = [26, 32, 44];
const MUTED = [113, 128, 150];

export function buildInvoicePdf(sale, snapshot) {
    const doc = new jsPDF({ unit: 'pt', format: 'a4' });
    const settings = snapshot.settings;
    const customer = snapshot.customers.find((entry) => entry.id === sale.customer_id);
    const marginX = 40;
    let cursorY = 48;

    doc.setTextColor(...INK);
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(16);
    doc.text(settings.shop_name ?? '', marginX, cursorY);

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(22);
    doc.text('INVOICE', 555, cursorY, { align: 'right' });

    cursorY += 16;

    if (settings.receipt.header_text) {
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(9);
        doc.setTextColor(...MUTED);
        doc.text(doc.splitTextToSize(settings.receipt.header_text, 260), marginX, cursorY);
    }

    doc.setFont('helvetica', 'normal');
    doc.setFontSize(10);
    doc.setTextColor(...MUTED);
    doc.text(
        [
            `Invoice #: ${sale.invoice_number}`,
            `Date: ${new Date(sale.occurred_at).toLocaleDateString()}`,
            `Served By: ${snapshot.user.name}`,
        ],
        555,
        cursorY,
        { align: 'right' },
    );

    cursorY += 46;

    doc.setDrawColor(...INK);
    doc.setLineWidth(1.5);
    doc.line(marginX, cursorY, 555, cursorY);
    cursorY += 22;

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(8);
    doc.setTextColor(...MUTED);
    doc.text('BILL TO', marginX, cursorY);
    cursorY += 14;

    doc.setFont('helvetica', 'normal');
    doc.setFontSize(11);
    doc.setTextColor(...INK);
    doc.text(customer?.name ?? 'Walk-in Customer', marginX, cursorY);

    if (customer?.phone) {
        cursorY += 14;
        doc.text(customer.phone, marginX, cursorY);
    }

    cursorY += 24;

    autoTable(doc, {
        startY: cursorY,
        margin: { left: marginX, right: 40 },
        head: [['Item', 'Quantity', 'Unit Price', 'Line Total']],
        body: sale.display.lines.map((line) => [
            line.product_name,
            line.quantity,
            formatMoney(line.unit_price),
            formatMoney(line.line_total),
        ]),
        styles: { fontSize: 10, cellPadding: 6, textColor: INK },
        headStyles: { fillColor: false, textColor: MUTED, fontSize: 8, lineWidth: { bottom: 1 }, lineColor: [203, 213, 224] },
        columnStyles: {
            1: { halign: 'right' },
            2: { halign: 'right' },
            3: { halign: 'right' },
        },
        theme: 'plain',
    });

    let afterTableY = doc.lastAutoTable.finalY + 20;

    if (compare(sale.display.discount_amount ?? '0', '0') > 0) {
        doc.setFont('helvetica', 'normal');
        doc.setFontSize(10);
        doc.setTextColor(...MUTED);
        doc.text('Subtotal', 360, afterTableY);
        doc.text(formatMoney(sale.display.subtotal), 555, afterTableY, { align: 'right' });
        afterTableY += 16;
        doc.text('Discount', 360, afterTableY);
        doc.text(`-${formatMoney(sale.display.discount_amount)}`, 555, afterTableY, { align: 'right' });
        afterTableY += 14;
    }

    doc.setLineWidth(1.5);
    doc.line(360, afterTableY - 10, 555, afterTableY - 10);

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(13);
    doc.setTextColor(...INK);
    doc.text('Total', 360, afterTableY + 6);
    doc.text(formatMoney(sale.total_amount), 555, afterTableY + 6, { align: 'right' });

    afterTableY += 40;

    doc.setFont('helvetica', 'bold');
    doc.setFontSize(8);
    doc.setTextColor(...MUTED);
    doc.text('PAYMENT', marginX, afterTableY);

    doc.setFont('helvetica', 'normal');
    doc.setFontSize(10);
    doc.setTextColor(...INK);

    for (const line of sale.payment_lines) {
        afterTableY += 16;
        doc.text(PAYMENT_LABELS[line.method] ?? line.method, marginX, afterTableY);
        doc.text(formatMoney(line.amount), 240, afterTableY, { align: 'right' });
    }

    if (settings.receipt.footer_text) {
        afterTableY += 40;
        doc.setFontSize(9);
        doc.setTextColor(...MUTED);
        doc.text(doc.splitTextToSize(settings.receipt.footer_text, 515), marginX, afterTableY, {
            align: 'left',
        });
    }

    return doc;
}

export function downloadInvoicePdf(sale, snapshot) {
    buildInvoicePdf(sale, snapshot).save(`invoice-${sale.invoice_number}.pdf`);
}
