<?php

use App\Http\Controllers\DemoLoginController;
use App\Http\Controllers\Pos\OfflineDataController;
use App\Http\Controllers\Pos\PingController;
use App\Http\Controllers\Pos\SalePhotoController;
use App\Http\Controllers\Pos\SyncController;
use App\Livewire\Actions\Logout;
use App\Livewire\Admin\SettingsPage;
use App\Livewire\Customers\CustomerLedger;
use App\Livewire\Customers\CustomerList;
use App\Livewire\Expenses\ExpenseCategoryManager;
use App\Livewire\Expenses\ExpenseList;
use App\Livewire\Inventory\BatchList;
use App\Livewire\Inventory\CategoryManager;
use App\Livewire\Inventory\CompanyManager;
use App\Livewire\Inventory\ExpiryAlertsDashboard;
use App\Livewire\Inventory\ProductList;
use App\Livewire\Pos\Pos;
use App\Livewire\Pos\SaleList;
use App\Livewire\Pos\SaleShow;
use App\Livewire\Pos\SyncConflicts;
use App\Livewire\Purchases\PurchaseCreate;
use App\Livewire\Purchases\PurchaseList;
use App\Livewire\Purchases\PurchaseShow;
use App\Livewire\Reports\PurchaseReport;
use App\Livewire\Reports\SalesReport;
use App\Livewire\Vendors\VendorLedger;
use App\Livewire\Vendors\VendorList;
use App\Models\Batch;
use App\Models\Sale;
use App\Services\BarcodeService;
use App\Services\InvoicePdfService;
use App\Services\ReceiptRenderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// No shop segment at all — there's no single shop to send a guest to, so
// this is a minimal, DB-query-free landing page. An authenticated user is
// sent straight to their own shop.
Route::get('/', function () {
    $user = Auth::guard('web')->user();

    return $user !== null
        ? redirect()->route('dashboard', ['shop' => $user->shop->slug])
        : view('shop-landing');
})->name('home');

// Single-segment, unprefixed like '/' above — must stay registered before
// the {shop} prefix group's own bare '/' route, which is a wildcard that
// would otherwise swallow this literal path (see bootstrap/app.php's note
// on route registration order).
Route::get('/demo-login', DemoLoginController::class)->name('demo.login');

// Must be required before the {shop} prefix group below — see the note in
// bootstrap/app.php on why registration order matters here.
require __DIR__.'/super_admin.php';
require __DIR__.'/auth.php';

/**
 * Every shop gets its own URL segment (e.g. /shop1/dashboard) — resolved by
 * ResolveShopFromSlug (aliased 'shop.context'), which also 403s a logged-in
 * user who navigates to a shop that isn't theirs. Route *names* are
 * unchanged from the pre-per-shop-URL app (dashboard, vendors.index, ...) —
 * only the URI gained a {shop} prefix, so the vast majority of existing
 * route('...') calls throughout sidebar/nav/redirects need no changes at
 * all (see AppServiceProvider's Authenticated-event listener + this
 * middleware, both of which set URL::defaults(['shop' => ...])).
 */
