/**
 * The POS product grid and batch pop-up, shared by the live POS and the
 * offline till.
 *
 * Purely client-side: the whole catalogue (see App\Services\PosCatalogService)
 * is loaded once, so filtering, switching tabs and opening a pop-up never wait
 * on a server. The two screens differ only in where the data comes from and
 * what "add to cart" does, which each passes in as an adapter:
 *
 *   load()           → Promise<catalogue data> (or the data itself)
 *   add(batch, qty)  → Promise<{ ok, message }>  the batch pop-up's Enter
 *   scan(code)       → Promise<{ ok, message, warning }>  a scanned barcode
 *   cartLines()      → the cart's current lines, to show "N in cart"
 *
 * Every rule that matters (stock, quantity) is enforced again by whatever
 * add()/scan() call — the live POS's Livewire component, or the offline
 * engine — so nothing here is a security boundary.
 */

import { add, compare, formatMoney, formatQuantity } from '../offline/money';

export const EXPIRY_SOON_DAYS = 30;

const PAGE_SIZE = 60;

/** Whole days from today (local date) until a YYYY-MM-DD date; negative once past. */
export function daysUntil(dateString, today = new Date()) {
    const [year, month, day] = String(dateString).split('-').map(Number);
    const target = Date.UTC(year, month - 1, day);
    const base = Date.UTC(today.getFullYear(), today.getMonth(), today.getDate());

    return Math.round((target - base) / 86400000);
}

/** Mirrors Batch::isExpired() / isExpiringSoon(30) on the server. */
export function expiryStatus(dateString, today = new Date()) {
    const days = daysUntil(dateString, today);

    if (days < 0) {
        return 'expired';
    }

    return days <= EXPIRY_SOON_DAYS ? 'soon' : 'ok';
}

/** "12 Mar 2027" (or its Urdu equivalent) for a YYYY-MM-DD date. */
export function formatDisplayDate(dateString, locale = 'en') {
    const [year, month, day] = String(dateString).split('-').map(Number);

    try {
        return new Intl.DateTimeFormat(locale === 'ur' ? 'ur-PK' : 'en-GB', {
            day: 'numeric',
            month: 'short',
            year: 'numeric',
            timeZone: 'UTC',
        }).format(Date.UTC(year, month - 1, day));
    } catch {
        return dateString;
    }
}

function productKey(batch) {
    return batch.product_id ?? `name:${batch.product_name}`;
}

/**
 * Snapshots stored before the grid existed carry batches but no products
 * list. Rather than forcing the till to be re-prepared (impossible while it
 * is actually offline), derive a bare product per name until the next
 * refresh brings the real list.
 */
function deriveProducts(batches) {
    const seen = new Map();

    for (const batch of batches) {
        const key = productKey(batch);

        if (!seen.has(key)) {
            seen.set(key, {
                id: key,
                name: batch.product_name,
                sku: null,
                unit: batch.unit ?? '',
                unit_price: batch.unit_price,
                category_id: null,
                company_id: null,
                image_url: null,
            });
        }
    }

    return [...seen.values()].sort((a, b) => a.name.localeCompare(b.name));
}

/**
 * Joins batches onto their products, earliest expiry first, and works out
 * each product's total stock and expiry flags for its tile.
 */
export function buildCatalog(data, today = new Date()) {
    const batches = Array.isArray(data?.batches) ? data.batches : [];
    const byProduct = new Map();

    for (const batch of batches) {
        if (compare(batch.quantity_remaining, '0') <= 0) {
            continue;
        }

        const key = productKey(batch);

        if (!byProduct.has(key)) {
            byProduct.set(key, []);
        }

        byProduct.get(key).push(batch);
    }

    const products = Array.isArray(data?.products) ? data.products : deriveProducts(batches);

    return products.map((product) => {
        const productBatches = (byProduct.get(product.id) ?? [])
            .slice()
            .sort((a, b) => a.expiry_date.localeCompare(b.expiry_date) || a.id - b.id);

        const statuses = productBatches.map((batch) => expiryStatus(batch.expiry_date, today));
        const stock = productBatches.reduce((carry, batch) => add(carry, batch.quantity_remaining), '0.00');

        return {
            ...product,
            batches: productBatches,
            stock: Number.parseInt(formatQuantity(stock), 10) || 0,
            hasExpired: statuses.includes('expired'),
            hasExpiringSoon: statuses.includes('soon'),
            // Name, SKU and every batch barcode, so typing part of any of
            // them narrows the grid.
            haystack: [product.name, product.sku ?? '', ...productBatches.map((batch) => batch.barcode)]
                .join(' ')
                .toLowerCase(),
        };
    });
}

