<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\LedgerEntryType;
use App\Enums\TransactionReferenceType;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Illuminate\Support\Facades\DB;

/**
 * The only writer of vendor_ledgers/customer_ledgers rows (see rules.md §2).
 * Every entry is inserted inside its own transaction with the owning
 * vendor/customer row locked, so concurrent postings can never race on
 * running_balance.
 */
class LedgerService
{
    public function postVendorEntry(
        Vendor $vendor,
        LedgerEntryType $type,
        string $amount,
        TransactionReferenceType $referenceType,
        int $referenceId,
        ?string $description,
        User $user,
    ): VendorLedger {
        return DB::transaction(function () use ($vendor, $type, $amount, $referenceType, $referenceId, $description, $user) {
            Vendor::query()->whereKey($vendor->id)->lockForUpdate()->firstOrFail();

            $previousBalance = (string) (VendorLedger::query()
                ->where('vendor_id', $vendor->id)
                ->latest('id')
                ->value('running_balance') ?? '0.00');

            $runningBalance = $type === LedgerEntryType::Credit
                ? bcadd($previousBalance, $amount, 2)
                : bcsub($previousBalance, $amount, 2);

            return VendorLedger::create([
                'shop_id' => $vendor->shop_id,
                'vendor_id' => $vendor->id,
                'debit' => $type === LedgerEntryType::Debit ? $amount : '0.00',
                'credit' => $type === LedgerEntryType::Credit ? $amount : '0.00',
                'running_balance' => $runningBalance,
                'reference_type' => $referenceType->value,
                'reference_id' => $referenceId,
                'description' => $description,
                'created_by' => $user->id,
            ]);
        });
    }

    public function postCustomerEntry(
        Customer $customer,
        LedgerEntryType $type,
        string $amount,
        TransactionReferenceType $referenceType,
        int $referenceId,
        ?string $description,
        User $user,
    ): CustomerLedger {
        return DB::transaction(function () use ($customer, $type, $amount, $referenceType, $referenceId, $description, $user) {
            Customer::query()->whereKey($customer->id)->lockForUpdate()->firstOrFail();

            $previousBalance = (string) (CustomerLedger::query()
                ->where('customer_id', $customer->id)
                ->latest('id')
                ->value('running_balance') ?? '0.00');

            $runningBalance = $type === LedgerEntryType::Debit
                ? bcadd($previousBalance, $amount, 2)
                : bcsub($previousBalance, $amount, 2);

            return CustomerLedger::create([
                'shop_id' => $customer->shop_id,
                'customer_id' => $customer->id,
                'debit' => $type === LedgerEntryType::Debit ? $amount : '0.00',
                'credit' => $type === LedgerEntryType::Credit ? $amount : '0.00',
                'running_balance' => $runningBalance,
                'reference_type' => $referenceType->value,
                'reference_id' => $referenceId,
                'description' => $description,
                'created_by' => $user->id,
            ]);
        });
    }
}
