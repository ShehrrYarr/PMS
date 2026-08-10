/**
 * Owns the offline session: preparing a till, reopening it after a restart,
 * refreshing its snapshot, and pushing its queue back.
 *
 * There is no password gate. Reaching any of this already requires a logged-in
 * session to download the data, and the till is expected to reopen unattended
 * after a power cut — a prompt at that moment stops the shop from selling
 * without protecting anything the device's own login doesn't already cover.
 */

import { basePath, fetchOfflineData, ping, syncQueue } from './api';
import { createConnectivityMonitor } from './connectivity';
import { subtract } from './money';
import {
    clearAll,
    configureDatabase,
    heldOrders,
    meta,
    queuedSales,
    refs,
    requestPersistentStorage,
    salePhotos,
} from './db';

export const STALE_WARNING_HOURS = 24;

export function createOfflineSession(shopSlug, userId) {
    let snapshot = null;

    // Configured up front rather than inside prepare()/open(), because the UI
    // reads the pending-sale count as soon as it mounts, before either runs.
    configureDatabase(shopSlug, userId);

    async function registerServiceWorker() {
        if (!('serviceWorker' in navigator)) {
            return null;
        }

        try {
            // updateViaCache: 'none' so the worker script itself is always
            // revalidated against the server. Without it a browser can keep
            // serving a byte-cached sw.js for up to 24 hours, which would
            // pin a shop to stale offline behaviour after a deploy.
            const registration = await navigator.serviceWorker.register('/sw.js', {
                scope: '/',
                updateViaCache: 'none',
            });

            await registration.update().catch(() => {});

            return registration;
        } catch {
            return null;
        }
    }

    async function cacheOfflineShell() {
        const registration = await navigator.serviceWorker?.ready;

        registration?.active?.postMessage({
            type: 'cache-offline-shell',
            url: `${basePath(shopSlug)}/${shopSlug}/pos/offline`,
        });
    }

    /**
     * "Go Offline": download everything and make sure the page itself will
     * load without a server.
     */
    async function prepare() {
        await ping(shopSlug);

        const deviceId = await meta.get('device_id');
        const data = await fetchOfflineData(shopSlug, deviceId ?? null);

        // Re-preparing a till that still has unsynced sales must not restore
        // the stock those sales already consumed.
        snapshot = await deductQueuedStock(data);

        await refs.save(snapshot);
        await meta.set('device_id', data.device.id);
        await meta.set('invoice_prefix', data.device.invoice_prefix);

        const serverNext = data.device.next_invoice_seq ?? 1;
        const localNext = (await meta.get('next_invoice_seq')) ?? 1;

        await meta.set('next_invoice_seq', Math.max(serverNext, localNext));
        await meta.set('user_id', data.user.id);
        await meta.set('shop_slug', shopSlug);

        const persisted = await requestPersistentStorage();

        await registerServiceWorker();
        await cacheOfflineShell();

        return { snapshot: data, persisted };
    }

    /**
     * Reopening the till after a restart, with or without a connection.
     *
     * Returns false only when there is nothing usable stored — either the till
     * was never prepared, or its snapshot predates the current storage format
     * (see SNAPSHOT_FORMAT in db.js). Both cases mean "prepare this device".
     */
    async function open() {
        const stored = await refs.load();

        if (stored === null) {
            return false;
        }

        snapshot = stored;

        return true;
    }

    /**
     * Subtracts everything still sitting in the queue from a snapshot's stock.
     *
     * The server has no idea those sales happened yet, so a freshly downloaded
     * snapshot always over-states what's on the shelf. Without this, a
     * background refresh silently restores stock the till has already sold and
     * the same units can be sold twice.
     */
    async function deductQueuedStock(target) {
        const pending = await queuedSales.all();

        for (const sale of pending) {
            for (const item of sale.items ?? []) {
                const batch = target.batches.find((candidate) => candidate.id === item.batch_id);

                if (batch) {
                    batch.quantity_remaining = subtract(batch.quantity_remaining, item.quantity);
                }
            }
        }

        return target;
    }

    /**
     * Persists the current snapshot, including any stock the till has sold
     * offline. Called after every completed sale — the in-memory decrement
     * alone would be undone by the next page reload.
     */
    async function persistSnapshot() {
        if (snapshot === null) {
            return false;
        }

        await refs.save(snapshot);

        return true;
    }

    /**
     * Silent background top-up while online, so an already-prepared till
     * doesn't drift far from real stock and balances.
     */
    async function refresh() {
        // Only tops up a till that has actually been prepared; there is
        // nothing to keep current otherwise.
        if (!(await refs.exists())) {
            return false;
        }

        try {
            const deviceId = await meta.get('device_id');
            const data = await fetchOfflineData(shopSlug, deviceId ?? null);

            snapshot = await deductQueuedStock(data);
            await refs.save(snapshot);

            // Only ever move the invoice counter FORWARD. The server reports
            // its own last used sequence, which knows nothing about sales
            // still queued here — accepting a lower value would reprint
            // numbers already handed to customers.
            const serverNext = data.device.next_invoice_seq ?? 1;
            const localNext = (await meta.get('next_invoice_seq')) ?? 1;

            await meta.set('next_invoice_seq', Math.max(serverNext, localNext));

            return true;
        } catch {
            // Refresh is best-effort: failing to top up must never disturb a
            // till that is mid-sale.
            return false;
        }
    }

    async function snapshotAgeHours() {
        const storedAt = await refs.storedAt();

        if (storedAt === null) {
            return null;
        }

        return (Date.now() - new Date(storedAt).getTime()) / 3600000;
    }

    /**
     * Pushes the queue, then removes ONLY the sales the server explicitly
     * acknowledged by client_uuid. A queue is never cleared because a response
     * "looked successful" — that is the single fastest way to destroy real
     * money records.
     */
    async function sync() {
        const health = await ping(shopSlug);
        const deviceId = await meta.get('device_id');

        if (!deviceId) {
            return { synced: 0, rejected: 0, conflicts: 0 };
        }

        const pending = await queuedSales.all();
        const held = await heldOrders.all();

        const response = await syncQueue(shopSlug, health.csrf, {
            device_id: deviceId,
            sales: pending.map((sale) => ({
                client_uuid: sale.client_uuid,
                occurred_at: sale.occurred_at,
                invoice_seq: sale.invoice_seq,
                customer_id: sale.customer_id,
                user_id: sale.user_id,
                items: sale.items,
                payment_lines: sale.payment_lines,
            })),
            held_orders: held.map((order) => ({
                client_uuid: order.client_uuid,
                label: order.label ?? null,
                payload: order.payload,
            })),
        });

        let synced = 0;
        let rejected = 0;
        let conflicts = 0;

        for (const result of response.results ?? []) {
            if (result.status === 'synced' || result.status === 'duplicate') {
                await queuedSales.remove(result.client_uuid);
                await uploadPhotoFor(result, health.csrf);
                synced += 1;

                if (result.had_conflict) {
                    conflicts += 1;
                }
            } else {
                // Left in the queue on purpose so it can be inspected and
                // retried rather than silently vanishing.
                rejected += 1;
            }
        }

        await heldOrders.replaceAll(
            (response.held_orders ?? []).map((order) => ({
                client_uuid: order.client_uuid,
                label: order.label,
                payload: order.payload,
                origin: 'server',
            })),
        );

        // Same forward-only rule as refresh(): never accept a sequence lower
        // than the one this till has already printed from.
        const serverNext = Number(response.next_invoice_seq);
        const localNext = (await meta.get('next_invoice_seq')) ?? 1;

        await meta.set(
            'next_invoice_seq',
            Number.isFinite(serverNext) ? Math.max(serverNext, localNext) : localNext,
        );
        await meta.set('last_synced_at', response.synced_at);

        // The server's stock moved when those sales landed, so top the
        // snapshot up — with whatever is still queued deducted again.
        await refresh();

        return { synced, rejected, conflicts };
    }

    /**
     * Photos go up one at a time, after their sale row exists — cPanel's
     * default PHP limits (2M per file, 8M per post, 20 files) would silently
     * truncate a multi-day batch sent in one request.
     */
    async function uploadPhotoFor(result, csrfToken) {
        const blob = await salePhotos.get(result.client_uuid);

        if (!blob || !result.sale_id) {
            return;
        }

        const body = new FormData();
        body.append('photo', blob, `${result.client_uuid}.jpg`);

        try {
            const response = await fetch(`${basePath(shopSlug)}/${shopSlug}/sales/${result.sale_id}/photo`, {
                method: 'POST',
                redirect: 'manual',
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body,
            });

            if (response.ok) {
                await salePhotos.remove(result.client_uuid);
            }
        } catch {
            // Keep the blob for the next attempt; the sale itself is safe.
        }
    }

    async function nextInvoice() {
        const prefix = (await meta.get('invoice_prefix')) ?? 'SL-OFF0-';
        const sequence = (await meta.get('next_invoice_seq')) ?? 1;

        await meta.set('next_invoice_seq', sequence + 1);

        return {
            invoice_seq: sequence,
            invoice_number: `${prefix}${String(sequence).padStart(4, '0')}`,
        };
    }

    return {
        prepare,
        open,
        refresh,
        persistSnapshot,
        sync,
        nextInvoice,
        snapshotAgeHours,
        clearAll,
        registerServiceWorker,
        hasCache: () => refs.exists(),
        snapshot: () => snapshot,
        pendingCount: () => queuedSales.count(),
        monitor: (options) => createConnectivityMonitor(shopSlug, options),
    };
}
