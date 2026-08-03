<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\TransactionReferenceType;
use App\Enums\UserRole;
use App\Livewire\Customers\CustomerLedger;
use App\Livewire\Vendors\VendorLedger;
use App\Models\Customer;
use App\Models\CustomerLedger as CustomerLedgerModel;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorLedger as VendorLedgerModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class LedgerPaginationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Admin->value);

        return $user;
    }

    public function test_vendor_ledger_date_filter_resets_pagination_to_a_page_with_results(): void
    {
        $user = $this->admin();
        $vendor = Vendor::factory()->create();

        // 5 old rows (ids 1-5), then 20 recent rows (ids 6-25). Ordered by
        // latest('id'), page 1 (20/page) holds the 20 recent rows and page 2
        // holds the 5 old ones.
        for ($i = 0; $i < 5; $i++) {
            $entry = VendorLedgerModel::query()->create([
                'shop_id' => $vendor->shop_id,
                'vendor_id' => $vendor->id,
                'debit' => '100.00',
                'credit' => '0.00',
                'running_balance' => '100.00',
                'reference_type' => TransactionReferenceType::Payment->value,
                'reference_id' => 1,
                'description' => 'Old entry',
                'created_by' => $user->id,
            ]);
            $entry->forceFill(['created_at' => Carbon::today()->subDays(60)])->save();
        }

        for ($i = 0; $i < 20; $i++) {
            VendorLedgerModel::query()->create([
                'shop_id' => $vendor->shop_id,
                'vendor_id' => $vendor->id,
                'debit' => '50.00',
                'credit' => '0.00',
                'running_balance' => '50.00',
                'reference_type' => TransactionReferenceType::Payment->value,
                'reference_id' => 2,
                'description' => 'Recent entry',
                'created_by' => $user->id,
            ]);
        }

        $test = Livewire::actingAs($user)
            ->test(VendorLedger::class, ['vendor' => $vendor])
            ->call('gotoPage', 2);

        $this->assertSame(5, $test->viewData('entries')->count());

        $test->set('dateTo', Carbon::today()->subDays(30)->format('Y-m-d'));

        $entries = $test->viewData('entries');
        $this->assertSame(1, $entries->currentPage());
        $this->assertSame(5, $entries->total());
        $this->assertCount(5, $entries->items());
    }

    public function test_customer_ledger_date_filter_resets_pagination_to_a_page_with_results(): void
    {
        $user = $this->admin();
        $customer = Customer::factory()->create();

        for ($i = 0; $i < 5; $i++) {
            $entry = CustomerLedgerModel::query()->create([
                'shop_id' => $customer->shop_id,
                'customer_id' => $customer->id,
                'debit' => '0.00',
                'credit' => '100.00',
                'running_balance' => '-100.00',
                'reference_type' => TransactionReferenceType::Payment->value,
                'reference_id' => 1,
                'description' => 'Old entry',
                'created_by' => $user->id,
            ]);
            $entry->forceFill(['created_at' => Carbon::today()->subDays(60)])->save();
        }

        for ($i = 0; $i < 20; $i++) {
            CustomerLedgerModel::query()->create([
                'shop_id' => $customer->shop_id,
                'customer_id' => $customer->id,
                'debit' => '0.00',
                'credit' => '50.00',
                'running_balance' => '-50.00',
                'reference_type' => TransactionReferenceType::Payment->value,
                'reference_id' => 2,
                'description' => 'Recent entry',
                'created_by' => $user->id,
            ]);
        }

        $test = Livewire::actingAs($user)
            ->test(CustomerLedger::class, ['customer' => $customer])
            ->call('gotoPage', 2);

        $this->assertSame(5, $test->viewData('entries')->count());

        $test->set('dateTo', Carbon::today()->subDays(30)->format('Y-m-d'));

        $entries = $test->viewData('entries');
        $this->assertSame(1, $entries->currentPage());
        $this->assertSame(5, $entries->total());
        $this->assertCount(5, $entries->items());
    }
}
