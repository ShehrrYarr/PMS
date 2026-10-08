/**
 * Entry point for the offline till screen only.
 *
 * Kept separate from app.js because it pulls in jsPDF (~400 KB) — no reason to
 * ship that to every page of the app when only this screen produces a PDF
 * without a server.
 */

import Alpine from 'alpinejs';

import { downloadInvoicePdf } from './offline/invoice-pdf';
import { heldOrders, queuedSales, salePhotos } from './offline/db';
import { add, compare, formatMoney, formatQuantity, subtract } from './offline/money';
import {
    addBatch,
    buildQueuedSale,
    cartItemDiscountTotal,
    cartSubtotal,
    cartTotal,
    createCart,
    findBatchByBarcode,
    lineDiscountAmount,
    lineTotal,
    paymentsTotal,
    saleDiscountAmount,
    applyStockToSnapshot,
    validateSale,
} from './offline/pos-engine';
import { printReceipt } from './offline/receipt';
import { createOfflineSession, STALE_WARNING_HOURS } from './offline/session';
// Also registers the shared product grid (Alpine.data('posCatalog')).
import { expiryStatus, formatDisplayDate } from './pos/catalog';

function uuid() {
    if (crypto.randomUUID) {
        return crypto.randomUUID();
    }

    // Older WebViews: RFC-4122 v4 built from crypto-grade randomness.
    return '10000000-1000-4000-8000-100000000000'.replace(/[018]/g, (character) =>
        (character ^ (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (character / 4)))).toString(16),
    );
}

/**
 * This page has no Livewire — that's the whole point, it has to work with no
 * server — so Alpine can't come bundled in livewire.js the way it does
 * everywhere else in the app. We register and start our own copy here.
 */
window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => Alpine.start());