export function filterProducts(products, { query = '', categoryId = 'all', companyId = '' } = {}) {
    const terms = query.trim().toLowerCase().split(/\s+/).filter(Boolean);

    return products.filter((product) => {
        if (categoryId === 'none' && product.category_id !== null) {
            return false;
        }

        if (categoryId !== 'all' && categoryId !== 'none' && product.category_id !== categoryId) {
            return false;
        }

        if (companyId !== '' && product.company_id !== Number(companyId)) {
            return false;
        }

        return terms.every((term) => product.haystack.includes(term));
    });
}

function prefersKeyboard() {
    // A touch screen gets no auto-focus: focusing an input there pops the
    // on-screen keyboard over half the grid.
    return window.matchMedia?.('(pointer: fine)').matches ?? true;
}

/**
 * Focuses an element once it can actually take focus. The pop-up opens
 * through an x-show transition, so on the very next tick it can still be
 * display:none — focus() then silently does nothing and the cashier's typing
 * (or a scanner's barcode) goes nowhere. Retries briefly instead — on
 * setTimeout, not requestAnimationFrame, which a browser pauses entirely for
 * a page it isn't currently painting.
 * `resolve` is a getter because an element inside x-if may not exist yet.
 */
function focusWhenReady(resolve, select = false, attempt = 0) {
    const element = resolve();

    if (element) {
        element.focus({ preventScroll: true });

        if (document.activeElement === element) {
            if (select) {
                element.select?.();
            }

            return;
        }
    }

    if (attempt < 50) {
        window.setTimeout(() => focusWhenReady(resolve, select, attempt + 1), 20);
    }
}

