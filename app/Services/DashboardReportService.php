<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Powers the dashboard's "Today's Report" widget. All money values are
 * bcmath-normalized strings (see rules.md §2), never floats.
 */
class DashboardReportService
{
    /**
     * @return array{
     *     sales_total: string,
     *     returns_total: string,
     *     payment_ins_total: string,
     *     expenses_total: string,
     *     cash_total: string,
     *     bank_total: string,
     *     bank_breakdown: list<array{bank_id: int, name: string, amount: string}>,
     * }
     */
    public function todaysSummary(): array
    {
        $today = Carbon::today();

        $salesTotal = $this->normalize((string) Sale::query()->whereDate('created_at', $today)->sum('total_amount'));
        $returnsTotal = $this->normalize((string) SaleReturn::query()->whereDate('created_at', $today)->sum('total_amount'));

        $paymentInsTotal = $this->normalize((string) Payment::query()
            ->where('payable_type', PayableType::Customer->value)
            ->whereDate('created_at', $today)
            ->sum('amount'));

        $expensesTotal = $this->normalize((string) Expense::query()->whereDate('date', $today)->sum('amount'));

        $salePayments = Payment::query()
            ->where('payable_type', PayableType::Sale->value)
            ->whereDate('created_at', $today)
            ->with('bank')
            ->get();

        $cashTotal = '0.00';
        /** @var array<int, array{bank_id: int, name: string, amount: string}> $banks */
        $banks = [];

        foreach ($salePayments as $payment) {
            if ($payment->method === PaymentMethod::Cash) {
                $cashTotal = bcadd($cashTotal, (string) $payment->amount, 2);
            } elseif ($payment->method === PaymentMethod::Bank && $payment->bank_id !== null) {
                $banks[$payment->bank_id] ??= [
                    'bank_id' => $payment->bank_id,
                    'name' => $payment->bank?->name ?? '—',
                    'amount' => '0.00',
                ];
                $banks[$payment->bank_id]['amount'] = bcadd($banks[$payment->bank_id]['amount'], (string) $payment->amount, 2);
            }
        }

        $bankTotal = array_reduce($banks, fn (string $carry, array $bank) => bcadd($carry, $bank['amount'], 2), '0.00');

        return [
            'sales_total' => $salesTotal,
            'returns_total' => $returnsTotal,
            'payment_ins_total' => $paymentInsTotal,
            'expenses_total' => $expensesTotal,
            'cash_total' => $cashTotal,
            'bank_total' => $bankTotal,
            'bank_breakdown' => array_values($banks),
        ];
    }

    /**
     * Daily sales totals for the trailing $days days (oldest first), with
     * zero-filled entries for any day that had no sales.
     *
     * @return list<array{date: string, total: string}>
     */
    public function salesTrend(int $days = 30): array
    {
        $from = Carbon::today()->subDays($days - 1);

        $rows = Sale::query()
            ->selectRaw('DATE(created_at) as sale_date, SUM(total_amount) as total')
            ->whereDate('created_at', '>=', $from)
            ->groupBy('sale_date')
            ->pluck('total', 'sale_date');

        $trend = [];

        for ($i = 0; $i < $days; $i++) {
            $date = $from->copy()->addDays($i);
            $key = $date->format('Y-m-d');

            $trend[] = [
                'date' => $date->format('d M'),
                'total' => $this->normalize((string) ($rows[$key] ?? '0')),
            ];
        }

        return $trend;
    }

    /**
     * Cash vs. per-bank totals for sale payments over the trailing $days days.
     *
     * @return array{cash: string, banks: list<array{name: string, amount: string}>}
     */
    public function cashVsBankBreakdown(int $days = 30): array
    {
        $from = Carbon::today()->subDays($days - 1);

        $payments = Payment::query()
            ->where('payable_type', PayableType::Sale->value)
            ->whereDate('created_at', '>=', $from)
            ->with('bank')
            ->get();

        $cashTotal = '0.00';
        /** @var array<int, array{name: string, amount: string}> $banks */
        $banks = [];

        foreach ($payments as $payment) {
            if ($payment->method === PaymentMethod::Cash) {
                $cashTotal = bcadd($cashTotal, (string) $payment->amount, 2);
            } elseif ($payment->method === PaymentMethod::Bank && $payment->bank_id !== null) {
                $banks[$payment->bank_id] ??= ['name' => $payment->bank?->name ?? '—', 'amount' => '0.00'];
                $banks[$payment->bank_id]['amount'] = bcadd($banks[$payment->bank_id]['amount'], (string) $payment->amount, 2);
            }
        }

        return [
            'cash' => $cashTotal,
            'banks' => array_values($banks),
        ];
    }

    /**
     * Best-selling products by quantity sold over the trailing $days days.
     *
     * @return list<array{name: string, quantity: string}>
     */
    public function topSellingProducts(int $days = 30, int $limit = 8): array
    {
        $from = Carbon::today()->subDays($days - 1);

        return SaleItem::query()
            ->join('sales', 'sales.id', '=', 'sale_items.sale_id')
            ->join('batches', 'batches.id', '=', 'sale_items.batch_id')
            ->join('products', 'products.id', '=', 'batches.product_id')
            ->whereDate('sales.created_at', '>=', $from)
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('quantity')
            ->limit($limit)
            ->select('products.name', DB::raw('SUM(sale_items.quantity) as quantity'))
            ->get()
            ->map(fn ($row) => ['name' => $row->name, 'quantity' => $this->normalize((string) $row->quantity)])
            ->all();
    }

    private function normalize(string $value): string
    {
        return bcadd($value, '0.00', 2);
    }
}
