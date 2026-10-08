<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Livewire\Inventory\ProductList;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $admin = User::factory()->create();
        $admin->assignRole(UserRole::Admin->value);

        return $admin;
    }

    private function fillNewProduct(Testable $component, string $sku = 'SKU-IMG-1'): Testable
    {
        return $component
            ->call('create')
            ->set('form.name', 'Karate 5EC')
            ->set('form.sku', $sku)
            ->set('form.unit', 'Bottle')
            ->set('form.default_sale_price', '950');
    }

    public function test_a_product_can_be_created_without_an_image(): void
    {
        Storage::fake('public');

        $this->fillNewProduct(Livewire::actingAs($this->admin())->test(ProductList::class))
            ->call('save')
            ->assertHasNoErrors();

        $product = Product::query()->where('sku', 'SKU-IMG-1')->firstOrFail();

        $this->assertNull($product->image_path);
        $this->assertNull($product->imageUrl());
    }

    public function test_creating_a_product_with_an_image_stores_it_under_the_shops_folder(): void
    {
        Storage::fake('public');
        $admin = $this->admin();

        $this->fillNewProduct(Livewire::actingAs($admin)->test(ProductList::class))
            ->set('form.image', UploadedFile::fake()->image('karate.png', 600, 600))
            ->call('save')
            ->assertHasNoErrors();

        $product = Product::query()->where('sku', 'SKU-IMG-1')->firstOrFail();

        $this->assertNotNull($product->image_path);
        $this->assertStringStartsWith("products/{$admin->shop_id}/{$product->id}-", $product->image_path);
        $this->assertStringEndsWith('.png', $product->image_path);
        Storage::disk('public')->assertExists($product->image_path);
    }

    public function test_an_svg_image_is_rejected(): void
    {
        Storage::fake('public');

        $svg = UploadedFile::fake()->createWithContent(
            'evil.svg',
            '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(document.domain)</script></svg>',
        );

        $this->fillNewProduct(Livewire::actingAs($this->admin())->test(ProductList::class))
            ->set('form.image', $svg)
            ->assertHasErrors(['form.image'])
            ->call('save')
            ->assertHasErrors(['form.image']);

        $this->assertFalse(Product::query()->where('sku', 'SKU-IMG-1')->exists());
    }

    public function test_an_image_over_two_megabytes_is_rejected(): void
    {
        Storage::fake('public');

        $this->fillNewProduct(Livewire::actingAs($this->admin())->test(ProductList::class))
            ->set('form.image', UploadedFile::fake()->image('huge.jpg')->size(3000))
            ->call('save')
            ->assertHasErrors(['form.image']);
    }

    public function test_replacing_an_image_deletes_the_old_file(): void
    {
        Storage::fake('public');
        $admin = $this->admin();

        $component = $this->fillNewProduct(Livewire::actingAs($admin)->test(ProductList::class))
            ->set('form.image', UploadedFile::fake()->image('first.png'))
            ->call('save');

        $product = Product::query()->where('sku', 'SKU-IMG-1')->firstOrFail();
        $firstPath = $product->image_path;

        $component
            ->call('edit', $product->id)
            ->assertSet('form.existingImagePath', $firstPath)
            ->set('form.image', UploadedFile::fake()->image('second.webp'))
            ->call('save')
            ->assertHasNoErrors();

        $secondPath = $product->fresh()->image_path;

        $this->assertNotSame($firstPath, $secondPath);
        $this->assertStringEndsWith('.webp', $secondPath);
        Storage::disk('public')->assertMissing($firstPath);
        Storage::disk('public')->assertExists($secondPath);
    }

    public function test_removing_an_image_deletes_the_file_and_clears_the_path(): void
    {
        Storage::fake('public');

        $component = $this->fillNewProduct(Livewire::actingAs($this->admin())->test(ProductList::class))
            ->set('form.image', UploadedFile::fake()->image('first.png'))
            ->call('save');

        $product = Product::query()->where('sku', 'SKU-IMG-1')->firstOrFail();
        $path = $product->image_path;

        $component
            ->call('edit', $product->id)
            ->call('removeImage')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertNull($product->fresh()->image_path);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_editing_other_fields_keeps_the_existing_image(): void
    {
        Storage::fake('public');

        $component = $this->fillNewProduct(Livewire::actingAs($this->admin())->test(ProductList::class))
            ->set('form.image', UploadedFile::fake()->image('first.png'))
            ->call('save');

        $product = Product::query()->where('sku', 'SKU-IMG-1')->firstOrFail();
        $path = $product->image_path;

        $component
            ->call('edit', $product->id)
            ->set('form.name', 'Karate 5EC (renamed)')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame($path, $product->fresh()->image_path);
        Storage::disk('public')->assertExists($path);
    }

    public function test_a_salesman_cannot_remove_a_products_image(): void
    {
        $salesman = User::factory()->create();
        $salesman->assignRole(UserRole::Salesman->value);

        Livewire::actingAs($salesman)
            ->test(ProductList::class)
            ->call('removeImage')
            ->assertForbidden();
    }
}
