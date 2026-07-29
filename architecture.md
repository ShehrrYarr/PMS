# Architecture Document
## Pesticides Management System

**Stack:** Laravel 11.x (PHP 8.2), Livewire v3, Alpine.js, Tailwind CSS, MySQL 8
**Scope reminder:** single business, single location, no multi-tenancy, no tax, no geographic territory logic (see [[prd.md]] §1, §3).

---

## 1. System Architecture Overview

The system is a monolithic Laravel application using Livewire v3 as the primary UI layer (no separate SPA/API frontend). Business logic lives in **Service classes**, never in Livewire components or controllers directly — components call services, services call models, models stay thin (relationships, casts, scopes only).

```
Browser (Livewire wire:model / wire:click)
      │
      ▼
Livewire Component  ──validates input, calls──▶  Service Class
      │                                                │
      │                                                ▼
      │                                          Eloquent Models
      │                                                │
      ▼                                                ▼
   Blade View                                    MySQL (DB::transaction)
      │
      ▼
  (print views use @media print, no separate PDF unless dompdf report)
```

### 1.1 Core Data Flow — Purchases

1. Inventory Manager opens `PurchaseCreate` Livewire component, selects a Vendor, adds line items (product + quantity + cost price + manufacturing/expiry dates).
2. On submit, `PurchaseService::create()` runs inside `DB::transaction()`:
   - Creates `purchases` row.
   - For each line item, creates a `purchase_items` row **and** either creates a new `batches` row (new manufacturing/expiry combination) or increments an existing matching batch's quantity.
   - `BarcodeService::generateForBatch()` assigns a unique barcode to every newly created batch.
   - Splits the purchase total across `payments` rows (cash / bank / ledger) per the payment form.
   - If any portion is on-account, `LedgerService::postVendorEntry()` writes a `vendor_ledgers` debit-to-shop / credit-to-vendor row (shop owes vendor) and recomputes running balance.
3. All steps commit together or not at all.

### 1.2 Core Data Flow — Sales (POS)

1. Salesman scans/searches products in the `Pos` Livewire component; each scan resolves a specific **batch** (manual batch selection per [[prd.md]] §2.3) and adds a `sale_items`-shaped cart line.
2. On checkout, `SaleService::create()` runs inside `DB::transaction()`:
   - Validates each batch has sufficient remaining quantity (`InsufficientStockException` if not — see [[rules.md]]).
   - Creates `sales` row, `sale_items` rows, decrements batch quantities.
   - Splits the sale total across `payments` rows; any on-account portion triggers `LedgerService::postCustomerEntry()`.
   - Renders the receipt view (reads `receipt_settings` + `theme_settings`) for immediate browser print.

### 1.3 Core Data Flow — Ledger Adjustments

`LedgerService` is the **only** writer to `vendor_ledgers` and `customer_ledgers`. Entry points: purchases, sales, payments (standalone payment against existing balance), sales returns, purchase returns. Every write:
1. Locks the ledger owner's latest row (`lockForUpdate()`) to serialize concurrent balance updates.
2. Inserts a new immutable row with `debit`, `credit`, and `running_balance` (previous running balance ± this entry).
3. Never updates or deletes a prior row — corrections are new reversing entries referencing the original via `reference_type`/`reference_id`.

### 1.4 Core Data Flow — Returns

1. `SaleReturnService::create()` (or `PurchaseReturnService::create()`) validates the return quantity against the original sale/purchase item's remaining returnable quantity.
2. Inside `DB::transaction()`: creates the return + return-items rows, restores/removes batch quantity, and calls `LedgerService` to post the reversing entry.

---

## 2. Folder & File Structure