Route::prefix('{shop}')->middleware(['shop.context'])->group(function () {
    Route::get('/', fn () => Auth::guard('web')->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login'))->name('shop.home');

    Route::middleware('guest:web')->group(function () {
        Volt::route('login', 'pages.auth.login')->name('login');
    });

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth:web', 'verified', 'shop.active'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth:web', 'shop.active'])
        ->name('profile');

    Route::post('logout', function (Logout $logout) {
        $logout();

        return redirect()->route('login');
    })->middleware('auth:web')->name('logout');

    Route::middleware(['auth:web', 'verified', 'shop.active'])->group(function () {
        Route::get('vendors', VendorList::class)->middleware('can:viewAny,App\Models\Vendor')->name('vendors.index');
        Route::get('vendors/{vendor}/ledger', VendorLedger::class)->middleware('can:vendor-ledger.view')->name('vendors.ledger');

        Route::get('customers', CustomerList::class)->middleware('can:viewAny,App\Models\Customer')->name('customers.index');
        Route::get('customers/{customer}/ledger', CustomerLedger::class)->middleware('can:customer-ledger.view')->name('customers.ledger');

        Route::get('settings', SettingsPage::class)->middleware('can:branding.manage')->name('settings.index');

        Route::get('products', ProductList::class)->middleware('can:products.view')->name('products.index');
        Route::get('categories', CategoryManager::class)->middleware('can:products.manage')->name('categories.index');
        Route::get('companies', CompanyManager::class)->middleware('can:products.manage')->name('companies.index');
        Route::get('batches', BatchList::class)->middleware('can:batches.view')->name('batches.index');
        // Leading unused $shop keeps this closure's parameter order aligned
        // with the route's {shop}/{batch} URI order — see the identical note
        // on the sales.receipt/sales.invoice routes below.
        Route::get('batches/{batch}/label', function (string $shop, Batch $batch, BarcodeService $barcodeService) {
            return view('batches.label', [
                'batch' => $batch->load('product'),
                'barcodeSvg' => $barcodeService->renderSvg($batch->barcode),
            ]);
        })->middleware('can:batches.view')->name('batches.label');

        Route::get('expiry-alerts', ExpiryAlertsDashboard::class)->middleware('can:expiry-alerts.view')->name('expiry-alerts.index');

        Route::get('expenses', ExpenseList::class)->middleware('can:expenses.manage')->name('expenses.index');
        Route::get('expense-categories', ExpenseCategoryManager::class)->middleware('can:expenses.manage')->name('expense-categories.index');

        Route::get('purchases', PurchaseList::class)->middleware('can:viewAny,App\Models\Purchase')->name('purchases.index');
        Route::get('purchases/create', PurchaseCreate::class)->middleware('can:create,App\Models\Purchase')->name('purchases.create');
        Route::get('purchases/{purchase}', PurchaseShow::class)->middleware('can:view,purchase')->name('purchases.show');

        Route::get('pos', Pos::class)->middleware('can:create,App\Models\Sale')->name('pos.index');

        // Offline POS support. Invokable controllers rather than closures so
        // there's no route-model binding to mis-splice against the {shop}
        // segment (see the note on sales.receipt below). All three answer in
        // JSON — see bootstrap/app.php's shouldRenderJsonWhen.
        Route::middleware('can:create,App\Models\Sale')->group(function () {
            Route::get('pos/ping', PingController::class)->name('pos.ping');
            Route::get('pos/offline-data', OfflineDataController::class)->name('pos.offline-data');
            Route::post('pos/sync', SyncController::class)->name('pos.sync');
            Route::post('sales/{sale}/photo', SalePhotoController::class)->name('sales.photo');

            // The offline till itself. A plain Blade view with no Livewire
            // component and no per-request data, so the service worker can
            // cache one copy that never goes stale.
            Route::view('pos/offline', 'pos.offline')->name('pos.offline');
        });
        Route::get('sales', SaleList::class)->middleware('can:viewAny,App\Models\Sale')->name('sales.index');
        Route::get('sales/{sale}', SaleShow::class)->middleware('can:view,sale')->name('sales.show');
        // The unused leading $shop parameter keeps this closure's parameter
        // order aligned with the route's {shop}/{sale} URI order — without
        // it, Laravel's positional dependency-splicing (CallableDispatcher)
        // binds the shop slug string to $sale instead of the resolved model.
        Route::get('sales/{sale}/receipt', function (string $shop, Sale $sale, ReceiptRenderService $receiptRenderService) {
            return $receiptRenderService->render($sale);
        })->middleware('can:view,sale')->name('sales.receipt');
        Route::get('sales/{sale}/invoice', function (string $shop, Sale $sale, InvoicePdfService $invoicePdfService) {
            return $invoicePdfService->download($sale);
        })->middleware('can:reports.view')->name('sales.invoice');

        Route::get('sync-conflicts', SyncConflicts::class)->middleware('can:sync-conflicts.manage')->name('sync-conflicts.index');

        Route::get('reports/sales', SalesReport::class)->middleware('can:reports.view')->name('reports.sales');
        Route::get('reports/purchases', PurchaseReport::class)->middleware('can:reports.view')->name('reports.purchases');
    });
});
