<?php

declare(strict_types=1);

namespace App\Observers;

use App\Events\BatchExpiringSoon;
use App\Models\Batch;

class BatchObserver
{
    /**
     * Dispatch a freshness-check event whenever a batch is created or
     * updated and already falls within the expiry alert window — a
     * side-effect only, never a ledger/stock write (see rules.md §1.2).
     * The scheduled sweep (CheckExpiringBatches) covers batches that age
     * into the window without being saved again.
     */
    public function saved(Batch $batch): void
    {
        if ($batch->quantity_remaining > 0 && $batch->isExpiringSoon(30)) {
            BatchExpiringSoon::dispatch($batch);
        }
    }
}