```
app/
├── Console/
│   └── Commands/
│       └── CheckExpiringBatches.php          # scheduled: flags batches ≤30 days to expiry
├── Enums/
│   ├── PaymentMethod.php                     # Cash | Bank | Ledger
│   ├── LedgerEntryType.php                   # Debit | Credit
│   ├── TransactionReferenceType.php          # Sale | Purchase | SaleReturn | PurchaseReturn | Payment
│   └── UserRole.php                          # Admin | InventoryManager | Accountant | Salesman
├── Events/
│   ├── BatchExpiringSoon.php
│   └── StockDepletedToZero.php
├── Exceptions/
│   ├── InsufficientStockException.php
│   ├── UnbalancedPaymentSplitException.php
│   ├── LedgerMismatchException.php
│   └── InvalidReturnQuantityException.php
├── Http/
│   └── Middleware/
│       └── EnsureActiveShop.php               # future-proof hook, currently pass-through (see rules.md YAGNI note)
├── Livewire/
│   ├── Admin/
│   │   ├── BrandingSettings.php               # logo upload, theme colors
│   │   ├── ReceiptSettings.php                # dynamic header/footer
│   │   ├── UserManagement.php
│   │   └── BankAccountManager.php
│   ├── Inventory/
│   │   ├── ProductList.php
│   │   ├── ProductForm.php
│   │   ├── BatchList.php
│   │   ├── BatchForm.php
│   │   └── ExpiryAlertsDashboard.php
│   ├── Vendors/
│   │   ├── VendorList.php
│   │   ├── VendorForm.php
│   │   └── VendorLedger.php
│   ├── Customers/
│   │   ├── CustomerList.php
│   │   ├── CustomerForm.php
│   │   └── CustomerLedger.php
│   ├── Purchases/
│   │   ├── PurchaseCreate.php
│   │   ├── PurchaseList.php
│   │   └── PurchaseReturnForm.php
│   ├── Pos/
│   │   ├── Pos.php                            # main POS screen
│   │   ├── PosCart.php                        # child component: cart lines
│   │   ├── PosPaymentSplit.php                # child component: split payment entry
│   │   └── SaleReturnForm.php
│   ├── Reports/
│   │   ├── SalesReport.php
│   │   ├── PurchaseReport.php
│   │   └── LedgerSummary.php
│   └── Shared/
│       ├── LanguageSwitcher.php
│       └── BarcodeScannerInput.php
├── Models/
│   ├── User.php
│   ├── Vendor.php
│   ├── Customer.php
│   ├── VendorLedger.php
│   ├── CustomerLedger.php
│   ├── Product.php
│   ├── Batch.php
│   ├── Bank.php
│   ├── Sale.php
│   ├── SaleItem.php
│   ├── SaleReturn.php
│   ├── SaleReturnItem.php
│   ├── Purchase.php
│   ├── PurchaseItem.php
│   ├── PurchaseReturn.php
│   ├── PurchaseReturnItem.php
│   ├── Payment.php
│   ├── ReceiptSetting.php
│   └── ThemeSetting.php
├── Observers/
│   ├── BatchObserver.php                      # fires BatchExpiringSoon / StockDepletedToZero checks on save
│   └── ProductObserver.php                    # slug/SKU normalization
├── Services/
│   ├── PurchaseService.php
│   ├── SaleService.php
│   ├── SaleReturnService.php
│   ├── PurchaseReturnService.php
│   ├── LedgerService.php
│   ├── PaymentSplitService.php                # validates split lines sum to transaction total
│   ├── BarcodeService.php                     # wraps milon/barcode generation + storage
│   ├── ExpiryAlertService.php
│   └── ReceiptRenderService.php                # resolves receipt_settings/theme_settings into a printable view
├── Traits/
│   ├── HasMoneyCasts.php                      # consistent decimal:2 accessor/mutator behavior
│   └── LogsLedgerActivity.php
└── Policies/
    ├── VendorPolicy.php
    ├── CustomerPolicy.php
    ├── PurchasePolicy.php
    ├── SalePolicy.php
    └── SettingsPolicy.php

database/
├── migrations/                                 # one per table, see §3
├── factories/
└── seeders/
    ├── RoleAndPermissionSeeder.php             # spatie roles: Admin, InventoryManager, Accountant, Salesman
    ├── ThemeSettingSeeder.php
    └── DemoDataSeeder.php

resources/
├── lang/
│   ├── en/
│   │   ├── pos.php
│   │   ├── ledger.php
│   │   ├── inventory.php
│   │   └── validation.php
│   └── ur/
│       ├── pos.php
│       ├── ledger.php
│       ├── inventory.php
│       └── validation.php
├── views/
│   ├── layouts/
│   │   ├── app.blade.php                      # glassmorphism shell, dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}"
│   │   └── guest.blade.php
│   ├── livewire/                               # Livewire component views, mirrors app/Livewire structure
│   ├── receipts/
│   │   └── thermal-receipt.blade.php           # @media print, 58mm/80mm CSS
│   └── pdf/
│       └── ledger-statement.blade.php          # dompdf template for printable statements
└── css/
    └── app.css                                 # Tailwind + glassmorphism utility layer (see design.md)

routes/
└── web.php                                     # thin: Livewire full-page components + auth routes only
```

