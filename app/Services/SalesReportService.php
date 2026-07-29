<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;

/**
 * Aggregate totals for the Sales Report page, computed across the full
 * filtered result set (not just the current pagination page).
 */
class SalesReportService
{
    /**
     * @return array{sales_total: string, cost_total: string, profit_total: string, margin_percent: string}
     */
    public function summary(?string $dateFrom, ?string $dateTo, ?int $customerId): array
    {
        $salesTotal = (string) Sale::query()
            ->when($dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($q) => $q->whereDate('created_at', '<=', $dateTo))
            ->when($customerId, fn ($q) => $q->where('customer_id', $customerId))
            ->sum('total_amount');

        $costTotal = (string) DB::table('sale_items')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->when($dateFrom, fn ($q) => $q->whereDate('sales.created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($q) => $q->whereDate('sales.created_at', '<=', $dateTo))
            ->when($customerId, fn ($q) => $q->where('sales.customer_id', $customerId))
            ->sum(DB::raw('sale_items.quantity * COALESCE(sale_items.cost_price, 0)'));

        $salesTotal = bcadd($salesTotal, '0.00', 2);
        $costTotal = bcadd($costTotal, '0.00', 2);
        $profitTotal = bcsub($salesTotal, $costTotal, 2);

        $marginPercent = bccomp($salesTotal, '0.00', 2) > 0
            ? bcmul(bcdiv($profitTotal, $salesTotal, 4), '100', 2)
            : '0.00';

        return [
            'sales_total' => $salesTotal,
            'cost_total' => $costTotal,
            'profit_total' => $profitTotal,
            'margin_percent' => $marginPercent,
        ];
    }
}
