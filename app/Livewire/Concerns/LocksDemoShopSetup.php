<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

/**
 * The public demo shop keeps whatever visitors do with it (it is never reset),
 * and every visitor is logged in as its Admin. Shop setup — settings,
 * branding, receipt text, bank accounts, banners and the demo account's own
 * profile — is therefore read-only there, so no visitor can deface the shop
 * (or delete the account "See Demo" logs into) for the next one. Everything
 * else stays fully usable.
 *
 * The forms are also disabled in the view (<x-demo-setup-lock>); this is the
 * server-side half, since a disabled input is only a courtesy.
 */
trait LocksDemoShopSetup
{
    /**
     * Call at the top of every write action, after authorize():
     * `if ($this->blockedInDemoShop()) { return; }`
     */
    protected function blockedInDemoShop(): bool
    {
        if (! auth()->user()?->inDemoShop()) {
            return false;
        }

        $this->addError('demo', __('demo.setup_locked'));

        return true;
    }
}
