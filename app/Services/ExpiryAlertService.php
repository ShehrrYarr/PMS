<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/**
 * Read-side query service backing the "Expiring Soon" dashboard (see
 * prd.md §2.3) and the scheduled sweep (CheckExpiringBatches). Always
 * computed live from batches — there is no separate alerts table, so the
 * list is queryable on-demand at any time, not just via the schedule.
 */
class ExpiryAlertService
{
    /**
     * Batches within the given window that still have stock to sell,
     * soonest-expiring first.
     *
     * @return Collection<int, Batch>
     */
    public function expiringWithin(int $days = 30): Collection
    {
        return Batch::query()
            ->with('product')
            ->where('quantity_remaining', '>', 0)
            ->whereDate('expiry_date', '<=', Carbon::today()->addDays($days))
            ->orderBy('expiry_date')
            ->get();
    }
}
