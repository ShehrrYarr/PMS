<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\LedgerEntryType;
use App\Enums\TransactionReferenceType;
use App\Models\Customer;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorLedger;
use App\Services\LedgerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LogicException;
use Tests\TestCase;

class LedgerServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_first_entry_computes_running_balance_from_zero(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $service = new LedgerService;

        $entry = $service->postVendorEntry(
            vendor: $vendor,
            type: LedgerEntryType::Credit,
            amount: '5000.00',
            referenceType: TransactionReferenceType::Purchase,
            referenceId: 1,
            description: 'Opening balance',
            user: $user,
        );

        $this->assertSame('5000.00', $entry->running_balance);
    }

    public function test_running_balance_accumulates_correctly_across_entries(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $service = new LedgerService;

        $service->postVendorEntry($vendor, LedgerEntryType::Credit, '5000.00', TransactionReferenceType::Purchase, 1, null, $user);
        $service->postVendorEntry($vendor, LedgerEntryType::Debit, '1500.00', TransactionReferenceType::Payment, 2, null, $user);
        $third = $service->postVendorEntry($vendor, LedgerEntryType::Credit, '800.00', TransactionReferenceType::Purchase, 3, null, $user);

        // 5000 (credit) - 1500 (debit) + 800 (credit) = 4300
        $this->assertSame('4300.00', $third->running_balance);
        $this->assertSame('4300.00', $vendor->currentBalance());
    }

    public function test_customer_debit_increases_balance_and_credit_decreases_it(): void
    {
        $customer = Customer::factory()->create();
        $user = User::factory()->create();
        $service = new LedgerService;

        $service->postCustomerEntry($customer, LedgerEntryType::Debit, '2000.00', TransactionReferenceType::Sale, 1, null, $user);
        $second = $service->postCustomerEntry($customer, LedgerEntryType::Credit, '800.00', TransactionReferenceType::SaleReturn, 2, null, $user);

        $this->assertSame('1200.00', $second->running_balance);
    }

    public function test_a_prior_ledger_row_is_never_mutated_by_a_later_posting(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $service = new LedgerService;

        $first = $service->postVendorEntry($vendor, LedgerEntryType::Credit, '5000.00', TransactionReferenceType::Purchase, 1, null, $user);
        $service->postVendorEntry($vendor, LedgerEntryType::Debit, '1500.00', TransactionReferenceType::Payment, 2, null, $user);

        $firstFresh = VendorLedger::query()->findOrFail($first->id);

        $this->assertSame('0.00', $firstFresh->debit);
        $this->assertSame('5000.00', $firstFresh->credit);
        $this->assertSame('5000.00', $firstFresh->running_balance);
    }

    public function test_vendor_ledger_rows_cannot_be_updated(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $entry = (new LedgerService)->postVendorEntry($vendor, LedgerEntryType::Credit, '100.00', TransactionReferenceType::Purchase, 1, null, $user);

        $this->expectException(LogicException::class);

        $entry->update(['debit' => '999.00']);
    }

    public function test_vendor_ledger_rows_cannot_be_deleted(): void
    {
        $vendor = Vendor::factory()->create();
        $user = User::factory()->create();
        $entry = (new LedgerService)->postVendorEntry($vendor, LedgerEntryType::Credit, '100.00', TransactionReferenceType::Purchase, 1, null, $user);

        $this->expectException(LogicException::class);

        $entry->delete();
    }
}
