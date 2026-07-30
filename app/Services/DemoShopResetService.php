<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Bank;
use App\Models\Banner;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\PurchaseReturn;
use App\Models\PurchaseReturnItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use App\Models\SaleReturnItem;
use App\Models\Shop;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\DB;

/**
 * Wipes every bit of business data (products, batches, sales, purchases,
 * vendors, customers, ledgers, expenses, ...) out of the shared public demo
 * shop and reseeds a clean baseline — the shop row itself, its role users,
 * and its theme/receipt settings are left untouched so the "See Demo" login
 * and branding keep working. Run on a schedule (routes/console.php) so
 * whatever a visitor does to the demo is only ever temporary.
 */
class DemoShopResetService
{
    /**
     * Deletion order would normally have to walk every restrictOnDelete
     * foreign key backwards (payments -> items -> sales/purchases -> ...).
     * Disabling FK checks for the duration of these shop_id-scoped deletes
     * sidesteps that entirely without risking other shops' data, since every
     * delete below is still filtered to this one shop_id.
     *
     * @var list<class-string<\Illuminate\Database\Eloquent\Model>>
     */
    private const SHOP_SCOPED_MODELS = [
        Payment::class,
        SaleReturnItem::class,
        PurchaseReturnItem::class,
        SaleReturn::class,
        PurchaseReturn::class,
        SaleItem::class,
        PurchaseItem::class,
        Sale::class,
        Purchase::class,
        CustomerLedger::class,
        VendorLedger::class,
        Batch::class,
        Expense::class,
        Product::class,
        Category::class,
        Company::class,
        Customer::class,
        Vendor::class,
        Bank::class,
        Banner::class,
        ExpenseCategory::class,
    ];

    public function reset(): void
    {
        $shop = Shop::query()->where('is_demo', true)->first();

        if ($shop === null) {
            return;
        }

        DB::transaction(function () use ($shop) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            foreach (self::SHOP_SCOPED_MODELS as $modelClass) {
                $modelClass::query()->where('shop_id', $shop->id)->delete();
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            app(CategorySeeder::class)->run($shop->id);
        });
    }
}
