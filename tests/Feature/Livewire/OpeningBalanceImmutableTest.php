<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\UserRole;
use App\Livewire\Customers\CustomerList;
use App\Livewire\Vendors\VendorList;
use App\Models\Customer;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OpeningBalanceImmutableTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Admin->value);

        return $user;
    }

    public function test_editing_a_vendor_cannot_change_its_opening_balance(): void
    {
        $user = $this->admin();
        $vendor = Vendor::factory()->create(['opening_balance' => '1000.00']);

        Livewire::actingAs($user)
            ->test(VendorList::class)
            ->call('edit', $vendor->id)
            ->set('form.name', 'Renamed Vendor')
            ->set('form.opening_balance', '5000.00')
            ->call('save');

        $vendor->refresh();
        $this->assertSame('Renamed Vendor', $vendor->name);
        $this->assertSame('1000.00', $vendor->opening_balance);
    }

    public function test_editing_a_customer_cannot_change_its_opening_balance(): void
    {
        $user = $this->admin();
        $customer = Customer::factory()->create(['opening_balance' => '1000.00']);

        Livewire::actingAs($user)
            ->test(CustomerList::class)
            ->call('edit', $customer->id)
            ->set('form.name', 'Renamed Customer')
            ->set('form.opening_balance', '5000.00')
            ->call('save');

        $customer->refresh();
        $this->assertSame('Renamed Customer', $customer->name);
        $this->assertSame('1000.00', $customer->opening_balance);
    }
}
