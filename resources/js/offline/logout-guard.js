/**
 * Stops a cashier signing out while offline sales are still queued.
 *
 * The queue lives in this browser's IndexedDB, keyed by shop and user, so the
 * server has no idea it exists — the check has to happen here. Logging out
 * would leave real, already-paid-for sales sitting on the device with nobody
 * aware of them.
 *
 * An admin can still force it through (the confirm offers a way past) because
 * a genuinely stuck device must not lock someone out of their own till.
 */

import { configureDatabase, queuedSales } from './db';

async function pendingCountFor(shopSlug, userId) {
    if (!shopSlug || !userId) {
        return 0;
    }

    try {
        configureDatabase(shopSlug, userId);

        return await queuedSales.count();
    } catch {
        // If the store can't even be opened there is nothing to strand.
        return 0;
    }
}

function attachGuard(form) {
    if (form.dataset.logoutGuardBound === '1') {
        return;
    }

    form.dataset.logoutGuardBound = '1';

    form.addEventListener('submit', async (event) => {
        if (form.dataset.logoutGuardCleared === '1') {
            return;
        }

        event.preventDefault();

        const pending = await pendingCountFor(form.dataset.shopSlug, form.dataset.userId);

        if (pending === 0) {
            form.dataset.logoutGuardCleared = '1';
            form.submit();

            return;
        }

        const message = (form.dataset.pendingMessage ?? '').replace(':count', String(pending));

        if (window.confirm(message)) {
            form.dataset.logoutGuardCleared = '1';
            form.submit();
        }
    });
}

function bindAll() {
    document.querySelectorAll('form[data-logout-guard]').forEach(attachGuard);
}

document.addEventListener('DOMContentLoaded', bindAll);
// The navbar is re-rendered by Livewire's SPA navigation, so rebind after it.
document.addEventListener('livewire:navigated', bindAll);
