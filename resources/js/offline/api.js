/**
 * Server calls for the offline POS.
 *
 * Everything here is defensive about one specific failure: fetch() follows
 * redirects transparently, so a 302 to the login page arrives looking like a
 * successful 200 with an HTML body. A caller that trusted `response.ok` would
 * mark a queue of real, paid-for sales as synced and delete them. So every
 * response is checked for JSON content-type before it counts as success, and
 * redirects are never followed.
 */

export class OfflineApiError extends Error {
    constructor(message, { status = 0, needsLogin = false } = {}) {
        super(message);
        this.name = 'OfflineApiError';
        this.status = status;
        this.needsLogin = needsLogin;
    }
}

/**
 * Whatever precedes "/{shopSlug}/" in the current page's own URL, so every
 * hand-built app URL keeps working whether the app is hosted at a domain
 * root or under a subdirectory (e.g. "/pms") — no deployment-specific
 * config needed.
 */
export function basePath(shopSlug) {
    const marker = `/${shopSlug}/`;
    const markerIndex = window.location.pathname.indexOf(marker);

    return markerIndex === -1 ? '' : window.location.pathname.slice(0, markerIndex);
}

function shopUrl(shopSlug, path) {
    return `${basePath(shopSlug)}/${shopSlug}/${path}`;
}

async function readJson(response) {
    const contentType = response.headers.get('content-type') ?? '';

    if (!contentType.includes('application/json')) {
        // An HTML body here means we were bounced to a login or error page.
        throw new OfflineApiError('Server did not return JSON — the session has probably expired.', {
            status: response.status,
            needsLogin: true,
        });
    }

    return response.json();
}

/**
 * A captive portal or black-holed connection can leave a fetch pending for
 * minutes. Without a ceiling the connectivity probe would never settle and the
 * online/offline indicator would freeze on its last value.
 */
const DEFAULT_TIMEOUT_MS = 12000;

async function request(url, { timeoutMs = DEFAULT_TIMEOUT_MS, ...options } = {}) {
    let response;

    const controller = new AbortController();
    const timer = setTimeout(() => controller.abort(), timeoutMs);

    try {
        response = await fetch(url, {
            ...options,
            signal: controller.signal,
            // Never silently follow a bounce to the login page.
            redirect: 'manual',
            credentials: 'same-origin',
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                ...(options.headers ?? {}),
            },
        });
    } catch (error) {
        throw new OfflineApiError(
            error.name === 'AbortError'
                ? 'Server did not respond in time.'
                : `Network unreachable: ${error.message}`,
        );
    } finally {
        clearTimeout(timer);
    }

    // An opaque redirect is what `redirect: 'manual'` gives us instead of
    // quietly following the 302 — treat it as "log in again", never success.
    if (response.type === 'opaqueredirect' || response.status === 0) {
        throw new OfflineApiError('Redirected instead of answering — session expired.', {
            needsLogin: true,
        });
    }

    if (response.status === 401 || response.status === 419) {
        throw new OfflineApiError('Session expired. Sign in again to sync.', {
            status: response.status,
            needsLogin: true,
        });
    }

    if (!response.ok) {
        let message = `Request failed (${response.status}).`;

        try {
            const body = await readJson(response);
            message = body.message ?? message;
        } catch {
            // Keep the generic message — the body wasn't usable JSON.
        }

        throw new OfflineApiError(message, { status: response.status });
    }

    return readJson(response);
}

/**
 * Confirms the server is genuinely reachable AND the session is alive, and
 * hands back a fresh CSRF token. Tokens are never cached: they rotate with the
 * session, so one stored alongside the offline page would be stale by the time
 * a queue is finally pushed.
 */
export function ping(shopSlug) {
    return request(shopUrl(shopSlug, 'pos/ping'));
}

export function fetchOfflineData(shopSlug, deviceId = null) {
    const query = deviceId !== null ? `?device_id=${encodeURIComponent(deviceId)}` : '';

    return request(shopUrl(shopSlug, `pos/offline-data${query}`));
}

export function syncQueue(shopSlug, csrfToken, payload) {
    return request(shopUrl(shopSlug, 'pos/sync'), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(payload),
    });
}