**Why service classes, not fat Livewire components:** every write in this system that touches money or stock must be transactional and testable in isolation from the UI. Keeping `PurchaseService`, `SaleService`, `LedgerService`, etc. as plain PHP classes lets them be unit-tested without booting Livewire, and reused identically from POS, admin corrections, and future artisan commands (see [[rules.md]]).

---

## 3. Database Schema & Entity-Relationship Details

All monetary columns use `decimal(12,2)` (PKR, no sub-unit beyond paisa-as-decimal). All tables use unsigned bigint auto-increment `id` and standard `timestamps()` unless noted. Soft deletes are used only where explicitly noted.

### 3.1 `users`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | string | |
| email | string, unique | |
| password | string | |
| is_active | boolean, default true | disabling a user blocks login without deleting history |
| timestamps, remember_token | | |

Roles/permissions via `spatie/laravel-permission` pivot tables (`model_has_roles`, `roles`, `permissions`, etc.) — not hand-rolled.

### 3.2 `vendors`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | string | |
| phone | string, nullable | |
| address | text, nullable | |
| opening_balance | decimal(12,2), default 0 | seeds the first `vendor_ledgers` row on creation |
| is_active | boolean, default true | |
| timestamps | | |

### 3.3 `customers`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | string | |
| phone | string, nullable | |
| address | text, nullable | |
| opening_balance | decimal(12,2), default 0 | |
| is_active | boolean, default true | |
| timestamps | | |

### 3.4 `vendor_ledgers`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| vendor_id | FK → vendors, cascade on delete restrict | vendors with ledger history cannot be hard-deleted |
| debit | decimal(12,2), default 0 | amount shop pays / returns credited to shop |
| credit | decimal(12,2), default 0 | amount shop owes vendor |
| running_balance | decimal(12,2) | credit-positive convention: positive = shop owes vendor |
| reference_type | string | `purchase` \| `purchase_return` \| `payment` |
| reference_id | bigint | polymorphic-style pointer, not a formal Eloquent morph (kept as plain FK-like int + type string for simpler reporting joins) |
| description | string, nullable | |
| created_by | FK → users | |
| created_at | timestamp | no `updated_at` — rows are immutable, insert-only |

### 3.5 `customer_ledgers`
Same shape as `vendor_ledgers`, scoped to `customer_id`. `debit` = amount customer owes shop (on-account sale); `credit` = amount customer paid down / return credited to customer. `running_balance` positive = customer owes shop.

### 3.6 `products`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | string | |
| sku | string, unique | |
| category | string, nullable | simple string column, not a separate table — no category management UI required in v1 |
| unit | string | e.g. "Liter", "Kg", "Bottle" |
| default_sale_price | decimal(12,2) | pre-fill only; actual sale price is set per sale_item |
| is_active | boolean, default true | |
| timestamps | | |

