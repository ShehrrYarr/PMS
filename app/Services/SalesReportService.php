<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * Aggregate totals for the Sales Report page, computed across the full
 * filtered result set (not just the current pagination page).
 */
class SalesReportService
{
    /**
     * The raw sale_items queries below can't rely on BelongsToShop's global
     * scope (they're plain query-builder calls, not Eloquent), so they must
     * filter shop_id explicitly. Failing loudly here — rather than silently
     * dropping the filter via ->when() — is deliberate: this service is only
     * ever exercised behind an authenticated web request today, but a future
     * queued job or console command reusing it with no logged-in user must
     * not silently aggregate every shop's data instead.
     */
    private function resolveShopId(): int
    {
        return Auth::user()?->shop_id
            ?? throw new RuntimeException('SalesReportService requires an authenticated shop user.');
    }

    /**
     * @return array{sales_total: string, cost_total: string, profit_total: string, margin_percent: string, quantity_sold: ?string}
     */
    public function summary(?string $dateFrom, ?string $dateTo, ?int $customerId, ?int $productId = null): array
    {
        if ($productId !== null) {
            return $this->productSummary($dateFrom, $dateTo, $customerId, $productId);
        }

        $salesTotal = (string) Sale::query()
            ->when($dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($q) => $q->whereDate('created_at', '<=', $dateTo))
            ->when($customerId, fn ($q) => $q->where('customer_id', $customerId))
            ->sum('total_amount');

        $costTotal = (string) DB::table('sale_items')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->where('sale_items.shop_id', $this->resolveShopId())
            ->when($dateFrom, fn ($q) => $q->whereDate('sales.created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($q) => $q->whereDate('sales.created_at', '<=', $dateTo))
            ->when($customerId, fn ($q) => $q->where('sales.customer_id', $customerId))
            ->sum(DB::raw('sale_items.quantity * COALESCE(sale_items.cost_price, 0)'));

        return $this->normalizeSummary($salesTotal, $costTotal, null);
    }

    /**
     * @return array{sales_total: string, cost_total: string, profit_total: string, margin_percent: string, quantity_sold: string}
     */
    private function productSummary(?string $dateFrom, ?string $dateTo, ?int $customerId, int $productId): array
    {
        $query = DB::table('sale_items')
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->join('batches', 'batches.id', '=', 'sale_items.batch_id')
            ->where('sale_items.shop_id', $this->resolveShopId())
            ->where('batches.product_id', $productId)
            ->when($dateFrom, fn ($q) => $q->whereDate('sales.created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($q) => $q->whereDate('sales.created_at', '<=', $dateTo))
            ->when($customerId, fn ($q) => $q->where('sales.customer_id', $customerId));

        $salesTotal = (string) (clone $query)->sum('sale_items.line_total');
        $costTotal = (string) (clone $query)->sum(DB::raw('sale_items.quantity * COALESCE(sale_items.cost_price, 0)'));
        $quantitySold = (string) (clone $query)->sum('sale_items.quantity');

        return $this->normalizeSummary($salesTotal, $costTotal, bcadd($quantitySold, '0.00', 2));
    }

    /**
     * @return array{sales_total: string, cost_total: string, profit_total: string, margin_percent: string, quantity_sold: ?string}
     */
    private function normalizeSummary(string $salesTotal, string $costTotal, ?string $quantitySold): array
    {
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
            'quantity_sold' => $quantitySold,
        ];
    }
}
