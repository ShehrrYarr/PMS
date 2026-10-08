<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\DiscountType;
use App\Enums\LedgerEntryType;
use App\Enums\PayableType;
use App\Enums\PaymentMethod;
use App\Enums\TransactionReferenceType;
use App\Enums\UserRole;
use App\Models\Bank;
use App\Models\Banner;
use App\Models\Batch;
use App\Models\Category;
use App\Models\Company;
use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\HeldOrder;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReceiptSetting;
use App\Models\Sale;
use App\Models\Shop;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorLedger;
use App\Services\DemoShopResetService;
use App\Services\DiscountCalculator;
use App\Services\LedgerService;
use App\Services\PurchaseReturnService;
use App\Services\PurchaseService;
use App\Services\SaleReturnService;
use App\Services\SaleService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Loads the public demo shop ("See Demo") with a believable agro shop:
 * catalogue with product photos, vendors, customers, banks, staff, and
 * several months of day-by-day trading.
 *
 * Everything that moves money or stock goes through the real services
 * (PurchaseService, SaleService, the return services, LedgerService) with
 * the clock wound back to each day in turn, so batches, barcodes, payments
 * and ledger running balances all reconcile exactly as if the shop had
 * really traded. Randomness is seeded, so a run is reproducible.
 *
 * Replaces the shop's existing business data (DemoShopResetService::wipe()).
 * The whole database part runs in one transaction — a failure leaves the
 * demo exactly as it was — and files are only touched after it commits.
 *
 * Run with: php artisan app:seed-demo-shop
 */
class DemoShopSeeder extends Seeder
{
    /** Days of trading history to generate, ending now. */
    public int $days = 90;

    /** Products whose stock is deliberately allowed to run out, so the grid shows a sold-out item. */
    private const LET_RUN_OUT = ['ethrel-39-6sl'];

    /**
     * Late "clearance lots" bought near the end with short dates, so expiry
     * alerts and the POS's expired / expiring-soon badges have something to
     * show. Days relative to today (negative = already expired).
     *
     * @var array<string, int>
     */
    private const SHORT_DATED_LOTS = [
        'karate-2-5ec' => 18,
        'score-250ec' => 11,
        'match-050ec' => 27,
        'antracol-70wp' => -8,
        'zinc-phosphide-80' => -15,
    ];

    /** Customers who buy in bulk (several units per line). */
    private const BULK_BUYERS = ['Faisal Aziz Agro Centre', 'Tahir Farms'];

    private const RETURN_REASONS = [
        'Customer bought the wrong product',
        'Bottle seal was broken',
        'Customer changed their mind — unopened',
    ];

    private Shop $shop;

    /** @var array<string, mixed> */
    private array $catalog;

    private User $admin;

    /** @var list<User> */
    private array $salesmen = [];

    private User $accountant;

    private User $inventoryManager;

    /** @var array<string, Product> keyed by image slug */
    private array $products = [];

    /** @var array<string, Vendor> keyed by company name */
    private array $vendorForCompany = [];

    /** @var list<Vendor> */
    private array $vendors = [];

    /** @var list<array{customer: Customer, credit: bool, bulk: bool}> */
    private array $customers = [];

    /** @var list<Bank> */
    private array $banks = [];

    /** @var array<string, ExpenseCategory> */
    private array $expenseCategories = [];

    /** @var array<int, int> product id => units in stock, kept in step with every write */
    private array $stock = [];

    /** @var array<int, int> batch id => product id, filled by pickBatch() */
    private array $productIdForBatch = [];

    /** The real (not simulated) start of today. */
    private Carbon $today;

    public function __construct(
        private readonly DemoShopResetService $resetService,
        private readonly PurchaseService $purchaseService,
        private readonly SaleService $saleService,
        private readonly SaleReturnService $saleReturnService,
        private readonly PurchaseReturnService $purchaseReturnService,
        private readonly LedgerService $ledgerService,
        private readonly DiscountCalculator $discountCalculator,
    ) {}

    /** Entry point for `php artisan db:seed --class=DemoShopSeeder`. */
    public function run(): void
    {
        $shop = Shop::query()->where('is_demo', true)->first();

        if ($shop === null) {
            $this->command?->warn('No shop is flagged as the demo (shops.is_demo) — nothing seeded.');

            return;
        }

        $this->seed($shop);
    }