### 3.7 `batches`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| product_id | FK → products | |
| barcode | string, unique | auto-generated on creation via `BarcodeService`, never regenerated |
| manufacturing_date | date | |
| expiry_date | date, indexed | indexed for the daily expiry scan |
| cost_price | decimal(12,2) | price paid to vendor for this batch |
| quantity_received | decimal(12,2) | original quantity received in this batch |
| quantity_remaining | decimal(12,2) | decremented by sales, incremented by sales returns / decremented further by purchase returns |
| purchase_item_id | FK → purchase_items, nullable | originating purchase line, nullable only for legacy/opening-stock batches |
| timestamps | | |

### 3.8 `banks`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| name | string | e.g. "Meezan Bank – Current" |
| account_number | string, nullable | |
| is_active | boolean, default true | inactive banks stay for history but drop out of the POS dropdown |
| timestamps | | |

### 3.9 `sales`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| invoice_number | string, unique | human-readable, e.g. `SL-000123` |
| customer_id | FK → customers, nullable | null = walk-in |
| user_id | FK → users | salesman who processed the sale |
| total_amount | decimal(12,2) | sum of sale_items after per-line discounts, if any |
| status | enum: `completed`, `returned`, `partially_returned` | |
| timestamps | | |

### 3.10 `sale_items`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| sale_id | FK → sales | |
| batch_id | FK → batches | manually selected batch (see [[prd.md]] §2.3) |
| quantity | decimal(12,2) | |
| unit_price | decimal(12,2) | price at time of sale, independent of product's current default price |
| line_total | decimal(12,2) | quantity × unit_price |
| quantity_returned | decimal(12,2), default 0 | running total consumed by sale_return_items, caps returnable quantity |

### 3.11 `sale_returns`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| sale_id | FK → sales | |
| customer_id | FK → customers, nullable | denormalized for ledger convenience |
| reason | string | |
| total_amount | decimal(12,2) | |
| user_id | FK → users | who processed the return |
| timestamps | | |

### 3.12 `sale_return_items`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| sale_return_id | FK → sale_returns | |
| sale_item_id | FK → sale_items | |
| batch_id | FK → batches | stock restored here |
| quantity | decimal(12,2) | must not exceed sale_item's remaining returnable quantity |
| line_total | decimal(12,2) | |

### 3.13 `purchases`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| invoice_number | string, unique | e.g. `PU-000045` |
| vendor_id | FK → vendors | |
| user_id | FK → users | inventory manager who recorded it |
| total_amount | decimal(12,2) | |
| status | enum: `completed`, `returned`, `partially_returned` | |
| timestamps | | |

### 3.14 `purchase_items`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| purchase_id | FK → purchases | |
| product_id | FK → products | |
| quantity | decimal(12,2) | |
| cost_price | decimal(12,2) | |
| line_total | decimal(12,2) | |
| quantity_returned | decimal(12,2), default 0 | |

(Each `purchase_items` row produces exactly one `batches` row via `PurchaseService`, linked by `batches.purchase_item_id`.)

### 3.15 `purchase_returns`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| purchase_id | FK → purchases | |
| vendor_id | FK → vendors | denormalized for ledger convenience |
| reason | string | |
| total_amount | decimal(12,2) | |
| user_id | FK → users | |
| timestamps | | |

### 3.16 `purchase_return_items`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| purchase_return_id | FK → purchase_returns | |
| purchase_item_id | FK → purchase_items | |
| batch_id | FK → batches | stock removed here |
| quantity | decimal(12,2) | must not exceed purchase_item's remaining returnable quantity |
| line_total | decimal(12,2) | |

### 3.17 `payments`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | |
| payable_type | string | `sale` \| `purchase` \| `vendor` \| `customer` (matches `PayableType` enum; kept as explicit string + id pair rather than Eloquent polymorphic morph, to keep reporting queries simple — see [[rules.md]] guardrails). `vendor`/`customer` back a standalone ledger settlement payment with no linked sale/purchase (see [[phases.md]] Phase 2). |
| payable_id | bigint | |
| method | enum: `cash`, `bank`, `ledger` | matches `PaymentMethod` enum |
| bank_id | FK → banks, nullable | required when method = `bank` |
| amount | decimal(12,2) | |
| user_id | FK → users | who recorded the payment line |
| timestamps | | |