document.addEventListener('alpine:init', () => {
    Alpine.data('offlinePos', (config) => ({
        shopSlug: config.shopSlug,
        userId: config.userId,
        translations: config.translations,

        session: null,
        monitor: null,

        // Screen state: 'loading' → 'ready' when a prepared cache is found,
        // 'unprepared' when there is none, 'error' if opening blew up.
        stage: 'loading',

        snapshot: null,
        cart: createCart(),
        paymentLines: [],
        problems: [],
        // The cart is a slide-up drawer on screens narrower than lg.
        cartOpen: false,

        online: false,
        needsLogin: false,
        pending: 0,
        held: [],
        snapshotAgeHours: null,
        syncMessage: '',
        // Non-sync status, e.g. a receipt the browser refused to open.
        notice: '',
        busy: false,

        customerQuery: '',
        customerListOpen: false,
        showCheckout: false,
        photoDataUrl: null,
        photoBlob: null,
        lastSale: null,

        async init() {
            try {
                this.session = createOfflineSession(this.shopSlug, this.userId);

                await this.session.registerServiceWorker();

                this.monitor = this.session.monitor({
                    onChange: ({ online, needsLogin }) => {
                        this.online = online;
                        this.needsLogin = needsLogin;
                    },
                });
                this.monitor.start();

                // Opens straight into a working till. A shop that lost power
                // mid-trade gets its POS back by opening the browser, with
                // nothing to type and nothing to remember.
                if (await this.session.open()) {
                    this.snapshot = this.session.snapshot();
                    this.applyTheme();
                    this.stage = 'ready';
                    this.refreshCatalog();
                    await this.loadHeldOrders();
                } else {
                    this.stage = 'unprepared';
                }

                await this.refreshCounters();
            } catch (error) {
                // Without this the stage would stay pinned at 'loading' and
                // the cashier would stare at a permanently blank till with no
                // clue why.
                this.stage = 'error';
                this.notice = this.translations.till_unavailable;
                console.error('Offline till failed to start', error);
            }
        },

        /**
         * Paints the shop's own branding onto the offline shell.
         *
         * This page can't use the shared head partial (it must render with no
         * server), so the colours and font size ride along in the encrypted
         * snapshot and are applied here — otherwise the till silently falls
         * back to the stock green theme at 100%.
         */
        applyTheme() {
            const theme = this.snapshot?.settings?.theme;

            if (!theme) {
                return;
            }

            const root = document.documentElement;
            const vars = {
                '--navbar-primary-color': theme.navbar_primary_color,
                '--navbar-accent-color': theme.navbar_accent_color,
                '--sidebar-primary-color': theme.sidebar_primary_color,
                '--sidebar-accent-color': theme.sidebar_accent_color,
            };

            for (const [name, value] of Object.entries(vars)) {
                if (value) {
                    root.style.setProperty(name, value);
                }
            }

            if (theme.font_size_percent) {
                root.style.fontSize = `${theme.font_size_percent}%`;
            }
        },

        async refreshCounters() {
            try {
                this.pending = await this.session.pendingCount();
                this.snapshotAgeHours = await this.session.snapshotAgeHours();
            } catch {
                this.pending = 0;
            }
        },

        /** Uses the plural lang key rather than concatenating, so RTL reads correctly. */
        get syncLabel() {
            return this.pending > 0
                ? this.translations.sync_sales_count.replace(':count', String(this.pending))
                : this.translations.sync_sales;
        },

        get isStale() {
            return this.snapshotAgeHours !== null && this.snapshotAgeHours > STALE_WARNING_HOURS;
        },

        get staleLabel() {
            if (this.snapshotAgeHours === null) {
                return '';
            }

            const hours = Math.floor(this.snapshotAgeHours);

            return this.translations.data_age.replace(':hours', String(hours));
        },

        // ---- Product grid adapter (see resources/js/pos/catalog.js) -----

        /** The grid's data, straight from the stored snapshot. */
        catalogSource() {
            if (!this.snapshot) {
                return null;
            }

            return {
                products: this.snapshot.products,
                batches: this.snapshot.batches,
                categories: this.snapshot.categories ?? [],
                companies: this.snapshot.companies ?? [],
            };
        },

        /** Tells the grid to re-read the snapshot (stock moved, or it was replaced). */
        refreshCatalog() {
            window.dispatchEvent(new CustomEvent('pos-catalog-refresh'));
        },

        imageUrlFor(batch) {
            return this.snapshot?.products?.find((product) => product.id === batch.product_id)?.image_url ?? null;
        },

        /** Turns an addBatch() refusal into the same wording the live POS uses. */
        addFailureMessage(result, batch) {
            switch (result.reason) {
                case 'invalid_quantity':
                    return this.translations.add_invalid_quantity;
                case 'exceeds_stock':
                    return this.translations.quantity_exceeds_stock.replace(':available', result.available);
                case 'exceeds_stock_in_cart':
                    return this.translations.quantity_exceeds_stock_in_cart
                        .replace(':available', result.available)
                        .replace(':in_cart', result.inCart);
                default:
                    return this.translations.out_of_stock.replace(':barcode', batch.barcode);
            }
        },

        /** The batch pop-up's Enter. */
        addFromCatalog(catalogBatch, quantity) {
            // Look the batch up in the snapshot itself — that's the copy whose
            // stock is decremented after each sale and persisted.
            const batch = this.snapshot?.batches.find((candidate) => candidate.id === catalogBatch.id);

            if (!batch) {
                return { ok: false, message: this.translations.batch_unavailable };
            }

            const result = addBatch(this.cart, batch, quantity, { imageUrl: this.imageUrlFor(batch) });

            return result.ok ? { ok: true } : { ok: false, message: this.addFailureMessage(result, batch) };
        },

        /** A barcode typed or scanned into the grid's search box. */
        scanCode(code) {
            const batch = findBatchByBarcode(this.snapshot, code);

            if (batch === null) {
                return { ok: false, message: this.translations.barcode_not_found.replace(':barcode', code) };
            }

            const result = addBatch(this.cart, batch, '1', { imageUrl: this.imageUrlFor(batch) });

            if (!result.ok) {
                return { ok: false, message: this.addFailureMessage(result, batch) };
            }

            // Sold anyway — the shop decides — but never silently.
            const warning = batch.expiry_date && expiryStatus(batch.expiry_date) === 'expired'
                ? this.translations.batch_expired_warning
                    .replace(':barcode', batch.barcode)
                    .replace(':date', formatDisplayDate(batch.expiry_date, this.translations.receipt.lang))
                : null;

            return { ok: true, warning };
        },

        // ---- Cart ------------------------------------------------------

        removeLine(index) {
            this.cart.lines.splice(index, 1);
        },

        incrementLine(index) {
            const line = this.cart.lines[index];

            if (line && compare(add(line.quantity, '1'), line.available) <= 0) {
                line.quantity = add(line.quantity, '1');
            }
        },

        decrementLine(index) {
            const line = this.cart.lines[index];

            // Floor of 1, matching the live POS.
            if (line && compare(subtract(line.quantity, '1'), '1') >= 0) {
                line.quantity = subtract(line.quantity, '1');
            }
        },

        /** 'expired' | 'soon' | 'ok' | null for lines from before expiry dates were carried. */
        lineExpiry(line) {
            return line.expiry_date ? expiryStatus(line.expiry_date) : null;
        },

        lineExpiryDate(line) {
            return line.expiry_date ? formatDisplayDate(line.expiry_date, this.translations.receipt.lang) : '';
        },

        get itemCount() {
            return this.cart.lines.length;
        },

        clearCart() {
            this.cart = createCart();
            this.problems = [];
        },

        get total() {
            return cartTotal(this.cart);
        },

        get totalLabel() {
            return formatMoney(this.total);
        },

        get subtotalLabel() {
            return formatMoney(cartSubtotal(this.cart));
        },

        /** Every discount taken off, item-level plus sale-level — the receipt's "Discount" row. */
        get discountLabel() {
            return formatMoney(add(cartItemDiscountTotal(this.cart), saleDiscountAmount(this.cart)));
        },

        get hasDiscount() {
            return compare(add(cartItemDiscountTotal(this.cart), saleDiscountAmount(this.cart)), '0') > 0;
        },

        lineTotalLabel(line) {
            return formatMoney(lineTotal(line));
        },

        lineDiscountLabel(line) {
            return formatMoney(lineDiscountAmount(line));
        },

        get customerOptions() {
            const query = this.customerQuery.trim().toLowerCase();

            if (query === '') {
                return this.snapshot?.customers.slice(0, 25) ?? [];
            }

            return (this.snapshot?.customers ?? [])
                .filter((customer) => customer.name.toLowerCase().includes(query))
                .slice(0, 25);
        },

        get selectedCustomer() {
            return this.snapshot?.customers.find((entry) => entry.id === this.cart.customerId) ?? null;
        },

        selectCustomer(customer) {
            this.cart.customerId = customer.id;
            this.customerQuery = customer.name;
            this.customerListOpen = false;
        },

        clearCustomer() {
            this.cart.customerId = null;
            this.customerQuery = '';
            this.customerListOpen = false;
        },

        // ---- Held orders -----------------------------------------------

        async loadHeldOrders() {
            try {
                this.held = await heldOrders.all();
            } catch (error) {
                this.held = [];
                console.error('Could not read held orders', error);
            }
        },

        async holdOrder() {
            if (this.cart.lines.length === 0) {
                return;
            }

            this.notice = '';

            try {
                await heldOrders.put({
                    client_uuid: uuid(),
                    label: this.selectedCustomer?.name ?? null,
                    payload: {
                        cart: this.cart.lines,
                        customer_id: this.cart.customerId,
                        discount_type: this.cart.discountType,
                        discount_value: this.cart.discountValue,
                    },
                    origin: 'local',
                    held_at: new Date().toISOString(),
                });

                this.clearCart();
                await this.loadHeldOrders();
            } catch (error) {
                this.notice = this.translations.hold_failed;
                console.error('Could not hold order', error);
            }
        },

        async resumeHeldOrder(clientUuid) {
            // Surfaced through `notice`, not `problems`: problems only renders
            // inside the checkout modal, which is closed here, so the cashier
            // would otherwise tap Resume and see nothing happen at all.
            this.notice = '';

            if (this.cart.lines.length > 0) {
                this.notice = this.translations.cart_not_empty_to_resume;

                return;
            }

            const order = this.held.find((entry) => entry.client_uuid === clientUuid);

            if (!order) {
                return;
            }

            try {
                this.cart = {
                    lines: order.payload.cart ?? [],
                    customerId: order.payload.customer_id ?? null,
                    discountType: order.payload.discount_type ?? null,
                    discountValue: order.payload.discount_value ?? '0',
                };

                await heldOrders.remove(clientUuid);
                await this.loadHeldOrders();
            } catch (error) {
                this.notice = this.translations.hold_failed;
                console.error('Could not resume held order', error);
            }
        },

        async discardHeldOrder(clientUuid) {
            if (!window.confirm(this.translations.discard_order_confirm)) {
                return;
            }

            try {
                await heldOrders.remove(clientUuid);
                await this.loadHeldOrders();
            } catch (error) {
                this.notice = this.translations.hold_failed;
                console.error('Could not discard held order', error);
            }
        },

        // ---- Checkout ---------------------------------------------------

        openCheckout() {
            if (this.cart.lines.length === 0) {
                return;
            }

            this.paymentLines = [{ method: 'cash', amount: this.total, bank_id: null }];
            this.problems = [];
            this.showCheckout = true;
        },

        addPaymentLine() {
            this.paymentLines.push({ method: 'cash', amount: '', bank_id: null });
        },

        removePaymentLine(index) {
            this.paymentLines.splice(index, 1);
        },

        get remainingToPay() {
            // Exact decimal subtraction, not floats — this figure has to agree
            // with the server's balance check to the paisa.
            return formatMoney(subtract(this.total, paymentsTotal(this.paymentLines)));
        },

        get isFullyPaid() {
            return compare(paymentsTotal(this.paymentLines), this.total) === 0;
        },

        get needsPhoto() {
            return this.paymentLines.some((line) => line.method === 'ledger');
        },

        async capturePhoto(event) {
            const file = event.target.files?.[0];

            if (!file) {
                return;
            }

            this.photoBlob = file;
            this.photoDataUrl = URL.createObjectURL(file);
        },

        async completeSale() {
            this.problems = validateSale(this.cart, this.paymentLines, this.translations);

            if (this.problems.length > 0) {
                return;
            }

            this.busy = true;

            try {
                const { invoice_number: invoiceNumber, invoice_seq: invoiceSeq } =
                    await this.session.nextInvoice();

                const sale = buildQueuedSale(this.cart, this.paymentLines, {
                    clientUuid: uuid(),
                    invoiceNumber,
                    invoiceSeq,
                    userId: this.userId,
                });

                // The queue write must land before anything else — if it
                // fails, nothing below should run and no receipt should print.
                await queuedSales.add(sale);

                if (this.photoBlob) {
                    await salePhotos.put(sale.client_uuid, this.photoBlob);
                }

                // Keep the cached stock honest, then persist it: the in-memory
                // decrement alone is undone by the next page reload, which
                // would let the same units be sold again.
                applyStockToSnapshot(this.snapshot, this.cart);
                await this.session.persistSnapshot();
                this.refreshCatalog();

                this.lastSale = sale;

                this.clearCart();
                this.paymentLines = [];
                this.showCheckout = false;
                this.cartOpen = false;
                if (this.photoDataUrl) {
                    URL.revokeObjectURL(this.photoDataUrl);
                }
                this.photoDataUrl = null;
                this.photoBlob = null;

                await this.refreshCounters();

                // Printing last, and its failure reported rather than
                // swallowed: a browser can block the popup, and a cashier who
                // sees no receipt and no message will ring the sale twice.
                if (!printReceipt(sale, this.snapshot, this.translations.receipt)) {
                    this.notice = this.translations.receipt_blocked;
                }
            } catch (error) {
                this.problems = [this.translations.sale_save_failed];
                console.error('Offline sale could not be saved', error);
            } finally {
                this.busy = false;
            }
        },

        downloadLastInvoice() {
            if (this.lastSale) {
                downloadInvoicePdf(this.lastSale, this.snapshot);
            }
        },

        printReceiptAgain() {
            if (!this.lastSale) {
                return;
            }

            this.notice = printReceipt(this.lastSale, this.snapshot, this.translations.receipt)
                ? ''
                : this.translations.receipt_blocked;
        },

        // ---- Sync -------------------------------------------------------

        async syncNow() {
            this.busy = true;
            this.syncMessage = '';

            try {
                const result = await this.session.sync();

                this.syncMessage = this.translations.sync_result
                    .replace(':synced', String(result.synced))
                    .replace(':rejected', String(result.rejected));

                await this.session.refresh();
                this.snapshot = this.session.snapshot();
                this.refreshCatalog();
                await this.refreshCounters();
                await this.loadHeldOrders();
            } catch (error) {
                this.syncMessage = error.needsLogin
                    ? this.translations.sign_in_to_sync
                    : this.translations.sync_failed;
            } finally {
                this.busy = false;
            }
        },

        formatMoney,
        formatQuantity,
    }));
});