    /**
     * @return array<string, int> row counts, for the command's summary
     */
    public function seed(Shop $shop): array
    {
        $this->shop = $shop;
        $this->catalog = require __DIR__.'/demo/catalog.php';
        mt_srand(20261009);

        $theme = ThemeSetting::query()->where('shop_id', $shop->id)->first();
        $previousLogo = $theme?->logo_path;
        $realNow = Carbon::now();
        $this->today = $realNow->copy()->startOfDay();

        try {
            DB::transaction(function () use ($realNow) {
                $this->resetService->wipe($this->shop);

                $start = $realNow->copy()->subDays($this->days)->setTime(9, 0);
                $this->travelTo($start);

                $this->seedPeople();
                $this->seedSettings();
                $this->seedReferenceData();
                $this->seedCatalogue();
                $this->seedOpeningBalances();
                $this->seedOpeningStock($start);
                $this->simulateTrading($start, $realNow);
                $this->seedHeldOrder($realNow);
            });
        } finally {
            Carbon::setTestNow();
        }

        $this->copyFiles($previousLogo);

        return $this->summary();
    }

    // ---- Set-up ------------------------------------------------------------------------

    private function seedPeople(): void
    {
        $this->admin = User::query()
            ->where('shop_id', $this->shop->id)
            ->role(UserRole::Admin->value)
            ->oldest('id')
            ->first()
            ?? $this->makeUser('Demo Admin', 'admin@kissan-demo.test', UserRole::Admin);

        foreach ($this->catalog['staff'] as $staff) {
            $user = $this->makeUser($staff['name'], $staff['email'], UserRole::from($staff['role']));

            match ($user->roles->first()?->name) {
                UserRole::Salesman->value => $this->salesmen[] = $user,
                UserRole::Accountant->value => $this->accountant = $user,
                UserRole::InventoryManager->value => $this->inventoryManager = $user,
                default => null,
            };
        }

        // A shop seeded on top of an unexpected user set still has someone
        // to attribute each kind of work to.
        $this->salesmen = $this->salesmen !== [] ? $this->salesmen : [$this->admin];
        $this->accountant ??= $this->admin;
        $this->inventoryManager ??= $this->admin;
    }

    /**
     * Staff accounts get a random password nobody knows — they exist only so
     * the history shows different people at work. An email already taken by
     * another shop is left alone and the admin stands in instead.
     */
    private function makeUser(string $name, string $email, UserRole $role): User
    {
        $user = User::query()->where('email', $email)->first();

        if ($user !== null && $user->shop_id !== $this->shop->id) {
            return $this->admin;
        }

        if ($user === null) {
            $user = User::query()->create([
                'shop_id' => $this->shop->id,
                'name' => $name,
                'email' => $email,
                'password' => Str::password(24),
                'is_active' => true,
            ]);
            $user->forceFill(['email_verified_at' => Carbon::now()])->save();
        }

        $user->syncRoles([$role->value]);

        return $user->fresh('roles');
    }

    private function seedSettings(): void
    {
        $shopConfig = $this->catalog['shop'];

        ThemeSetting::query()->updateOrCreate(['shop_id' => $this->shop->id], [
            'shop_name' => $shopConfig['name'],
            'logo_path' => "branding/demo-{$this->shop->id}-logo.png",
        ]);

        ReceiptSetting::query()->updateOrCreate(['shop_id' => $this->shop->id], [
            'header_text' => $shopConfig['receipt_header'],
            'footer_text' => $shopConfig['receipt_footer'],
            'show_logo' => true,
        ]);

        foreach (array_keys($this->catalog['banners']) as $index) {
            Banner::query()->create([
                'shop_id' => $this->shop->id,
                'image_path' => $this->bannerPath($index),
            ]);
        }
    }

