/**
 * IndexedDB layer for the offline POS.
 *
 * The database name is keyed by shop slug AND user id on purpose. The service
 * worker sits at the origin root and therefore spans every shop hosted on this
 * domain — without that key, two cashiers from different shops sharing one
 * browser would share one database, and a queued sale could end up pointing at
 * another tenant's batch ids.
 */

const DB_VERSION = 1;

export const STORE_META = 'meta';
export const STORE_REFS = 'refs';
export const STORE_QUEUED_SALES = 'queued_sales';
export const STORE_HELD_ORDERS = 'held_orders';
export const STORE_PHOTOS = 'sale_photos';

let dbPromise = null;
let databaseName = null;

export function configureDatabase(shopSlug, userId) {
    const name = `pos-offline:${shopSlug}:${userId}`;

    // Switching user or shop must not reuse the previous connection.
    if (databaseName !== name) {
        databaseName = name;
        dbPromise = null;
    }
}

function openDatabase() {
    if (databaseName === null) {
        return Promise.reject(new Error('Offline database used before configureDatabase().'));
    }

    if (dbPromise !== null) {
        return dbPromise;
    }

    dbPromise = new Promise((resolve, reject) => {
        const request = indexedDB.open(databaseName, DB_VERSION);

        request.onupgradeneeded = () => {
            const db = request.result;

            if (!db.objectStoreNames.contains(STORE_META)) {
                db.createObjectStore(STORE_META);
            }
            if (!db.objectStoreNames.contains(STORE_REFS)) {
                db.createObjectStore(STORE_REFS);
            }
            if (!db.objectStoreNames.contains(STORE_QUEUED_SALES)) {
                db.createObjectStore(STORE_QUEUED_SALES, { keyPath: 'client_uuid' });
            }
            if (!db.objectStoreNames.contains(STORE_HELD_ORDERS)) {
                db.createObjectStore(STORE_HELD_ORDERS, { keyPath: 'client_uuid' });
            }
            if (!db.objectStoreNames.contains(STORE_PHOTOS)) {
                db.createObjectStore(STORE_PHOTOS);
            }
        };

        request.onsuccess = () => resolve(request.result);
        request.onerror = () => reject(request.error);
    });

    return dbPromise;
}

/**
 * Strips Alpine's reactive Proxy wrappers so a value can actually be stored.
 *
 * IndexedDB uses the structured clone algorithm, which throws DataCloneError
 * on a Proxy. Anything read straight off Alpine component state — a cart, a
 * held order's payload — is proxied, so it must be flattened to plain objects
 * first. Blobs and typed arrays are passed through untouched, since JSON
 * round-tripping would destroy them.
 */
function toStorable(value) {
    if (value === null || typeof value !== 'object') {
        return value;
    }

    if (value instanceof Blob || value instanceof ArrayBuffer || ArrayBuffer.isView(value)) {
        return value;
    }

    if (Array.isArray(value)) {
        return value.map(toStorable);
    }

    const plain = {};

    for (const [key, entry] of Object.entries(value)) {
        plain[key] = toStorable(entry);
    }

    return plain;
}

function runTransaction(storeName, mode, operation) {
    return openDatabase().then(
        (db) =>
            new Promise((resolve, reject) => {
                const transaction = db.transaction(storeName, mode);
                let result;

                try {
                    const request = operation(transaction.objectStore(storeName));

                    if (request !== undefined) {
                        request.onsuccess = () => {
                            result = request.result;
                        };
                        request.onerror = () => reject(request.error);
                    }
                } catch (error) {
                    // e.g. DataCloneError, thrown synchronously by put().
                    reject(error);

                    return;
                }

                // Resolve on commit, NOT on request success. A request can
                // succeed and the transaction still abort afterwards (quota
                // exceeded, disk pressure) — resolving early would report a
                // queued sale as saved when it was actually discarded.
                transaction.oncomplete = () => resolve(result);
                transaction.onerror = () => reject(transaction.error);
                transaction.onabort = () => reject(transaction.error ?? new Error('IndexedDB transaction aborted.'));
            }),
    );
}

export const meta = {
    get: (key) => runTransaction(STORE_META, 'readonly', (store) => store.get(key)),
    set: (key, value) => runTransaction(STORE_META, 'readwrite', (store) => store.put(toStorable(value), key)),
    remove: (key) => runTransaction(STORE_META, 'readwrite', (store) => store.delete(key)),
};

/**
 * Marks how the snapshot below is stored.
 *
 * Tills prepared before the password gate was removed hold an AES-GCM
 * {iv, ciphertext} record that nothing can read any more — there is no key
 * without a password. Those records are recognised by the ABSENCE of this
 * marker and reported as "no cache", so the till simply asks to be prepared
 * again rather than failing in some confusing way. Nothing is lost: queued
 * sales and held orders live in their own stores and were never encrypted.
 */
