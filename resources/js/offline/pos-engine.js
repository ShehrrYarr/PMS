/**
 * The offline till's cart and checkout logic.
 *
 * Every rule here mirrors Pos::checkout() and SaleService::create() on the
 * server. That duplication is deliberate and load-bearing: a sale queued
 * offline is replayed through the real server validation later, so anything
 * this lets through would come back as a rejected sale AFTER the customer has
 * already paid and left. Better to refuse it at the counter.
 */

import { add, compare, formatQuantity, multiply, normalize, percentOf, subtract } from './money';

export const PAYMENT_METHODS = ['cash', 'bank', 'ledger'];
export const DISCOUNT_TYPES = ['flat', 'percentage'];

export function createCart() {
    return {
        lines: [],
        customerId: null,
        // Whole-sale discount, on top of any per-item discounts on the lines.
        discountType: null,
        discountValue: '0',
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
        discount_type: null,
        discount_value: '0',
    });

    return { ok: true };
}

/** Mirrors Pos::lineSubtotal() — unit_price × quantity, before any discount. */
export function lineSubtotal(line) {
    return multiply(line.unit_price, line.quantity);
}

/** Mirrors Pos::lineDiscountAmount() / DiscountCalculator::amount(). */
export function lineDiscountAmount(line) {
    return discountAmount(lineSubtotal(line), line.discount_type, line.discount_value);
}

/** Mirrors Pos::lineTotal() — the line after its own per-item discount. */
export function lineTotal(line) {
    return subtract(lineSubtotal(line), lineDiscountAmount(line));
}

/** Mirrors Pos::getCartSubtotalProperty() — every line's pre-discount subtotal, summed. */
export function cartSubtotal(cart) {
    return cart.lines.reduce((carry, line) => add(carry, lineSubtotal(line)), '0.00');
}

/** Mirrors Pos::getCartItemDiscountTotalProperty(). */
export function cartItemDiscountTotal(cart) {
    return cart.lines.reduce((carry, line) => add(carry, lineDiscountAmount(line)), '0.00');
}

function subtotalAfterItemDiscounts(cart) {
    return subtract(cartSubtotal(cart), cartItemDiscountTotal(cart));
}

/** Mirrors Pos::getSaleDiscountAmountProperty(). */
export function saleDiscountAmount(cart) {
    return discountAmount(subtotalAfterItemDiscounts(cart), cart.discountType, cart.discountValue);
}

/**
 * Turns a discount type + value into the PKR amount to subtract — mirrors
 * DiscountCalculator::amount() on the server exactly (same truncation rules
 * as percentOf(), see money.js).
 */
function discountAmount(subtotal, type, value) {
    if (type === null || value === undefined || value === null) {
        return '0.00';
    }

    if (type === 'flat') {
        return normalize(value);
    }

    if (type === 'percentage') {
        return percentOf(subtotal, value);
    }

    return '0.00';
}

/** Subtotal minus every item discount minus the sale-level discount — mirrors Pos::getCartTotalProperty(). */
export function cartTotal(cart) {
    return subtract(subtotalAfterItemDiscounts(cart), saleDiscountAmount(cart));
}

/** True for a value that is a whole number at the 2dp scale everything else is compared at — e.g. "5.00", not "5.50". */
function isWholeNumber(value) {
    return /^-?\d+\.00$/.test(normalize(value));
}

/** Mirrors SaleService::resolveDiscountAmount()'s three guards. */
function isValidDiscount(subtotal, type, value) {
    if (type === null || value === undefined || value === null) {
        return true;
    }

    if (type === 'percentage' && (compare(value, '0') < 0 || compare(value, '100') > 0)) {
        return false;
    }

    if (type === 'flat' && compare(value, '0') < 0) {
        return false;
    }

    return compare(discountAmount(subtotal, type, value), subtotal) <= 0;
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
        // Matches cart.*.quantity => integer|min:1 server-side.
        if (compare(line.quantity, '1') < 0 || !isWholeNumber(line.quantity)) {
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

        // Mirrors SaleService::resolveDiscountAmount()'s three guards.
        if (!isValidDiscount(lineSubtotal(line), line.discount_type, line.discount_value)) {
            problems.push(translations.invalid_discount.replace(':product', line.product_name));
        }
    }

    if (!isValidDiscount(subtotalAfterItemDiscounts(cart), cart.discountType, cart.discountValue)) {
        problems.push(translations.invalid_sale_discount);
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
 * Builds the record that gets queued and later replayed. Only the keys the
 * server actually reads are carried on each item — display fields are
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
        discount_type: cart.discountType,
        discount_value: cart.discountType === null ? null : normalize(cart.discountValue ?? '0'),
        items: cart.lines.map((line) => ({
            batch_id: line.batch_id,
            quantity: normalize(line.quantity),
            unit_price: normalize(line.unit_price),
            discount_type: line.discount_type ?? null,
            discount_value: (line.discount_type ?? null) === null ? null : normalize(line.discount_value ?? '0'),
        })),
        payment_lines: paymentLines.map((line) => ({
            method: line.method,
            amount: normalize(line.amount),
            bank_id: line.method === 'bank' ? line.bank_id : null,
        })),
        // Kept purely so a receipt can be reprinted from the queue without
        // needing the snapshot decrypted again.
        display: {
            subtotal: cartSubtotal(cart),
            discount_amount: add(cartItemDiscountTotal(cart), saleDiscountAmount(cart)),
            lines: cart.lines.map((line) => ({
                product_name: line.product_name,
                quantity: formatQuantity(line.quantity),
                unit_price: line.unit_price,
                discount_amount: lineDiscountAmount(line),
                line_total: lineTotal(line),
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
