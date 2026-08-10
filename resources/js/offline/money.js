/**
 * Decimal-safe money maths for the offline till.
 *
 * Every amount the till queues is replayed through the server's bcmath code,
 * which then checks the payment split balances to the paisa. So this module's
 * job is not "be accurate" — it is "agree with PHP's bcmath exactly". A
 * one-paisa disagreement gets a sale rejected on sync, after the customer has
 * already paid and left.
 *
 * Two properties of bcmath drive the implementation:
 *
 *  1. bcmul/bcadd/bcsub with scale 2 TRUNCATE the third decimal, they do not
 *     round it. 333.33 x 1.5 is 499.99, not 500.00.
 *  2. Operands are used at their full written precision, so an amount typed
 *     as "1.005" is genuinely 1.005 and not 1.01.
 *
 * Values are therefore parsed exactly from their decimal string — never via
 * float arithmetic, which cannot represent most 2dp values — and held as
 * integer hundredths.
 */

const SCALE = 2;
const SCALE_FACTOR = 100;

/**
 * Splits a decimal string into an exact integer and its decimal places, with
 * no floating-point step anywhere. "12.345" becomes { units: 12345, places: 3 }.
 */
function parseExact(value) {
    const text = String(value ?? '0').trim();
    const match = /^([+-]?)(\d*)(?:\.(\d*))?$/.exec(text);

    if (match === null) {
        return { units: 0, places: 0 };
    }

    const sign = match[1] === '-' ? -1 : 1;
    const whole = match[2] || '0';
    const fraction = match[3] || '';
    const digits = `${whole}${fraction}` || '0';

    return { units: sign * Number(digits), places: fraction.length };
}

/** Rescales an exact value to integer hundredths, truncating like bcmath. */
function toCents(value) {
    const { units, places } = parseExact(value);

    if (!Number.isFinite(units)) {
        return 0;
    }

    if (places === SCALE) {
        return units;
    }

    if (places < SCALE) {
        return units * 10 ** (SCALE - places);
    }

    return Math.trunc(units / 10 ** (places - SCALE));
}

function fromCents(cents) {
    const sign = cents < 0 ? '-' : '';
    const absolute = Math.abs(cents);

    return `${sign}${Math.floor(absolute / SCALE_FACTOR)}.${String(absolute % SCALE_FACTOR).padStart(2, '0')}`;
}

/**
 * Rescales an exact value to a given number of decimal places, truncating
 * only when losing precision.
 */
function rescale({ units, places }, targetPlaces) {
    if (places === targetPlaces) {
        return units;
    }

    return places < targetPlaces
        ? units * 10 ** (targetPlaces - places)
        : Math.trunc(units / 10 ** (places - targetPlaces));
}

/**
 * Mirrors bcadd/bcsub at scale 2: the operands are combined at their FULL
 * precision and the result is truncated once, at the end.
 *
 * Truncating each operand first would be a different answer — 1.005 + 2.005
 * is 3.01, not 3.00 — and is exactly the mistake that made line totals
 * disagree with the server.
 */
function combine(a, b, signOfB) {
    const left = parseExact(a);
    const right = parseExact(b);

    if (!Number.isFinite(left.units) || !Number.isFinite(right.units)) {
        return '0.00';
    }

    const places = Math.max(left.places, right.places);
    const sum = rescale(left, places) + signOfB * rescale(right, places);

    return fromCents(rescale({ units: sum, places }, SCALE));
}

export function add(a, b) {
    return combine(a, b, 1);
}

export function subtract(a, b) {
    return combine(a, b, -1);
}

/**
 * Mirrors bcmul($a, $b, 2). Multiplies at the operands' combined precision
 * first and only then truncates, exactly as bcmath does — truncating the
 * operands up front would give a different (wrong) answer.
 */
export function multiply(a, b) {
    const left = parseExact(a);
    const right = parseExact(b);

    if (!Number.isFinite(left.units) || !Number.isFinite(right.units)) {
        return '0.00';
    }

    const product = left.units * right.units;
    const places = left.places + right.places;

    if (places === SCALE) {
        return fromCents(product);
    }

    if (places < SCALE) {
        return fromCents(product * 10 ** (SCALE - places));
    }

    // Math.trunc, not Math.floor: bcmath moves toward zero for negatives.
    return fromCents(Math.trunc(product / 10 ** (places - SCALE)));
}

export function compare(a, b) {
    const left = toCents(a);
    const right = toCents(b);

    if (left === right) {
        return 0;
    }

    return left > right ? 1 : -1;
}

export function normalize(value) {
    return fromCents(toCents(value));
}

/** Display only — matches the server's money() helper, which shows no decimals. */
export function formatMoney(value) {
    return `PKR ${Math.round(toCents(value) / SCALE_FACTOR).toLocaleString('en-US')}`;
}

/** Trims trailing zeros the way the receipt view does. */
export function formatQuantity(value) {
    const normalized = normalize(value);

    return normalized.includes('.')
        ? normalized.replace(/\.?0+$/, '') || '0'
        : normalized;
}
