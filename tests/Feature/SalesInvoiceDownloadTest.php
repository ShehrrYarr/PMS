<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Enums\UserRole;
use App\Models\Batch;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesInvoiceDownloadTest extends TestCase
{
    use RefreshDatabase;

    private function userWithRole(UserRole $role): User
    {
        $user = User::factory()->create();
        $user->assignRole($role->value);

        return $user;
    }

    private function makeSale(User $user): Sale
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();

        $batch = Batch::query()->create([
            'shop_id' => $user->shop_id,
            'product_id' => $product->id,
            'barcode' => 'BC-INV-'.$user->id,
            'manufacturing_date' => '2026-01-01',
            'expiry_date' => '2027-01-01',
            'cost_price' => '60.00',
            'quantity_received' => '100',
            'quantity_remaining' => '90',
        ]);

        $sale = Sale::query()->create([
            'shop_id' => $user->shop_id,
            'invoice_number' => 'SL-INV-'.$user->id,
            'customer_id' => $customer->id,
            'user_id' => $user->id,
            'total_amount' => '1000.00',
            'status' => 'completed',
        ]);

        SaleItem::query()->create([
            'shop_id' => $user->shop_id,
            'sale_id' => $sale->id,
            'batch_id' => $batch->id,
            'quantity' => '10',
            'unit_price' => '100.00',
            'cost_price' => '60.00',
            'line_total' => '1000.00',
        ]);

        Payment::query()->create([
            'shop_id' => $user->shop_id,
            'payable_type' => PayableType::Sale->value,
            'payable_id' => $sale->id,
            'method' => PaymentMethod::Cash->value,
            'amount' => '1000.00',
            'user_id' => $user->id,
        ]);

        return $sale;
    }

    public function test_salesman_is_forbidden_from_downloading_the_invoice(): void
    {
        $salesman = $this->userWithRole(UserRole::Salesman);
        $sale = $this->makeSale($salesman);

        $this->actingAs($salesman)
            ->get($this->shopPath($salesman, "sales/{$sale->id}/invoice"))
            ->assertForbidden();
    }

    public function test_admin_inventory_manager_and_accountant_can_download_the_invoice(): void
    {
        foreach ([UserRole::Admin, UserRole::InventoryManager, UserRole::Accountant] as $role) {
            $user = $this->userWithRole($role);
            $sale = $this->makeSale($user);

            $response = $this->actingAs($user)->get($this->shopPath($user, "sales/{$sale->id}/invoice"));

            $response->assertOk();
            $response->assertHeader('content-type', 'application/pdf');
            $this->assertStringContainsString(
                "invoice-{$sale->invoice_number}.pdf",
                (string) $response->headers->get('content-disposition'),
            );
        }
    }
}
