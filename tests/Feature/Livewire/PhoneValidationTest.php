<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Enums\UserRole;
use App\Livewire\Customers\CustomerList;
use App\Livewire\Vendors\VendorList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PhoneValidationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole(UserRole::Admin->value);

        return $user;
    }

    public function test_vendor_phone_rejects_letters(): void
    {
        Livewire::actingAs($this->admin())
            ->test(VendorList::class)
            ->call('create')
            ->set('form.name', 'Some Vendor')
            ->set('form.phone', 'not-a-phone-number')
            ->call('save')
            ->assertHasErrors(['form.phone']);
    }

    public function test_vendor_phone_accepts_a_normal_format(): void
    {
        Livewire::actingAs($this->admin())
            ->test(VendorList::class)
            ->call('create')
            ->set('form.name', 'Some Vendor')
            ->set('form.phone', '0300-1234567')
            ->call('save')
            ->assertHasNoErrors();
    }

    public function test_customer_phone_rejects_letters(): void
    {
        Livewire::actingAs($this->admin())
            ->test(CustomerList::class)
            ->call('create')
            ->set('form.name', 'Some Customer')
            ->set('form.phone', 'not-a-phone-number')
            ->call('save')
            ->assertHasErrors(['form.phone']);
    }

    public function test_customer_phone_accepts_a_normal_format(): void
    {
        Livewire::actingAs($this->admin())
            ->test(CustomerList::class)
            ->call('create')
            ->set('form.name', 'Some Customer')
            ->set('form.phone', '+92 300 1234567')
            ->call('save')
            ->assertHasNoErrors();
    }
}
