# Development Phases
## Pesticides Management System

Six sequential phases. Each phase produces a working, demoable increment — no phase ships UI for a feature whose backend isn't transactionally complete per [[rules.md]] §2. Phase order follows dependency order: auth/shell → money-holding entities (vendors/customers/ledgers/banks) → inventory (products/batches/barcodes/expiry) → roles/returns → POS (which depends on all of the above) → polish/deploy.

Track progress against this file using [[memory.md]]'s `[x]`/`[/]`/`[ ]` checklist, kept in sync phase-by-phase.

---

## Phase 1 — Core Setup, Glassmorphism UI, Auth & Localization

**Goal:** A running Laravel app with themeable shell, working login, and language toggle — nothing functional yet, but the skeleton every later phase builds inside.

**Deliverables:**
- Laravel 11 project scaffolded, MySQL configured, `laravel/breeze` (Livewire stack) installed.
- `spatie/laravel-permission` installed; `RoleAndPermissionSeeder` creates the four roles (Admin, Inventory Manager, Accountant, Salesman) with their permission sets from [[prd.md]] §3.
- `theme_settings` and `receipt_settings` tables + models + seeders with sensible defaults (see [[design.md]] for default palette).
- `layouts/app.blade.php` glassmorphism shell: navbar + sidebar reading colors from `theme_settings` via CSS custom properties; `dir` attribute driven by active locale.
- `resources/lang/en` and `resources/lang/ur` scaffolded with at least the shared/navigation strings; `LanguageSwitcher` Livewire component toggles `app()->setLocale()` and persists the choice (session or user preference).
- Admin can log in and see an empty dashboard shell; non-Admin roles seeded with at least one test user each.

**Verification:**
- Fresh `php artisan migrate --seed` succeeds from empty database.
- Login works for all four seeded role users; each is redirected to the same dashboard shell (module-level restriction comes in later phases).
- Toggling language flips the whole layout to RTL (sidebar moves, text mirrors) and back, without a full page reload breaking session state.
- Changing a `theme_settings` color value (via tinker/seeder for now — UI comes with Admin branding screens) visibly changes navbar/sidebar color on next page load.

---

## Phase 2 — Vendor, Customer & Ledger System + Bank Accounts

**Goal:** Money-tracking entities exist and are provably correct before any inventory or POS logic depends on them.

**Deliverables:**
- `vendors`, `customers`, `banks` tables/models + CRUD Livewire components (`VendorList`/`VendorForm`, `CustomerList`/`CustomerForm`, `BankAccountManager`).
- `vendor_ledgers`, `customer_ledgers` tables/models.
- `LedgerService` implemented per [[architecture.md]] §1.3 and [[rules.md]] §2: `postVendorEntry()`, `postCustomerEntry()`, both insert-only, both lock-and-recompute `running_balance`.
- Opening balances: creating a vendor/customer with a non-zero `opening_balance` immediately produces the first ledger row.
- `VendorLedger`/`CustomerLedger` Livewire components: filterable, paginated statement view with running balance column.
- A minimal "record standalone payment" flow (pay down a vendor balance / receive payment from a customer with no linked sale/purchase) to exercise `LedgerService` independent of POS/purchasing — this becomes the template both PurchaseService and SaleService reuse in later phases.

**Verification:**
- Creating a vendor/customer with an opening balance produces exactly one ledger row matching that balance.
- Recording a standalone payment against a vendor/customer produces a new immutable row with a correctly recomputed `running_balance`; the prior row is untouched (byte-for-byte, verified via a test that reads the row before and after).
- Concurrent payment submissions against the same ledger (simulated in a test) do not produce a corrupted running balance — `lockForUpdate()` behavior verified.
- No update or delete route/method exists anywhere against an existing ledger row.

---

## Phase 3 — Product, Batching, Barcodes & Automated Expiry Alerts

**Goal:** Inventory exists with full batch/expiry/barcode traceability, independent of purchasing/POS UI.