    private function seedReferenceData(): void
    {
        foreach ($this->catalog['banks'] as $bank) {
            $this->banks[] = Bank::query()->create($bank + ['shop_id' => $this->shop->id, 'is_active' => true]);
        }

        foreach ($this->catalog['expense_categories'] as $name) {
            $this->expenseCategories[$name] = ExpenseCategory::query()->create([
                'shop_id' => $this->shop->id,
                'name' => $name,
                'is_active' => true,
            ]);
        }

        foreach ($this->catalog['vendors'] as $row) {
            $vendor = Vendor::query()->create([
                'shop_id' => $this->shop->id,
                'name' => $row['name'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'opening_balance' => $row['opening'],
                'is_active' => true,
            ]);

            $this->vendors[] = $vendor;

            foreach ($row['companies'] as $company) {
                $this->vendorForCompany[$company] = $vendor;
            }
        }

        foreach ($this->catalog['customers'] as $row) {
            $this->customers[] = [
                'customer' => Customer::query()->create([
                    'shop_id' => $this->shop->id,
                    'name' => $row['name'],
                    'phone' => $row['phone'],
                    'address' => $row['address'],
                    'opening_balance' => $row['opening'],
                    'is_active' => true,
                ]),
                'credit' => $row['credit'],
                'bulk' => in_array($row['name'], self::BULK_BUYERS, true),
            ];
        }
    }

    private function seedCatalogue(): void
    {
        $categories = [];
        foreach ($this->catalog['categories'] as $name) {
            $categories[$name] = Category::query()->create(['shop_id' => $this->shop->id, 'name' => $name, 'is_active' => true]);
        }

        $companies = [];
        foreach ($this->catalog['companies'] as $name) {
            $companies[$name] = Company::query()->create(['shop_id' => $this->shop->id, 'name' => $name, 'is_active' => true]);
        }

        foreach ($this->catalog['products'] as $index => $row) {
            $product = Product::query()->create([
                'shop_id' => $this->shop->id,
                'name' => $row['name'],
                // SKUs are unique across every shop on the platform, so the
                // demo's carry their own prefix.
                'sku' => sprintf('KAT-%03d', $index + 1),
                'category_id' => $categories[$row['category']]->id,
                'company_id' => $companies[$row['company']]->id,
                'image_path' => $this->productImagePath($row['image']),
                'unit' => $row['unit'],
                'default_sale_price' => $row['price'],
                'is_active' => true,
            ]);

            $this->products[$row['image']] = $product;
            $this->stock[$product->id] = 0;
        }
    }

    /** Mirrors VendorList/CustomerList: a non-zero opening balance is the first ledger row. */
    private function seedOpeningBalances(): void
    {
        foreach ($this->vendors as $vendor) {
            if (bccomp((string) $vendor->opening_balance, '0', 2) !== 0) {
                $this->ledgerService->postVendorEntry(
                    vendor: $vendor,
                    type: LedgerEntryType::Credit,
                    amount: (string) $vendor->opening_balance,
                    referenceType: TransactionReferenceType::Payment,
                    referenceId: $vendor->id,
                    description: 'Opening balance',
                    user: $this->accountant,
                );
            }
        }

        foreach ($this->customers as $entry) {
            $customer = $entry['customer'];

            if (bccomp((string) $customer->opening_balance, '0', 2) !== 0) {
                $this->ledgerService->postCustomerEntry(
                    customer: $customer,
                    type: LedgerEntryType::Debit,
                    amount: (string) $customer->opening_balance,
                    referenceType: TransactionReferenceType::Payment,
                    referenceId: $customer->id,
                    description: 'Opening balance',
                    user: $this->accountant,
                );
            }
        }
    }

    /** Day one: one purchase per vendor stocking every product they supply. */
    private function seedOpeningStock(Carbon $start): void
    {
        $byVendor = [];

        foreach ($this->catalog['products'] as $row) {
            $byVendor[$this->vendorForCompany[$row['company']]->id][] = [$row, $row['restock']];
        }

        $minute = 0;
        foreach ($byVendor as $vendorId => $lines) {
            $this->travelTo($start->copy()->setTime(10, $minute += 7));
            $this->purchase($this->vendorById($vendorId), $lines, $start);
        }
    }

    // ---- Day-by-day trading ------------------------------------------------------------

    private function simulateTrading(Carbon $start, Carbon $realNow): void
    {
        $returnDays = [(int) round($this->days * 0.3), (int) round($this->days * 0.62), max(1, $this->days - 6)];
        $purchaseReturnDay = (int) round($this->days * 0.45);
        $clearanceDay = max(1, $this->days - 25);

        for ($dayIndex = 1; $dayIndex <= $this->days; $dayIndex++) {
            $day = $start->copy()->addDays($dayIndex)->startOfDay();
            $isToday = $day->isSameDay($realNow);

            // Morning work (restocking at ~10:00, bills at 09:30) only counts
            // for today once the real clock has passed it — nothing is ever
            // dated in the future.
            $morningDone = ! $isToday || $realNow->hour >= 11;

            if ($morningDone) {
                $this->restock($day);
                $this->expensesFor($day);
            }

            if ($dayIndex === $clearanceDay) {
                $this->buyShortDatedLots($day);
            }

            foreach ($this->saleTimes($day, $isToday ? $realNow : null) as $time) {
                $this->travelTo($time);
                $this->ringUpSale($day);
            }

            if (in_array($dayIndex, $returnDays, true)) {
                $this->returnSomething($day);
            }

            if ($dayIndex === $purchaseReturnDay) {
                $this->returnToVendor($day);
            }

            if (! $isToday || $realNow->hour >= 17) {
                $this->collectCustomerPayments($day);
            }

            if ($dayIndex % 10 === 0 && (! $isToday || $realNow->hour >= 12)) {
                $this->payVendors($day);
            }
        }
    }

    /**
     * Any product down to a quarter of its usual order is re-bought the
     * same morning, grouped into one purchase per vendor.
     */
    private function restock(Carbon $day): void
    {
        $byVendor = [];

        foreach ($this->catalog['products'] as $row) {
            if (in_array($row['image'], self::LET_RUN_OUT, true)) {
                continue;
            }

            $product = $this->products[$row['image']];

            if ($this->stock[$product->id] <= (int) ceil($row['restock'] * 0.25)) {
                $byVendor[$this->vendorForCompany[$row['company']]->id][] = [$row, $row['restock']];
            }
        }

        $minute = 0;
        foreach ($byVendor as $vendorId => $lines) {
            $this->travelTo($day->copy()->setTime(10, $minute += 11));
            $purchase = $this->purchase($this->vendorById($vendorId), $lines, $day);

            // Freight now and then, booked against the vendor.
            if ($this->chance(35)) {
                $this->expense('Transport & Freight', (string) $this->roundTo(mt_rand(800, 2600), 50), $day, 'cash', vendor: $this->vendorById($vendorId), description: "Freight for {$purchase->invoice_number}");
            }
        }
    }

    /** See SHORT_DATED_LOTS. */
    private function buyShortDatedLots(Carbon $day): void
    {
        $byVendor = [];

        foreach (self::SHORT_DATED_LOTS as $image => $expiresInDays) {
            $row = $this->catalogRow($image);
            $byVendor[$this->vendorForCompany[$row['company']]->id][] = [$row, 20, $expiresInDays];
        }

        $minute = 0;
        foreach ($byVendor as $vendorId => $lines) {
            $this->travelTo($day->copy()->setTime(11, $minute += 9));
            $this->purchase($this->vendorById($vendorId), $lines, $day);
        }
    }

    /**
     * @param  list<array{0: array<string, mixed>, 1: int, 2?: int}>  $lines  [catalogue row, quantity, optional expiry in days from today]
     */
    private function purchase(Vendor $vendor, array $lines, Carbon $day): Purchase
    {
        $items = [];
        $total = '0.00';

        foreach ($lines as $line) {
            [$row, $quantity] = $line;

            // Short-dated lots are dated against the real today (so their
            // badges are right whenever the demo is viewed); everything else
            // gets an ordinary one-to-two-year shelf life from purchase day.
            $expiry = isset($line[2])
                ? $this->today->copy()->addDays($line[2])
                : $day->copy()->addDays(mt_rand(330, 720));

            $items[] = [
                'product_id' => $this->products[$row['image']]->id,
                'manufacturing_date' => $expiry->copy()->subMonths(24)->toDateString(),
                'expiry_date' => $expiry->toDateString(),
                'cost_price' => $row['cost'],
                'quantity' => (string) $quantity,
            ];

            $total = bcadd($total, bcmul($row['cost'], (string) $quantity, 2), 2);
        }

        $purchase = $this->purchaseService->create($vendor, $items, $this->purchasePayment($total), $this->inventoryManager);

        foreach ($items as $item) {
            $this->stock[$item['product_id']] += (int) $item['quantity'];
        }

        return $purchase;
    }

    /**
     * Mostly on credit with the distributor; sometimes straight from the bank.
     *
     * @return list<array{method: string, amount: string, bank_id: ?int}>
     */
    private function purchasePayment(string $total): array
    {
        $roll = mt_rand(1, 100);

        if ($roll <= 55) {
            return [$this->paymentLine(PaymentMethod::Ledger, $total)];
        }

        if ($roll <= 85) {
            return [$this->paymentLine(PaymentMethod::Bank, $total)];
        }

        $half = $this->roundTo((int) bcdiv($total, '2', 0), 1000);

        return $half > 0 && bccomp((string) $half, $total, 2) < 0
            ? [$this->paymentLine(PaymentMethod::Bank, (string) $half), $this->paymentLine(PaymentMethod::Ledger, bcsub($total, (string) $half, 2))]
            : [$this->paymentLine(PaymentMethod::Bank, $total)];
    }

    /**
     * @return list<Carbon>
     */
    private function saleTimes(Carbon $day, ?Carbon $cutoff): array
    {
        $base = match ($day->dayOfWeek) {
            Carbon::FRIDAY => 5,      // shorter day after Jummah
            Carbon::SUNDAY => 7,
            default => 9,
        };

        $times = [];
        $count = max(2, $base + mt_rand(-3, 4));

        for ($i = 0; $i < $count; $i++) {
            $time = $day->copy()->setTime(9, 0)->addMinutes(mt_rand(0, 10 * 60 + 30));

            if ($cutoff === null || $time->lessThan($cutoff)) {
                $times[] = $time;
            }
        }

        usort($times, fn (Carbon $a, Carbon $b) => $a <=> $b);

        return $times;
    }

    private function ringUpSale(Carbon $day): void
    {
        $customerEntry = $this->chance(45) ? $this->pickCustomer() : null;
        $customer = $customerEntry['customer'] ?? null;
        $bulk = $customerEntry['bulk'] ?? false;

        $lineCount = $this->weighted([1 => 55, 2 => 30, 3 => 15]);
        $items = [];
        $usedProducts = [];

        for ($i = 0; $i < $lineCount; $i++) {
            $product = $this->pickProductInStock($usedProducts);

            if ($product === null) {
                break;
            }

            $usedProducts[] = $product->id;
            $batch = $this->pickBatch($product, $day);

            if ($batch === null) {
                continue;
            }

            $wanted = $bulk ? mt_rand(4, 12) : $this->weighted([1 => 67, 2 => 25, 3 => 5, 5 => 3]);
            $quantity = min($wanted, (int) $batch->quantity_remaining);

            if ($quantity < 1) {
                continue;
            }

            $item = [
                'batch_id' => $batch->id,
                'quantity' => (string) $quantity,
                'unit_price' => (string) $product->default_sale_price,
                'discount_type' => null,
                'discount_value' => null,
            ];

            // Small haggled discount on a line now and then.
            $lineSubtotal = bcmul($item['unit_price'], $item['quantity'], 2);
            if ($this->chance(10)) {
                $flat = $this->chance(60) ? '50' : '100';
                if (bccomp($flat, $lineSubtotal, 2) < 0) {
                    $item['discount_type'] = DiscountType::Flat->value;
                    $item['discount_value'] = $flat;
                }
            }

            $items[] = $item;
        }

        if ($items === []) {
            return;
        }

        [$saleDiscountType, $saleDiscountValue] = $this->chance(6) ? [DiscountType::Percentage->value, '5'] : [null, null];
        $total = $this->saleTotal($items, $saleDiscountType, $saleDiscountValue);

        $this->saleService->create(
            customer: $customer,
            items: $items,
            paymentLines: $this->salePayment($total, $customerEntry),
            user: $this->pickSeller(),
            discountType: $saleDiscountType,
            discountValue: $saleDiscountValue,
        );

        foreach ($items as $item) {
            $productId = $this->productIdForBatch[$item['batch_id']];
            $this->stock[$productId] -= (int) $item['quantity'];
        }
    }

    /**
     * Mirrors SaleService's arithmetic exactly (via the same calculator), so
     * the payment lines can be made to balance to the paisa.
     *
     * @param  list<array<string, ?string>>  $items
     */
    private function saleTotal(array $items, ?string $saleDiscountType, ?string $saleDiscountValue): string
    {
        $subtotal = '0.00';

        foreach ($items as $item) {
            $line = bcmul((string) $item['unit_price'], (string) $item['quantity'], 2);
            $subtotal = bcadd($subtotal, bcsub($line, $this->discountCalculator->amount($line, $item['discount_type'], $item['discount_value']), 2), 2);
        }

        return bcsub($subtotal, $this->discountCalculator->amount($subtotal, $saleDiscountType, $saleDiscountValue), 2);
    }

    /**
     * @param  ?array{customer: Customer, credit: bool, bulk: bool}  $customerEntry
     * @return list<array{method: string, amount: string, bank_id: ?int}>
     */
    private function salePayment(string $total, ?array $customerEntry): array
    {
        if ($customerEntry === null) {
            return [$this->paymentLine($this->chance(85) ? PaymentMethod::Cash : PaymentMethod::Bank, $total)];
        }

        if (! $customerEntry['credit']) {
            return [$this->paymentLine($this->chance(70) ? PaymentMethod::Cash : PaymentMethod::Bank, $total)];
        }

        $roll = mt_rand(1, 100);

        if ($roll <= 45) {
            return [$this->paymentLine(PaymentMethod::Ledger, $total)];
        }

        if ($roll <= 75) {
            return [$this->paymentLine(PaymentMethod::Cash, $total)];
        }

        if ($roll <= 85) {
            return [$this->paymentLine(PaymentMethod::Bank, $total)];
        }

        // Part cash now, the rest on account.
        $cash = $this->roundTo((int) bcdiv($total, '2', 0), 100);

        return $cash > 0 && bccomp((string) $cash, $total, 2) < 0
            ? [$this->paymentLine(PaymentMethod::Cash, (string) $cash), $this->paymentLine(PaymentMethod::Ledger, bcsub($total, (string) $cash, 2))]
            : [$this->paymentLine(PaymentMethod::Ledger, $total)];
    }

    private function returnSomething(Carbon $day): void
    {
        $sale = Sale::query()
            ->where('shop_id', $this->shop->id)
            ->whereBetween('created_at', [$day->copy()->subDays(5), $day->copy()->endOfDay()])
            ->with('items')
            ->inRandomOrder(mt_rand())
            ->first();

        $item = $sale?->items->first();

        if ($item === null) {
            return;
        }

        $this->travelTo($day->copy()->setTime(16, mt_rand(0, 50)));
        $this->saleReturnService->create($sale, [['sale_item_id' => $item->id, 'quantity' => '1']], self::RETURN_REASONS[mt_rand(0, count(self::RETURN_REASONS) - 1)], $this->pickSeller());

        $this->stock[$this->productIdOfBatch($item->batch_id)] += 1;
    }

    private function returnToVendor(Carbon $day): void
    {
        $purchase = Purchase::query()
            ->where('shop_id', $this->shop->id)
            ->where('created_at', '<', $day)
            ->with('items.batch')
            ->latest('id')
            ->first();

        $item = $purchase?->items->first(fn ($candidate) => $candidate->batch !== null && (int) $candidate->batch->quantity_remaining >= 2);

        if ($item === null) {
            return;
        }

        $this->travelTo($day->copy()->setTime(12, 30));
        $this->purchaseReturnService->create($purchase, [['purchase_item_id' => $item->id, 'quantity' => '2']], 'Damaged in transit — leaking bottles', $this->inventoryManager);

        $this->stock[$item->product_id] -= 2;
    }

    /** Credit customers settle part of what they owe now and then. */
    private function collectCustomerPayments(Carbon $day): void
    {
        $minute = 0;

        foreach ($this->customers as $entry) {
            if (! $entry['credit'] || ! $this->chance(7)) {
                continue;
            }

            $customer = $entry['customer'];
            $balance = (int) bcadd((string) (CustomerLedger::query()->where('customer_id', $customer->id)->latest('id')->value('running_balance') ?? '0'), '0', 0);

            if ($balance < 500) {
                continue;
            }

            $amount = min($balance, max(500, $this->roundTo((int) ($balance * mt_rand(30, 100) / 100), 500)));
            $method = $this->chance(60) ? PaymentMethod::Cash : PaymentMethod::Bank;

            $this->travelTo($day->copy()->setTime(17, $minute += 4));
            $this->recordPayment(PayableType::Customer, $customer, $method, (string) $amount);
        }
    }

    private function payVendors(Carbon $day): void
    {
        $minute = 0;

        foreach ($this->vendors as $vendor) {
            $balance = (int) bcadd((string) (VendorLedger::query()->where('vendor_id', $vendor->id)->latest('id')->value('running_balance') ?? '0'), '0', 0);

            if ($balance < 20000) {
                continue;
            }

            $amount = $this->roundTo((int) ($balance * mt_rand(40, 75) / 100), 1000);
            $this->travelTo($day->copy()->setTime(12, $minute += 6));
            $this->recordPayment(PayableType::Vendor, $vendor, $this->chance(85) ? PaymentMethod::Bank : PaymentMethod::Cash, (string) $amount);
        }
    }

    /** Mirrors CustomerLedger::recordPayment() / VendorLedger::recordPayment(). */
    private function recordPayment(PayableType $type, Customer|Vendor $party, PaymentMethod $method, string $amount): void
    {
        $bankId = $method === PaymentMethod::Bank ? $this->pickBank()->id : null;

        $payment = Payment::query()->create([
            'shop_id' => $this->shop->id,
            'payable_type' => $type->value,
            'payable_id' => $party->id,
            'method' => $method->value,
            'bank_id' => $bankId,
            'amount' => $amount,
            'user_id' => $this->accountant->id,
        ]);

        if ($party instanceof Customer) {
            $this->ledgerService->postCustomerEntry(
                customer: $party,
                type: LedgerEntryType::Credit,
                amount: $amount,
                referenceType: TransactionReferenceType::Payment,
                referenceId: $payment->id,
                description: __('ledger.payment_received', [], 'en'),
                user: $this->accountant,
            );

            return;
        }

        $this->ledgerService->postVendorEntry(
            vendor: $party,
            type: LedgerEntryType::Debit,
            amount: $amount,
            referenceType: TransactionReferenceType::Payment,
            referenceId: $payment->id,
            description: __('ledger.payment_made', [], 'en'),
            user: $this->accountant,
        );
    }

    /** Rent, bills and salaries on their usual days; tea every week; the odd repair. */
    private function expensesFor(Carbon $day): void
    {
        $this->travelTo($day->copy()->setTime(9, 30));

        if ($day->day === 1) {
            $this->expense('Shop Rent', '45000', $day, 'bank', description: 'Monthly shop rent');
            foreach ([['Ali Raza', '28000'], ['Usman Tariq', '26000'], ['Kashif Mehmood', '32000'], ['Bilal Ahmed', '30000']] as [$name, $salary]) {
                $this->expense('Staff Salaries', $salary, $day, 'cash', description: "Salary — {$name}");
            }
        }

        if ($day->day === 5) {
            $this->expense('Internet & Phone', '2500', $day, 'bank', description: 'PTCL broadband and mobile packages');
        }

        if ($day->day === 10) {
            $this->expense('Electricity Bill', (string) $this->roundTo(mt_rand(11000, 17500), 10), $day, 'bank', description: 'MEPCO electricity bill');
        }

        if ($day->dayOfWeek === Carbon::MONDAY) {
            $this->expense('Tea & Refreshments', (string) $this->roundTo(mt_rand(1100, 1900), 50), $day, 'cash', description: 'Tea and refreshments for the week');
        }

        if ($this->chance(3)) {
            $this->expense('Repairs & Maintenance', (string) $this->roundTo(mt_rand(1500, 6000), 100), $day, 'cash', description: $this->chance(50) ? 'Shutter repair' : 'Fan and light fittings');
        }
    }

    private function expense(string $category, string $amount, Carbon $day, string $method, ?Vendor $vendor = null, ?string $description = null): void
    {
        Expense::query()->create([
            'shop_id' => $this->shop->id,
            'date' => $day->toDateString(),
            'amount' => $amount,
            'expense_category_id' => $this->expenseCategories[$category]->id,
            'payment_method' => $method,
            'bank_id' => $method === 'bank' ? $this->pickBank()->id : null,
            'vendor_id' => $vendor?->id,
            'description' => $description,
            'user_id' => $this->accountant->id,
        ]);
    }

    /** One parked cart for the demo Admin, so the POS's "Held orders" has something in it. */
    private function seedHeldOrder(Carbon $realNow): void
    {
        $this->travelTo($realNow->copy()->subMinutes(20));
        $customer = $this->customers[0]['customer'];
        $lines = [];

        foreach (['confidor-200sl', 'dithane-m-45'] as $image) {
            $product = $this->products[$image];
            $batch = $this->pickBatch($product, $realNow);

            if ($batch === null) {
                continue;
            }

            $lines[] = [
                'batch_id' => $batch->id,
                'product_id' => $product->id,
                'barcode' => $batch->barcode,
                'product_name' => $product->name,
                'image_url' => $product->imageUrl(),
                'expiry_date' => $batch->expiry_date->toDateString(),
                'unit_price' => (string) $product->default_sale_price,
                'quantity' => '2',
                'available' => (string) $batch->quantity_remaining,
                'discount_type' => null,
                'discount_value' => '0',
            ];
        }

        if ($lines === []) {
            return;
        }

        HeldOrder::query()->create([
            'shop_id' => $this->shop->id,
            'user_id' => $this->admin->id,
            'client_uuid' => (string) Str::uuid(),
            'label' => $customer->name,
            'payload' => [
                'cart' => $lines,
                'customer_id' => $customer->id,
                'discount_type' => null,
                'discount_value' => '0',
            ],
        ]);
    }

    // ---- Files ---------------------------------------------------------------------------

    /**
     * After the transaction: product photos, the logo and banners are copied
     * from database/seeders/demo/images onto the public disk. The previous
     * product folder goes first (it may hold images visitors uploaded).
     */
    private function copyFiles(?string $previousLogo): void
    {
        $disk = Storage::disk('public');
        $source = __DIR__.'/demo/images';

        $disk->deleteDirectory("products/{$this->shop->id}");

        foreach ($this->catalog['products'] as $row) {
            $disk->put($this->productImagePath($row['image']), (string) file_get_contents("{$source}/products/{$row['image']}.webp"));
        }

        $logo = "branding/demo-{$this->shop->id}-logo.png";
        if ($previousLogo !== null && $previousLogo !== $logo) {
            $disk->delete($previousLogo);
        }
        $disk->put($logo, (string) file_get_contents("{$source}/branding/logo.png"));

        foreach (array_keys($this->catalog['banners']) as $index) {
            $disk->put($this->bannerPath($index), (string) file_get_contents("{$source}/banners/banner-".($index + 1).'.webp'));
        }
    }

    private function productImagePath(string $image): string
    {
        return "products/{$this->shop->id}/demo-{$image}.webp";
    }

    private function bannerPath(int $index): string
    {
        return "banners/demo-{$this->shop->id}-".($index + 1).'.webp';
    }

    // ---- Helpers -----------------------------------------------------------------------

    private function travelTo(Carbon $moment): void
    {
        Carbon::setTestNow($moment);
    }

    private function pickProductInStock(array $exclude): ?Product
    {
        $weights = [];

        foreach ($this->catalog['products'] as $row) {
            $product = $this->products[$row['image']];

            if ($this->stock[$product->id] > 0 && ! in_array($product->id, $exclude, true)) {
                $weights[$row['image']] = $row['demand'];
            }
        }

        return $weights === [] ? null : $this->products[$this->weighted($weights)];
    }

    /**
     * Staff usually reach for the freshest stock on the shelf (latest
     * expiry), which is also what leaves the short-dated lots partly unsold.
     * Batches that had already expired on the day are never sold.
     */
    private function pickBatch(Product $product, Carbon $day): ?Batch
    {
        $batches = Batch::query()
            ->where('product_id', $product->id)
            ->where('quantity_remaining', '>', 0)
            ->whereDate('expiry_date', '>=', $day->toDateString())
            ->orderByDesc('expiry_date')
            ->get();

        if ($batches->isEmpty()) {
            return null;
        }

        $batch = $this->chance(85) || $batches->count() === 1 ? $batches->first() : $batches->random();
        $this->productIdForBatch[$batch->id] = $product->id;

        return $batch;
    }

    private function productIdOfBatch(int $batchId): int
    {
        return $this->productIdForBatch[$batchId] ??= (int) Batch::query()->whereKey($batchId)->value('product_id');
    }

    /**
     * @return array{customer: Customer, credit: bool, bulk: bool}
     */
    private function pickCustomer(): array
    {
        // Credit customers are the regulars, so they show up more often.
        $weights = [];
        foreach ($this->customers as $index => $entry) {
            $weights[$index] = $entry['credit'] ? 3 : 1;
        }

        return $this->customers[$this->weighted($weights)];
    }

    private function pickSeller(): User
    {
        return $this->chance(15) ? $this->admin : $this->salesmen[mt_rand(0, count($this->salesmen) - 1)];
    }

    private function pickBank(): Bank
    {
        return $this->banks[mt_rand(0, count($this->banks) - 1)];
    }

    /**
     * @return array{method: string, amount: string, bank_id: ?int}
     */
    private function paymentLine(PaymentMethod $method, string $amount): array
    {
        return [
            'method' => $method->value,
            'amount' => bcadd($amount, '0', 2),
            'bank_id' => $method === PaymentMethod::Bank ? $this->pickBank()->id : null,
        ];
    }

    private function vendorById(int $id): Vendor
    {
        foreach ($this->vendors as $vendor) {
            if ($vendor->id === $id) {
                return $vendor;
            }
        }

        throw new \RuntimeException("Unknown demo vendor {$id}.");
    }

    /**
     * @return array<string, mixed>
     */
    private function catalogRow(string $image): array
    {
        foreach ($this->catalog['products'] as $row) {
            if ($row['image'] === $image) {
                return $row;
            }
        }

        throw new \RuntimeException("Unknown demo product {$image}.");
    }

    private function chance(int $percent): bool
    {
        return mt_rand(1, 100) <= $percent;
    }

    /**
     * @template TKey of array-key
     *
     * @param  array<TKey, int>  $weights
     * @return TKey
     */
    private function weighted(array $weights): int|string
    {
        $roll = mt_rand(1, array_sum($weights));

        foreach ($weights as $key => $weight) {
            $roll -= $weight;

            if ($roll <= 0) {
                return $key;
            }
        }

        return array_key_last($weights);
    }

    private function roundTo(int $value, int $step): int
    {
        return (int) (round($value / $step) * $step);
    }

    /**
     * @return array<string, int>
     */
    private function summary(): array
    {
        $count = fn (string $model) => $model::query()->where('shop_id', $this->shop->id)->count();

        return [
            'products' => $count(Product::class),
            'batches' => $count(Batch::class),
            'vendors' => $count(Vendor::class),
            'customers' => $count(Customer::class),
            'purchases' => $count(Purchase::class),
            'sales' => $count(Sale::class),
            'payments' => $count(Payment::class),
            'expenses' => $count(Expense::class),
        ];
    }
}
