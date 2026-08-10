/**
 * Tracks whether the till can actually reach the server.
 *
 * navigator.onLine alone is not trustworthy — it only reports whether a
 * network interface is up, so it says "online" on a shop wifi router whose
 * internet has dropped, which is precisely the situation this whole feature
 * exists for. So a real request to the ping endpoint is the source of truth,
 * and navigator.onLine is used only as a fast negative signal.
 */

import { ping } from './api';

const DEFAULT_PROBE_INTERVAL_MS = 20000;

export function createConnectivityMonitor(shopSlug, { onChange, intervalMs = DEFAULT_PROBE_INTERVAL_MS } = {}) {
    let online = false;
    let needsLogin = false;
    let timer = null;
    let probing = false;

    function publish(nextOnline, nextNeedsLogin) {
        const changed = nextOnline !== online || nextNeedsLogin !== needsLogin;
        online = nextOnline;
        needsLogin = nextNeedsLogin;

        if (changed) {
            onChange?.({ online, needsLogin });
        }
    }

    async function probe() {
        if (probing) {
            return online;
        }

        // A false here is conclusive; a true still needs confirming.
        if (navigator.onLine === false) {
            publish(false, needsLogin);

            return false;
        }

        probing = true;

        try {
            await ping(shopSlug);
            publish(true, false);
        } catch (error) {
            // Reachable-but-unauthenticated is its own state. It is NOT
            // "online" as far as the UI is concerned: showing a green Sync
            // button when syncing would actually fail is worse than useless,
            // so callers get needsLogin and paint a distinct warning instead.
            publish(false, error.needsLogin === true);
        } finally {
            probing = false;
        }

        return online;
    }

    function start() {
        probe();
        timer = window.setInterval(probe, intervalMs);
        window.addEventListener('online', probe);
        window.addEventListener('offline', probe);
    }

    function stop() {
        if (timer !== null) {
            window.clearInterval(timer);
            timer = null;
        }
        window.removeEventListener('online', probe);
        window.removeEventListener('offline', probe);
    }

    return {
        start,
        stop,
        probe,
        isOnline: () => online,
        needsLogin: () => needsLogin,
    };
}