**Deliverables:**
- `products`, `batches` tables/models + `ProductList`/`ProductForm`, `BatchList`/`BatchForm` Livewire components.
- `BarcodeService` (wrapping `milon/barcode`) generates a unique Code128 barcode per batch on creation; barcode rendered on a printable batch label view.
- `ExpiryAlertService` + `CheckExpiringBatches` scheduled console command: flags batches within 30 days of `expiry_date`, dispatches `BatchExpiringSoon` event, feeds an `ExpiryAlertsDashboard` Livewire widget.
- `BatchObserver` wired for save-time expiry-window checks (dashboard freshness) in addition to the scheduled sweep (for users who don't reload the dashboard often).
- Manual stock-in entry point (temporary, ahead of full Phase 2-style purchase workflow if needed) or — preferably — deferred until Phase 2's purchase flow is extended in this phase to actually create batches, matching the real data flow in [[architecture.md]] §1.1.

**Verification:**
- Creating a batch produces a unique, non-reused barcode; scanning/looking up that barcode resolves to exactly one batch.
- A batch whose `expiry_date` is exactly 30 days out (and closer) appears in the Expiring Soon dashboard; one 31+ days out does not.
- Selling/depleting a batch to `quantity_remaining = 0` is rejected by validation if attempted again (exercised via a direct service-level test, since POS doesn't exist until Phase 5).
- Scheduled command run via `php artisan schedule:run` in a test environment correctly identifies seeded expiring batches.

---

## Phase 4 — Salesman Role & POS Permission System + Returns

**Goal:** Role-based access is enforced everywhere, and returns (sales + purchase) are fully modeled — both prerequisites for a safe POS in Phase 5. (Note: the originally-considered geographic "territory" system is explicitly dropped here — see [[prd.md]] §3 and [[memory.md]] decision log — replaced by the simpler role matrix already seeded in Phase 1.)

**Deliverables:**
- Policies (`VendorPolicy`, `CustomerPolicy`, `PurchasePolicy`, `SalePolicy`, `SettingsPolicy`) implemented and applied to every write action across Phases 2–3's components, enforcing the matrix from [[prd.md]] §3.
- `PurchaseService::create()` fully implemented (purchase → purchase_items → batches → payments → vendor ledger), completing the data flow from [[architecture.md]] §1.1 that Phase 3 deferred.
- `SaleReturnService` and `PurchaseReturnService` implemented per [[architecture.md]] §1.4 and [[rules.md]] §2 rule 6, with `sale_returns`/`sale_return_items`/`purchase_returns`/`purchase_return_items` tables and forms.
- Salesman-role user, when logged in, sees only POS-relevant navigation; attempting to hit a purchase/vendor/settings route directly is blocked by policy (403), not just hidden in the UI.

**Verification:**
- A Salesman-role user cannot create/edit a vendor, purchase, or theme setting even via direct component/route access (policy-level test, not just UI-hiding check).
- A full purchase (multi-item, split payment, on-account remainder) produces correct `batches`, `payments`, and `vendor_ledgers` rows in one transaction; killing the process mid-way (simulated exception injection) leaves zero partial rows.
- A sales return and a purchase return each correctly restore/remove batch stock and post the correct reversing ledger entry; attempting to return more than was sold/purchased throws `InvalidReturnQuantityException`.

---

## Phase 5 — POS System, Split Payments Engine & Dynamic Receipt Generator

**Goal:** The centerpiece — fast, touch-friendly checkout with full split-payment support and a printable dynamic receipt, tying together every prior phase.

**Deliverables:**
- `Pos`, `PosCart`, `PosPaymentSplit` Livewire components: barcode-scan-to-cart, batch selection per line, customer selection (or walk-in), running total.
- `SaleService::create()` fully implemented per [[architecture.md]] §1.2, calling `PaymentSplitService` (enforcing sum-to-total per [[rules.md]] §2 rule 3) and `LedgerService` for any on-account portion.
- `ReceiptRenderService` + `resources/views/receipts/thermal-receipt.blade.php`: dynamic header/footer/logo from `receipt_settings`/`theme_settings`, `@media print` CSS for 58mm/80mm, triggered via browser print immediately after checkout and re-printable from sale history.
- `SaleReturnForm` wired into the POS-adjacent flow for in-shop returns.

**Verification:**
- End-to-end manual test: scan/select 3+ products across different batches, apply a 3-way split payment (cash + bank + ledger remainder) that sums exactly to the total, complete sale, print receipt — verify `sales`, `sale_items`, `payments`, `customer_ledgers`, and `batches.quantity_remaining` all reflect the transaction correctly.
- Attempting a split that doesn't sum to the total is rejected before any row is written.
- Receipt renders correctly (no clipped content) at both 58mm and 80mm print presets, and reflects a changed logo/header/footer immediately after an Admin settings change.
- Full flow tested on a touchscreen tablet viewport with no physical keyboard except the barcode scanner (HID input into a focused field).

---

## Phase 6 — Full Mobile Optimization Polish, Testing & Deployment

**Goal:** Production-readiness: every screen verified on mobile, automated test coverage on the money paths, and a deployed instance.

**Deliverables:**
- Mobile-first responsive pass across every screen built in Phases 1–5 against the standards in [[design.md]] §4 (bottom-sheet POS cart, full-screen mobile ledger view, touch target sizing) — not just POS, but admin/inventory/ledger screens too, per [[prd.md]] §2.7.
- Automated test suite (Pest/PHPUnit) covering: `LedgerService` immutability and running-balance correctness, `PaymentSplitService` sum validation, `SaleService`/`PurchaseService` atomicity (rollback-on-failure), return-quantity capping, policy/role enforcement per §Phase 4.
- `larastan/larastan` static analysis passing at a defined baseline (see [[rules.md]] §3.1).
- Production deployment: environment configuration, queue/scheduler (`CheckExpiringBatches`) running via cron, database backups configured, HTTPS.
- Optional Phase-6 candidates promoted if still needed: `spatie/laravel-activitylog` for settings audit trail (see [[rules.md]] §4.4).

**Verification:**
- Every screen manually walked through at a 360px-wide mobile viewport and a tablet viewport with no horizontal scroll and all touch targets meeting the minimum size in [[design.md]].
- Full test suite green in CI; financial-path tests specifically re-run against a fresh seeded database to rule out state leakage.
- Scheduled expiry check confirmed running in production (log/notification observed on a real 30-day-out seeded batch).
- Smoke test of the full purchase → stock → POS sale → split payment → receipt → return flow performed against the deployed production instance, not just local.

---

## Related Documents

- [[prd.md]] — the features each phase delivers.
- [[architecture.md]] — the structures each phase builds.
- [[rules.md]] — the standards each phase's verification checks against.
- [[design.md]] — the visual/UX standards Phase 1 establishes and Phase 6 finishes enforcing.
- [[memory.md]] — live tracking of phase/task completion status.
