/**
 * The offline till's cart and checkout logic.
 *
 * Every rule here mirrors Pos::checkout() and SaleService::create() on the
 * server. That duplication is deliberate and load-bearing: a sale queued
 * offline is replayed through the real server validation later, so anything
 * this lets through would come back as a rejected sale AFTER the customer has
 * already paid and left. Better to refuse it at the counter.
 */

import { add, compare, formatQuantity, multiply, normalize } from './money';

export const PAYMENT_METHODS = ['cash', 'bank', 'ledger'];

export function createCart() {
    return {
        lines: [],
        customerId: null,
    };
}

export function findBatchByBarcode(snapshot, barcode) {
    const needle = String(barcode ?? '').trim();

    if (needle === '') {
        return null;
    }

    return snapshot.batches.find((batch) => batch.barcode === needle) ?? null;
}

/**
 * Adds a scanned batch, merging with an existing line the way the online POS
 * does rather than creating a duplicate row.
 */
export function addBatch(cart, batch) {
    const existing = cart.lines.find((line) => line.batch_id === batch.id);

    if (existing) {
        const next = add(existing.quantity, '1');

        if (compare(next, existing.available) > 0) {
            return { ok: false, reason: 'out_of_stock' };
        }

        existing.quantity = next;

        return { ok: true };
    }

    if (compare(batch.quantity_remaining, '0') <= 0) {
        return { ok: false, reason: 'out_of_stock' };
    }

    cart.lines.push({
        batch_id: batch.id,
        barcode: batch.barcode,
        product_name: batch.product_name,
        unit_price: normalize(batch.unit_price),
        quantity: '1.00',
        available: normalize(batch.quantity_remaining),
    });

    return { ok: true };
}

export function cartTotal(cart) {
    return cart.lines.reduce((carry, line) => add(carry, multiply(line.unit_price, line.quantity)), '0.00');
}

export function paymentsTotal(paymentLines) {
    return paymentLines.reduce((carry, line) => add(carry, line.amount || '0'), '0.00');
}

/**
 * Returns a list of human-readable problems, empty when the sale may proceed.
 * Ordered so the most actionable message surfaces first.
 */
export function validateSale(cart, paymentLines, translations) {
    const problems = [];

    if (cart.lines.length === 0) {
        problems.push(translations.cart_empty);

        return problems;
    }

    for (const line of cart.lines) {
        // Matches cart.*.quantity => min:0.01 server-side.
        if (compare(line.quantity, '0.01') < 0) {
            problems.push(translations.invalid_quantity.replace(':product', line.product_name));
        }

        // Matches cart.*.unit_price => min:0.
        if (compare(line.unit_price, '0') < 0) {
            problems.push(translations.invalid_price.replace(':product', line.product_name));
        }

        // The server would raise InsufficientStockException and, on sync,
        // record a conflict — catch it here while the customer is still
        // standing at the counter.
        if (compare(line.quantity, line.available) > 0) {
            problems.push(translations.insufficient_stock.replace(':product', line.product_name));
        }
    }

    if (paymentLines.length === 0) {
        problems.push(translations.payment_required);

        return problems;
    }

    for (const line of paymentLines) {
        if (!PAYMENT_METHODS.includes(line.method)) {
            problems.push(translations.payment_required);
        }

        if (compare(line.amount || '0', '0.01') < 0) {
            problems.push(translations.payment_required);
        }

        if (line.method === 'bank' && !line.bank_id) {
            problems.push(translations.bank_required);
        }

        if (line.method === 'ledger' && cart.customerId === null) {
            problems.push(translations.customer_required_for_ledger);
        }
    }

    // PaymentSplitService::assertBalanced — the sum must match to the paisa.
    if (compare(paymentsTotal(paymentLines), cartTotal(cart)) !== 0) {
        problems.push(translations.unbalanced_payment);
    }

    return [...new Set(problems)];
}

/**
 * Builds the record that gets queued and later replayed. Only the three keys
 * the server actually reads are carried on each item — display fields are
 * re-resolved from the snapshot when a receipt is reprinted.
 */
export function buildQueuedSale(cart, paymentLines, { clientUuid, invoiceNumber, invoiceSeq, userId }) {
    return {
        client_uuid: clientUuid,
        invoice_number: invoiceNumber,
        invoice_seq: invoiceSeq,
        occurred_at: new Date().toISOString(),
        customer_id: cart.customerId,
        user_id: userId,
        total_amount: cartTotal(cart),
        items: cart.lines.map((line) => ({
            batch_id: line.batch_id,
            quantity: normalize(line.quantity),
            unit_price: normalize(line.unit_price),
        })),
        payment_lines: paymentLines.map((line) => ({
            method: line.method,
            amount: normalize(line.amount),
            bank_id: line.method === 'bank' ? line.bank_id : null,
        })),
        // Kept purely so a receipt can be reprinted from the queue without
        // needing the snapshot decrypted again.
        display: {
            lines: cart.lines.map((line) => ({
                product_name: line.product_name,
                quantity: formatQuantity(line.quantity),
                unit_price: line.unit_price,
                line_total: multiply(line.unit_price, line.quantity),
            })),
        },
    };
}

/**
 * Decrements the cached stock so a second sale in the same offline session
 * can't oversell what the till already knows it has sold.
 */
export function applyStockToSnapshot(snapshot, cart) {
    for (const line of cart.lines) {
        const batch = snapshot.batches.find((candidate) => candidate.id === line.batch_id);

        if (batch) {
            batch.quantity_remaining = normalize(
                Math.max(0, Number.parseFloat(batch.quantity_remaining) - Number.parseFloat(line.quantity)),
            );
        }
    }
}
