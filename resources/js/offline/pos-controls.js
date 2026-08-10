/**
 * The "Go Offline" and "Sync Sales" controls on the ONLINE POS screen.
 *
 * Lives in the main bundle because it appears on a normal page, so it
 * deliberately imports none of the heavy offline machinery — no jsPDF, no cart
 * engine. Just enough to prepare a till, report connection state, and push a
 * queue back.
 */

import { createOfflineSession, STALE_WARNING_HOURS } from './session';

document.addEventListener('alpine:init', () => {
    Alpine.data('posOfflineControls', (config) => ({
        shopSlug: config.shopSlug,
        userId: config.userId,
        translations: config.translations,

        session: null,
        monitor: null,

        online: false,
        needsLogin: false,
        pending: 0,
        prepared: false,
        snapshotAgeHours: null,

        error: '',
        notice: '',
        busy: false,

        refreshTimer: null,

        async init() {
            this.session = createOfflineSession(this.shopSlug, this.userId);

            this.monitor = this.session.monitor({
                onChange: ({ online, needsLogin }) => {
                    this.online = online;
                    this.needsLogin = needsLogin;
                },
            });
            this.monitor.start();

            this.prepared = await this.session.hasCache();
            await this.updateCounters();

            // Background top-up so an already-prepared till doesn't drift far
            // from real stock — best-effort, never interrupts a sale.
            this.refreshTimer = window.setInterval(() => {
                if (this.online && this.prepared) {
                    this.session.refresh().then(() => this.updateCounters());
                }
            }, 600000);

            // Livewire's SPA navigation swaps the DOM without a reload, so the
            // interval and listeners have to be torn down explicitly.
            document.addEventListener('livewire:navigating', () => this.teardown(), { once: true });
        },

        teardown() {
            this.monitor?.stop();

            if (this.refreshTimer !== null) {
                window.clearInterval(this.refreshTimer);
                this.refreshTimer = null;
            }
        },

        async updateCounters() {
            try {
                this.pending = await this.session.pendingCount();
                this.snapshotAgeHours = await this.session.snapshotAgeHours();
            } catch {
                this.pending = 0;
            }
        },

        get isStale() {
            return this.snapshotAgeHours !== null && this.snapshotAgeHours > STALE_WARNING_HOURS;
        },

        /**
         * Green when the server is genuinely reachable, red when it isn't, and
         * amber for the in-between case where the network is fine but the
         * session has expired — showing green there would promise a sync that
         * is going to fail.
         */
        get syncButtonClass() {
            if (this.needsLogin) {
                return 'bg-[var(--color-warning)] text-white';
            }

            return this.online
                ? 'bg-[var(--color-success)] text-white'
                : 'bg-[var(--color-danger)] text-white';
        },

        get syncLabel() {
            return this.pending > 0
                ? this.translations.sync_sales_count.replace(':count', String(this.pending))
                : this.translations.sync_sales;
        },

        async goOffline() {
            this.error = '';
            this.busy = true;

            try {
                const { persisted } = await this.session.prepare();

                this.prepared = true;
                await this.updateCounters();

                this.notice = persisted
                    ? this.translations.offline_ready
                    : this.translations.offline_ready_not_persisted;

                window.location.href = `/${this.shopSlug}/pos/offline`;
            } catch (error) {
                this.error = error.needsLogin
                    ? this.translations.sign_in_to_sync
                    : (error.message ?? this.translations.offline_prepare_failed);
            } finally {
                this.busy = false;
            }
        },

        openOfflineTill() {
            window.location.href = `/${this.shopSlug}/pos/offline`;
        },

        async syncNow() {
            this.busy = true;
            this.notice = '';

            try {
                const result = await this.session.sync();
                this.notice = this.translations.sync_result
                    .replace(':synced', String(result.synced))
                    .replace(':rejected', String(result.rejected));
                await this.updateCounters();
            } catch (error) {
                this.notice = error.needsLogin
                    ? this.translations.sign_in_to_sync
                    : this.translations.sync_failed;
            } finally {
                this.busy = false;
            }
        },
    }));
});