A single sale/purchase has one-to-many `payments` rows; `PaymentSplitService` enforces `SUM(payments.amount) = transaction.total_amount` before commit.

### 3.18 `receipt_settings`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | single-row table (id = 1) enforced at application level |
| header_text | text, nullable | |
| footer_text | text, nullable | |
| show_logo | boolean, default true | |
| paper_width | enum: `58mm`, `80mm`, default `80mm` | |
| timestamps | | |

### 3.19 `theme_settings`
| Column | Type | Notes |
|---|---|---|
| id | bigint PK | single-row table (id = 1) |
| logo_path | string, nullable | |
| navbar_primary_color | string (hex) | default matches [[design.md]] palette |
| navbar_accent_color | string (hex) | |
| sidebar_primary_color | string (hex) | |
| sidebar_accent_color | string (hex) | |
| default_locale | enum: `en`, `ur`, default `en` | |
| timestamps | | |

### 3.20 Entity-Relationship Summary

```
vendors 1───* purchases 1───* purchase_items 1───1 batches *───1 products
vendors 1───* vendor_ledgers

customers 1───* sales 1───* sale_items *───1 batches
customers 1───* customer_ledgers

sales 1───* sale_returns 1───* sale_return_items *───1 sale_items
purchases 1───* purchase_returns 1───* purchase_return_items *───1 purchase_items

sales 1───* payments (payable_type='sale')
purchases 1───* payments (payable_type='purchase')
vendors 1───* payments (payable_type='vendor', standalone settlement)
customers 1───* payments (payable_type='customer', standalone settlement)
banks 1───* payments

users 1───* sales, purchases, sale_returns, purchase_returns, payments  (created_by / user_id audit trail)
```

Foreign keys use `restrict` on delete for anything with financial history (vendors, customers, batches, sales, purchases); lookup-only tables (`banks`) use `restrict` as well since historical payments must remain resolvable. Nothing in this schema uses cascading deletes — financial records are never allowed to disappear as a side effect of deleting a parent (see [[rules.md]] Financial Integrity Rules).

---

## 4. Third-Party Packages

| Package | Purpose | Why |
|---|---|---|
| `livewire/livewire` v3 | Reactive UI without a separate API/SPA layer | Matches required stack, fastest path to a server-rendered reactive POS |
| `laravel/breeze` (Livewire stack) | Auth scaffolding (login, password reset) | Lightweight, official, no unneeded team/2FA overhead for a single-location shop |
| `spatie/laravel-permission` | Roles (Admin, Inventory Manager, Accountant, Salesman) and fine-grained permissions/gates | Industry-standard, well-tested, avoids hand-rolled ACL bugs in a system where permission errors have financial consequences |
| `milon/barcode` | Server-side barcode (Code128) generation for batch labels and POS scan targets | Simple, dependency-light, renders directly to `<img>`/base64 for both screen and print |
| `barryvdh/laravel-dompdf` | PDF rendering for ledger statements and non-thermal reports (NOT per-sale receipts, which are browser-print HTML per [[prd.md]] §2.6) | Standard Laravel PDF package, sufficient for A4 statement/report output |
| `spatie/laravel-activitylog` (optional, Phase 6 candidate) | Audit trail for settings and financial-adjacent changes | Considered for the security/audit requirements in [[rules.md]]; only added if the simpler `created_by` column auditing proves insufficient |

Packages deliberately **not** used, and why, are listed in [[rules.md]] §3 (Tech Stack Guardrails).

---

## 5. Related Documents

- [[prd.md]] — feature requirements this architecture implements.
- [[rules.md]] — coding/financial-integrity rules that constrain how this architecture is built.
- [[phases.md]] — order in which this schema and structure are built out.
- [[design.md]] — how `theme_settings`/`receipt_settings` drive the UI.