document.addEventListener('alpine:init', () => {
    Alpine.data('posCatalog', (config) => ({
        t: config.translations,

        products: [],
        categories: [],
        companies: [],
        hasUncategorized: false,
        canSeeCost: false,
        loaded: false,
        loadFailed: false,

        query: '',
        categoryId: 'all',
        companyId: '',
        limit: PAGE_SIZE,

        // Feedback under the search box: a scan result or "added to cart".
        message: '',
        messageTone: 'error',
        messageTimer: null,

        dialogOpen: false,
        activeProduct: null,
        selectedIndex: 0,
        quantity: '1',
        dialogError: '',
        adding: false,

        init() {
            this.reload();

            this.$watch('query', () => {
                this.limit = PAGE_SIZE;
            });
            this.$watch('categoryId', () => {
                this.limit = PAGE_SIZE;
            });
            this.$watch('companyId', () => {
                this.limit = PAGE_SIZE;
            });

            this.refreshListener = () => this.reload();
            window.addEventListener('pos-catalog-refresh', this.refreshListener);

            // Livewire's SPA navigation swaps the page without a reload, so
            // the window listener has to be removed explicitly.
            document.addEventListener(
                'livewire:navigating',
                () => window.removeEventListener('pos-catalog-refresh', this.refreshListener),
                { once: true },
            );

            this.$nextTick(() => this.focusSearch());
        },

        async reload() {
            try {
                this.applyData(await config.load());
                this.loadFailed = false;
            } catch (error) {
                this.loadFailed = true;
                console.error('POS catalogue could not be loaded', error);
            } finally {
                this.loaded = true;
            }
        },

        applyData(data) {
            if (!data) {
                return;
            }

            this.products = buildCatalog(data);

            const usedCategories = new Set(this.products.map((product) => product.category_id));
            const usedCompanies = new Set(this.products.map((product) => product.company_id));

            // Only tabs and companies that would actually show something.
            this.categories = (data.categories ?? []).filter((category) => usedCategories.has(category.id));
            this.companies = (data.companies ?? []).filter((company) => usedCompanies.has(company.id));
            this.hasUncategorized = this.categories.length > 0 && usedCategories.has(null);
            this.canSeeCost = (data.batches ?? []).some((batch) => 'cost_price' in batch);

            if (this.categoryId !== 'all' && this.categoryId !== 'none' && !usedCategories.has(this.categoryId)) {
                this.categoryId = 'all';
            }

            // Keep an open pop-up pointing at fresh stock figures.
            if (this.dialogOpen && this.activeProduct) {
                const fresh = this.products.find((product) => product.id === this.activeProduct.id);

                if (!fresh || fresh.batches.length === 0) {
                    this.closeDialog();
                } else {
                    this.activeProduct = fresh;
                    this.selectedIndex = Math.min(this.selectedIndex, fresh.batches.length - 1);
                }
            }
        },

        get filtered() {
            return filterProducts(this.products, {
                query: this.query,
                categoryId: this.categoryId,
                companyId: this.companyId,
            });
        },

        get visible() {
            return this.filtered.slice(0, this.limit);
        },

        get hasMore() {
            return this.filtered.length > this.limit;
        },

        showMore() {
            this.limit += PAGE_SIZE;
        },

        categoryCount(categoryId) {
            if (categoryId === 'all') {
                return this.products.length;
            }

            return this.products.filter((product) =>
                categoryId === 'none' ? product.category_id === null : product.category_id === categoryId,
            ).length;
        },

        /**
         * `select` highlights whatever is still typed in the box, so the next
         * scan replaces it instead of being appended to it ("stormBCH00…").
         */
        focusSearch(select = false) {
            if (prefersKeyboard()) {
                // Never behind an open pop-up — typing would land in the
                // hidden search box instead of the quantity.
                focusWhenReady(() => (this.dialogOpen ? null : this.$refs.search), select);
            }
        },

        clearSearch() {
            this.query = '';
            this.focusSearch();
        },

        flash(text, tone) {
            window.clearTimeout(this.messageTimer);
            this.message = text;
            this.messageTone = tone;

            if (tone !== 'error') {
                this.messageTimer = window.setTimeout(() => {
                    this.message = '';
                }, 4000);
            }
        },

        findBatchByBarcode(code) {
            for (const product of this.products) {
                const batch = product.batches.find((candidate) => candidate.barcode === code);

                if (batch) {
                    return batch;
                }
            }

            return null;
        },

        /**
         * Enter in the search box. A barcode scanner "types" the code and
         * presses Enter, so an exact barcode goes straight into the cart like
         * it always has. Otherwise, if the text narrows the grid to exactly
         * one product, open its pop-up — type a name, Enter, Enter, sold.
         */
        async submitSearch() {
            const code = this.query.trim();

            // A pop-up is already open (its Enter belongs to it).
            if (code === '' || this.dialogOpen) {
                return;
            }

            const matches = this.filtered;

            if (this.findBatchByBarcode(code) !== null || matches.length === 0) {
                // Unknown codes go to the server too, so the cashier gets its
                // exact reason (no such barcode / that batch is sold out).
                await this.scan(code);

                return;
            }

            if (matches.length === 1 && matches[0].batches.length > 0) {
                this.openProduct(matches[0]);
            }
        },

        async scan(code) {
            this.message = '';

            try {
                const result = await config.scan(code);

                this.query = '';

                if (result?.ok) {
                    if (result.warning) {
                        this.flash(result.warning, 'warning');
                    } else {
                        this.flash(this.t.scanned.replace(':barcode', code), 'success');
                    }
                } else if (result?.message) {
                    this.flash(result.message, 'error');
                }
            } catch (error) {
                this.flash(this.t.action_failed, 'error');
                console.error('Scan failed', error);
            }

            this.focusSearch();
        },

        // ---- Batch pop-up -------------------------------------------------

        openProduct(product) {
            if (product.batches.length === 0) {
                return;
            }

            // Let go of the search box at once: until the pop-up has painted
            // and its quantity box can take focus, a fast typist's (or
            // scanner's) keys would otherwise land in the search behind it.
            this.$refs.search?.blur();

            this.activeProduct = product;
            // Earliest expiry first, and pre-selected — Enter sells the
            // oldest stock unless the cashier deliberately picks another.
            this.selectedIndex = 0;
            this.quantity = '1';
            this.dialogError = '';
            this.message = '';
            this.dialogOpen = true;

            this.$nextTick(() => this.focusQuantity());
        },

        closeDialog() {
            this.dialogOpen = false;
            this.activeProduct = null;
            this.dialogError = '';
            this.$nextTick(() => this.focusSearch(true));
        },

        focusQuantity() {
            if (prefersKeyboard()) {
                focusWhenReady(() => this.$refs.quantity, true);
            }
        },

        get selectedBatch() {
            return this.activeProduct?.batches[this.selectedIndex] ?? null;
        },

        selectBatch(index) {
            this.selectedIndex = index;
            this.dialogError = '';
            this.focusQuantity();
        },

        moveSelection(delta) {
            const count = this.activeProduct?.batches.length ?? 0;

            if (count === 0) {
                return;
            }

            this.selectedIndex = (this.selectedIndex + delta + count) % count;
            this.dialogError = '';
        },

        inCart(batchId) {
            const line = (config.cartLines?.() ?? []).find((entry) => entry.batch_id === batchId);

            return line ? Number.parseInt(String(line.quantity), 10) || 0 : 0;
        },

        /** What can still be added of this batch, after what's already in the cart. */
        maxAddable(batch) {
            return Math.max(0, (Number.parseInt(formatQuantity(batch.quantity_remaining), 10) || 0) - this.inCart(batch.id));
        },

        stepQuantity(delta) {
            const current = Number.parseInt(this.quantity, 10) || 0;
            const ceiling = this.selectedBatch ? Math.max(1, this.maxAddable(this.selectedBatch)) : Infinity;

            this.quantity = String(Math.min(ceiling, Math.max(1, current + delta)));
            this.dialogError = '';
        },

        async confirm() {
            const batch = this.selectedBatch;

            if (this.adding || !batch) {
                return;
            }

            const quantity = this.quantity.trim();

            if (!/^\d+$/.test(quantity) || Number(quantity) < 1) {
                this.dialogError = this.t.invalid_quantity;
                this.focusQuantity();

                return;
            }

            this.adding = true;

            try {
                const result = await config.add(batch, quantity);

                if (result?.ok) {
                    const name = this.activeProduct.name;

                    this.closeDialog();
                    this.flash(this.t.added_to_cart.replace(':product', name).replace(':count', quantity), 'success');
                } else {
                    this.dialogError = result?.message ?? this.t.action_failed;
                    this.focusQuantity();
                }
            } catch (error) {
                this.dialogError = this.t.action_failed;
                console.error('Add to cart failed', error);
            } finally {
                this.adding = false;
            }
        },

        // ---- Display helpers ----------------------------------------------

        expiryStatus(batch) {
            return expiryStatus(batch.expiry_date);
        },

        expiryLabel(batch) {
            const days = daysUntil(batch.expiry_date);

            if (days < 0) {
                return this.t.expired;
            }

            if (days === 0) {
                return this.t.expires_today;
            }

            if (days <= EXPIRY_SOON_DAYS) {
                return (days === 1 ? this.t.expires_in_day : this.t.expires_in_days).replace(':days', String(days));
            }

            return '';
        },

        formatDate(dateString) {
            return formatDisplayDate(dateString, config.locale);
        },

        initial(name) {
            return (String(name ?? '').trim()[0] ?? '?').toUpperCase();
        },

        stockLabel(product) {
            return product.stock > 0 ? this.t.in_stock.replace(':count', String(product.stock)) : this.t.out_of_stock;
        },

        formatMoney,
        formatQuantity,
    }));
});
