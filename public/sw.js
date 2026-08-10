/**
 * Service worker for the offline POS.
 *
 * Hand-written and served straight from public/ rather than built by Vite:
 * a service worker needs a stable, unhashed URL at the origin root to control
 * /{shop}/pos, and Vite would hash the filename on every build. Apache serves
 * it directly (public/.htaccess only rewrites to index.php for paths that
 * aren't real files).
 *
 * Scope note: this sits at the origin root and therefore spans EVERY shop on
 * the domain. It deliberately caches nothing shop-specific beyond the offline
 * shell, and the shell itself holds no per-request data — all shop data lives
 * in IndexedDB, keyed by shop and user.
 */

const CACHE_PREFIX = 'pos-offline-';

/**
 * Derives the cache name from the current build's asset hashes.
 *
 * Computed on demand rather than held in a module variable: a service worker
 * is torn down and restarted freely between events, so anything cached in
 * module scope during `install` is gone by the time `activate` or `fetch`
 * runs — and an `activate` that guessed the wrong name would delete the live
 * cache and keep the stale one.
 */
async function resolveCache() {
    const response = await fetch('/build/manifest.json', { cache: 'no-store' });

    // Throw rather than return a fallback name. A 404/503 during a deploy, or
    // a captive portal returning its own page, would otherwise resolve to a
    // name that matches nothing — and every caller that then "cleans up other
    // caches" would delete the real one, destroying offline capability at
    // exactly the moment it matters. Callers treat a throw as "leave
    // everything alone".
    if (!response.ok) {
        throw new Error(`Vite manifest unavailable (${response.status}).`);
    }

    const manifest = await response.json();
    const urls = [];

    for (const entry of Object.values(manifest)) {
        if (entry.file) {
            urls.push(`/build/${entry.file}`);
        }
        for (const cssFile of entry.css ?? []) {
            urls.push(`/build/${cssFile}`);
        }
    }

    // Filenames already contain content hashes, so the joined list is an
    // accurate fingerprint of this exact build.
    const digest = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(urls.join('|')));
    const name =
        CACHE_PREFIX +
        Array.from(new Uint8Array(digest))
            .slice(0, 8)
            .map((byte) => byte.toString(16).padStart(2, '0'))
            .join('');

    return { name, urls };
}

async function cacheCurrentAssets() {
    const { name, urls } = await resolveCache();
    const cache = await caches.open(name);

    // Individually, so a single 404 doesn't abort the whole install.
    await Promise.all(urls.map((url) => cache.add(url).catch(() => {})));

    return name;
}

async function dropStaleCaches(keepName) {
    const keys = await caches.keys();

    await Promise.all(
        keys
            .filter((key) => key.startsWith(CACHE_PREFIX) && key !== keepName)
            .map((key) => caches.delete(key)),
    );
}

self.addEventListener('install', (event) => {
    event.waitUntil(
        // Caching is best-effort; taking control is not. An install that
        // couldn't reach the manifest must still activate, so the previously
        // cached shell keeps serving.
        cacheCurrentAssets()
            .catch(() => {})
            .then(() => self.skipWaiting()),
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        (async () => {
            try {
                const { name } = await resolveCache();

                await dropStaleCaches(name);
            } catch {
                // Manifest unreachable — keep every existing cache. Deleting
                // here is what would strand an offline till.
            }

            await self.clients.claim();
        })(),
    );
});

/**
 * The page asks us to cache its offline shell at "Go Offline" time, rather
 * than us guessing at install time which shop's shell to store. This also
 * re-checks the asset list, so a till prepared after a deploy picks up the
 * current build even though sw.js itself never changed.
 */
self.addEventListener('message', (event) => {
    if (event.data?.type !== 'cache-offline-shell') {
        return;
    }

    event.waitUntil(
        (async () => {
            try {
                const name = await cacheCurrentAssets();
                const cache = await caches.open(name);
                const response = await fetch(event.data.url, { redirect: 'manual' });

                // Only cache a real shell. fetch() would otherwise happily
                // store a login page (served 200 after a redirect) as the
                // offline till — and an overnight session expiry is exactly
                // when a shop reopens offline.
                if (response.ok && response.type !== 'opaqueredirect') {
                    await cache.put(event.data.url, response.clone());
                }

                await dropStaleCaches(name);
            } catch {
                // Leave existing caches untouched.
            }
        })(),
    );
});

function isOfflineShellRequest(url) {
    return /\/pos\/offline\/?$/.test(url.pathname);
}

function isPosRequest(url) {
    return /\/pos\/?$/.test(url.pathname);
}

self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (request.method !== 'GET') {
        return;
    }

    const url = new URL(request.url);

    if (url.origin !== self.location.origin) {
        return;
    }

    // Match on destination, NOT request.mode === 'navigate'. Livewire's
    // wire:navigate performs a fetch() rather than a real navigation, so
    // mode-matching would simply never fire for in-app links.
    const isDocument = request.destination === 'document';

    if (isDocument && isOfflineShellRequest(url)) {
        // Network-first: a deploy changes this page, and it must not be
        // pinned to a stale copy while the shop is online.
        event.respondWith(
            fetch(request)
                .then(async (response) => {
                    // Never overwrite a good cached shell with an error or a
                    // redirected login page.
                    if (response.ok && !response.redirected) {
                        try {
                            const { name } = await resolveCache();
                            const cache = await caches.open(name);

                            await cache.put(request, response.clone());
                        } catch {
                            // Serving the live response still works.
                        }
                    }

                    return response;
                })
                // caches.match searches every cache, so this still finds the
                // shell after a rename we haven't cleaned up yet.
                .catch(async () => (await caches.match(request, { ignoreSearch: true })) ?? Response.error()),
        );

        return;
    }

    if (isDocument && isPosRequest(url)) {
        // The Livewire POS can't work without a server, and its rendered HTML
        // must never be cached — a Livewire snapshot is keyed on APP_KEY, not
        // the session, so a cached page replayed by a different cashier would
        // resume the previous user's component state. Send the till to the
        // dedicated offline screen instead, keeping URL and content in step.
        event.respondWith(
            fetch(request).catch(() =>
                Response.redirect(`${url.pathname.replace(/\/$/, '')}/offline`, 302),
            ),
        );

        return;
    }

    // Hashed build assets are immutable, so cache-first is safe and fast.
    if (url.pathname.startsWith('/build/')) {
        event.respondWith(caches.match(request).then((cached) => cached ?? fetch(request)));
    }
});
