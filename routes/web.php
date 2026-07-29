<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Admin\SettingsPage;
use App\Livewire\Customers\CustomerLedger;
use App\Livewire\Customers\CustomerList;
use App\Livewire\Inventory\BatchList;
use App\Livewire\Inventory\CategoryManager;
use App\Livewire\Inventory\ExpiryAlertsDashboard;
use App\Livewire\Inventory\ProductList;
use App\Livewire\Pos\Pos;
use App\Livewire\Pos\SaleList;
use App\Livewire\Pos\SaleShow;
use App\Livewire\Purchases\PurchaseCreate;
use App\Livewire\Purchases\PurchaseList;
use App\Livewire\Purchases\PurchaseShow;
use App\Livewire\Vendors\VendorLedger;
use App\Livewire\Vendors\VendorList;
use App\Models\Batch;
use App\Models\Sale;
use App\Services\BarcodeService;
use App\Services\ReceiptRenderService;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => auth()->check() ? redirect()->route('dashboard') : redirect()->route('login'));

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('logout', function (Logout $logout) {
    $logout();

    return redirect('/');
})->middleware('auth')->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('vendors', VendorList::class)->middleware('can:viewAny,App\Models\Vendor')->name('vendors.index');
    Route::get('vendors/{vendor}/ledger', VendorLedger::class)->middleware('can:vendor-ledger.view')->name('vendors.ledger');

    Route::get('customers', CustomerList::class)->middleware('can:viewAny,App\Models\Customer')->name('customers.index');
    Route::get('customers/{customer}/ledger', CustomerLedger::class)->middleware('can:customer-ledger.view')->name('customers.ledger');

    Route::get('settings', SettingsPage::class)->middleware('can:branding.manage')->name('settings.index');

    Route::get('products', ProductList::class)->middleware('can:products.view')->name('products.index');
    Route::get('categories', CategoryManager::class)->middleware('can:products.manage')->name('categories.index');
    Route::get('batches', BatchList::class)->middleware('can:batches.view')->name('batches.index');
    Route::get('batches/{batch}/label', function (Batch $batch, BarcodeService $barcodeService) {
        return view('batches.label', [
            'batch' => $batch->load('product'),
            'barcodeSvg' => $barcodeService->renderSvg($batch->barcode),
        ]);
    })->middleware('can:batches.view')->name('batches.label');

    Route::get('expiry-alerts', ExpiryAlertsDashboard::class)->middleware('can:expiry-alerts.view')->name('expiry-alerts.index');

    Route::get('purchases', PurchaseList::class)->middleware('can:viewAny,App\Models\Purchase')->name('purchases.index');
    Route::get('purchases/create', PurchaseCreate::class)->middleware('can:create,App\Models\Purchase')->name('purchases.create');
    Route::get('purchases/{purchase}', PurchaseShow::class)->middleware('can:view,purchase')->name('purchases.show');

    Route::get('pos', Pos::class)->middleware('can:create,App\Models\Sale')->name('pos.index');
    Route::get('sales', SaleList::class)->middleware('can:viewAny,App\Models\Sale')->name('sales.index');
    Route::get('sales/{sale}', SaleShow::class)->middleware('can:view,sale')->name('sales.show');
    Route::get('sales/{sale}/receipt', function (Sale $sale, ReceiptRenderService $receiptRenderService) {
        return $receiptRenderService->render($sale);
    })->middleware('can:view,sale')->name('sales.receipt');
});

require __DIR__.'/auth.php';