const SNAPSHOT_FORMAT = 'plain-v1';

/**
 * The reference snapshot — stock, customers, balances, branding.
 *
 * Stored in the clear. Encrypting it would need a secret, and the only secret
 * available was the cashier's password; with that gate gone, any key would
 * have to be kept in this same database next to the data it protects, which
 * protects nothing. Storing it plainly is the honest version of that, and the
 * real boundary stays where it always was — the device itself and the login
 * that had to happen to download this data in the first place.
 */
export const refs = {
    async save(snapshot) {
        await runTransaction(STORE_REFS, 'readwrite', (store) =>
            store.put(
                {
                    format: SNAPSHOT_FORMAT,
                    // The snapshot is mutated live during a session, so strip
                    // any Alpine proxies before structured-cloning it.
                    snapshot: toStorable(snapshot),
                    stored_at: new Date().toISOString(),
                },
                'snapshot',
            ),
        );
    },

    /**
     * Returns null when nothing is stored, or when what is stored predates
     * this format and can no longer be read.
     */
    async load() {
        const record = await runTransaction(STORE_REFS, 'readonly', (store) => store.get('snapshot'));

        if (!record || record.format !== SNAPSHOT_FORMAT) {
            return null;
        }

        return record.snapshot;
    },

    async storedAt() {
        const record = await runTransaction(STORE_REFS, 'readonly', (store) => store.get('snapshot'));

        return record?.format === SNAPSHOT_FORMAT ? (record.stored_at ?? null) : null;
    },

    exists() {
        return runTransaction(STORE_REFS, 'readonly', (store) => store.get('snapshot')).then(
            (record) => record?.format === SNAPSHOT_FORMAT,
        );
    },
};

/**
 * Queued sales are stored in the clear, deliberately.
 *
 * They carry only ids, quantities and amounts — customer and product NAMES are
 * resolved from the encrypted snapshot at render time, so this is far less
 * revealing than the reference data. In exchange, a forgotten password can
 * never lock away real money that hasn't reached the server yet.
 */
export const queuedSales = {
    add: (sale) => runTransaction(STORE_QUEUED_SALES, 'readwrite', (store) => store.put(toStorable(sale))),
    all: () => runTransaction(STORE_QUEUED_SALES, 'readonly', (store) => store.getAll()),
    remove: (clientUuid) =>
        runTransaction(STORE_QUEUED_SALES, 'readwrite', (store) => store.delete(clientUuid)),
    count: () => runTransaction(STORE_QUEUED_SALES, 'readonly', (store) => store.count()),
};

export const heldOrders = {
    put: (order) => runTransaction(STORE_HELD_ORDERS, 'readwrite', (store) => store.put(toStorable(order))),
    all: () => runTransaction(STORE_HELD_ORDERS, 'readonly', (store) => store.getAll()),
    remove: (clientUuid) =>
        runTransaction(STORE_HELD_ORDERS, 'readwrite', (store) => store.delete(clientUuid)),

    /**
     * Clear-and-refill in ONE transaction. Split across several, a failure
     * partway through would leave the till with no held orders at all rather
     * than with the previous set.
     */
    replaceAll(orders) {
        const storable = orders.map(toStorable);

        return runTransaction(STORE_HELD_ORDERS, 'readwrite', (store) => {
            store.clear();

            let last;

            for (const order of storable) {
                last = store.put(order);
            }

            return last;
        });
    },
};

export const salePhotos = {
    put: (clientUuid, blob) => runTransaction(STORE_PHOTOS, 'readwrite', (store) => store.put(blob, clientUuid)),
    get: (clientUuid) => runTransaction(STORE_PHOTOS, 'readonly', (store) => store.get(clientUuid)),
    remove: (clientUuid) => runTransaction(STORE_PHOTOS, 'readwrite', (store) => store.delete(clientUuid)),
};

/**
 * Asks the browser not to evict this origin's storage under disk pressure.
 * Without it, IndexedDB is "best effort" and a queue of unsynced sales could
 * be discarded. Returns whether persistence was actually granted so the UI can
 * warn — we still let the shop trade either way, because blocking the till is
 * the worse failure.
 */
export async function requestPersistentStorage() {
    if (!navigator.storage?.persist) {
        return false;
    }

    if (await navigator.storage.persisted()) {
        return true;
    }

    return navigator.storage.persist();
}

/**
 * Wipes everything for this shop+user. Callers must confirm the queue is empty
 * first — this is destructive and unsynced sales would be lost.
 */
export async function clearAll() {
    for (const store of [STORE_META, STORE_REFS, STORE_QUEUED_SALES, STORE_HELD_ORDERS, STORE_PHOTOS]) {
        await runTransaction(store, 'readwrite', (objectStore) => objectStore.clear());
    }
}
