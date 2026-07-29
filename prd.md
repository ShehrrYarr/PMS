# Product Requirements Document (PRD)
## Pesticides Management System

**Version:** 1.0
**Status:** Draft — Foundational
**Stack:** Laravel (PHP 8.2), Livewire v3, Alpine.js, Tailwind CSS, MySQL

---

## 1. Executive Summary

The Pesticides Management System is a single-location, single-tenant retail and inventory management platform built for a pesticide/agro-chemical shop that sells over the counter. It replaces manual ledgers and spreadsheets with a unified system covering procurement (vendors/purchases), inventory (products, batches, expiry), point-of-sale (POS) retail transactions, customer/vendor financial ledgers, and multi-mode payment settlement — all wrapped in a modern, mobile-first, bilingual (English/Urdu) interface.

The system is operated from one physical counter/computer (with additional devices — tablets, phones — usable for the same shop), by a small set of role-based staff: an Admin who configures and oversees the business, an Inventory Manager who manages stock, an Accountant who manages money and ledgers, and one or more Salesmen who run the POS. There is no multi-branch, multi-warehouse, or multi-tenant requirement in this version — the architecture should stay simple and avoid speculative complexity (see [[architecture.md]] for schema and [[rules.md]] for the guardrail against premature abstraction).

### 1.1 Problem Statement

Pesticide retailers currently track stock, expiry, and customer/vendor credit manually or in disconnected spreadsheets. This causes:
- Sale of expired or near-expired stock (safety and regulatory risk).
- No real-time visibility into who owes the shop money (customer credit) or who the shop owes (vendor credit).
- Slow, error-prone checkout with no barcode/batch traceability.
- No unified record of split payments (part cash, part bank, part credit).
- No language flexibility for Urdu-speaking staff/customers on receipts and UI.

### 1.2 Goals

- Give every batch of every product a barcode, an expiry date, and automatic 30-day-prior expiry alerts.
- Give every vendor and customer a live, accurate financial ledger (debit/credit/running balance) that is never silently wrong.
- Support fast, touch-friendly, barcode-driven POS checkout with split payments across cash, bank account, and on-account credit.
- Support sales and purchase returns that correctly reverse both stock and ledger effects.
- Provide a fully bilingual (English LTR / Urdu RTL), fully mobile-responsive UI, including the POS itself.
- Provide dynamic branding (logo, receipt header/footer, navbar/sidebar theme colors) configurable by the Admin without code changes.

### 1.3 Out of Scope (v1)

- Multi-branch / multi-warehouse inventory transfer.
- Multi-tenant SaaS (separate businesses on one install).
- Tax calculation (GST/Sales Tax) — no tax fields or logic in v1.
- Geographic/territory-based salesman permissions — replaced by simple role-based access (see §4).
- Automatic FIFO/LIFO batch allocation — batch selection at sale is manual (see §2.3).
- Native ESC/POS print-agent integration — receipt printing is browser-based (see §2.6).
- Online storefront / e-commerce.

---

## 2. Feature Modules

### 2.1 Admin Panel & Dynamic Branding

- Admin can upload/replace the system logo (used in navbar, login screen, and printed receipts).
- Admin can configure dynamic receipt header text/image and footer text (e.g. return policy, thank-you note, shop address/phone) independent of code — stored in `receipt_settings`.
- Admin can set primary and accent colors for the Navbar and Sidebar independently, stored in `theme_settings`, applied via CSS custom properties (see [[design.md]]).
- Admin manages global settings: shop name, address, contact info, default currency display (PKR), default language.
- Admin manages bank accounts used for "Bank Transfer" payments (see §2.5).

**Acceptance criteria**
- Changing the logo or theme colors reflects across the entire UI (including POS and receipts) without a deploy — settings are read from the database, not `.env` or config files.
- Receipt header/footer changes are visible on the very next printed receipt.

### 2.2 Vendor & Customer Management with Financial Ledgers

- CRUD for Vendors (suppliers): name, contact, address, opening balance, active/inactive status.
- CRUD for Customers: name, contact, address, opening balance, active/inactive status.
- Every vendor and every customer has a dedicated, append-only ledger (`vendor_ledgers`, `customer_ledgers`) recording every debit, credit, and the resulting running balance — driven automatically by purchases, sales, payments, and returns (never hand-edited).
- Ledger detail view: filterable by date range, transaction type, running balance shown per row, exportable/printable statement.
- Dashboard-level "who owes us" (customer receivables) and "who we owe" (vendor payables) summaries.

**Acceptance criteria**
- Every financial event that touches a vendor or customer (purchase on credit, sale on credit, payment received, payment made, return) produces exactly one corresponding ledger entry, atomically, in the same database transaction as the source event (see [[rules.md]] Financial Integrity Rules).
- Ledger entries are immutable — corrections happen via reversing entries, never edits or deletes.

### 2.3 Product, Batch, Barcode & Expiry Alert Engine

- Products have a name, SKU, category, unit of measure, and default sale price.
- Every purchase-in creates or adds to a **batch**: manufacturing date, expiry date, quantity received, cost price, and a **unique auto-generated barcode** per batch (not per product — two batches of the same product have two different barcodes because they may expire on different dates).
- At the POS, the salesman scans or selects the specific batch being sold (manual batch selection — no automatic FIFO/LIFO allocation, per business decision). This keeps expiry traceability accurate to what's physically handed to the customer.
- **Expiry Alert Engine**: a scheduled job scans all batches daily; any batch reaching 30 days before its expiry date triggers an alert (in-app notification list + optionally email to Admin/Inventory Manager). Alerts continue to reflect batches that remain unsold as they get closer to / past expiry (escalating severity: 30/15/7/0 days).
- Stock levels are computed per batch and rolled up per product.

**Acceptance criteria**
- A batch barcode, once generated, is never regenerated or reused, even if the batch is fully depleted or returned.
- The expiry alert list is always queryable on-demand (not just via scheduled notification) — e.g. an "Expiring Soon" dashboard widget/report.
- Selling from a batch with zero remaining quantity is blocked with a clear validation error.

### 2.4 Sales & Purchase Returns

- **Sales Return**: a customer returns previously purchased items (in full or partial quantity) tied to a specific original sale/batch; stock is added back to the originating batch, and the customer's ledger is credited (money owed to them, or reduction of what they owe) for the returned value.
- **Purchase Return**: the shop returns previously received stock to a vendor (e.g. damaged/expired goods); stock is removed from the batch, and the vendor's ledger is debited (reduction of what the shop owes, or a credit due to the shop) for the returned value.
- Returns require a reason code and reference the original transaction; partial returns are supported at the line-item level.

**Acceptance criteria**
- A return can never bring a batch's sold/received quantity below zero relative to the original transaction (can't return more than was sold/purchased).
- Every return produces a reversing ledger entry, never a mutation of the original sale/purchase ledger entry.

### 2.5 Multi-Channel Payment & Split Settlement Engine

- Supported payment types per transaction (purchase or sale): **Cash**, **Bank Transfer** (with a dropdown of specific configured bank accounts from `banks`), and **On-Account/Credit** (posted directly to the vendor/customer ledger).
- **Split payments**: a single sale or purchase can be settled across multiple payment types simultaneously — e.g. part cash + part bank transfer + remainder to ledger — with the sum of all payment lines required to exactly equal the transaction total (down to the smallest currency unit, no rounding drift).
- Two ledger-posting modes are supported:
  - **Full ledger credit**: entire transaction amount posted to the customer/vendor ledger (nothing collected at time of transaction).
  - **Partial payment + ledger remainder**: any amount not covered by cash/bank is automatically posted to the ledger, and the receipt reflects the split instantly.

**Acceptance criteria**
- A transaction cannot be finalized if its payment lines don't sum exactly to the transaction total.
- Each payment line is recorded individually in `payments` (method, amount, bank account if applicable) and is auditable back to its parent sale/purchase.
- All payment lines + resulting ledger entry are written in a single atomic database transaction (see [[rules.md]]).

### 2.6 POS Module & Dynamic Thermal Receipt Engine

- Fast, touch/mobile-friendly POS screen: product search, barcode scan input (USB HID keyboard-wedge scanner support — scanning acts like fast keyboard entry into a focused search field), cart with quantity/price editing, batch selection per line item, running total.
- Customer selection (optional/walk-in vs named customer for on-account sales).
- Checkout screen supports the full split-payment flow from §2.5.
- Receipt is generated as an HTML/CSS view styled for 58mm/80mm thermal roll widths and printed via the browser's native print dialog (`window.print()` with `@media print` rules) — no native print-agent required, works from any device with a browser and a connected/default thermal or regular printer.
- Receipt content (header, footer, logo) is fully dynamic, pulled from `receipt_settings` and `theme_settings` at render time.

**Acceptance criteria**
- POS is fully usable on a touchscreen tablet with no keyboard, aside from optional barcode scanner input.
- A completed sale is receipt-printable immediately and re-printable later from sale history without data loss.
- Receipt layout does not break or clip content on either 58mm or 80mm paper width presets.

### 2.7 Multi-Language (English/Urdu RTL) & Mobile Optimization

- One-click language toggle switches the entire UI (including POS, ledgers, receipts) between English (LTR) and Urdu (RTL) using Laravel's localization (`lang/en`, `lang/ur`) plus a `dir="rtl"` layout switch.
- All layouts — admin dashboards, ledgers, inventory screens, and POS — are fully responsive and usable on mobile phones and tablets, not just desktop (see [[design.md]] for mobile-first UI standards).

**Acceptance criteria**
- Switching language does not require a page-breaking reload of unrelated state (cart contents, filters, etc. persist across the toggle where feasible).
- RTL mode correctly mirrors layout direction (sidebar, table columns, form alignment), not just text direction.

---

## 3. User Roles & Authorization

Roles are implemented via `spatie/laravel-permission`. There is no geographic/territory restriction in this system — permissions are purely role-based (see [[rules.md]] and [[phases.md]] Phase 4 for how this replaces the originally-considered territory system, dropped because all salesmen operate from the same physical counter).

| Role | Access |
|---|---|
| **Admin** | Full access: branding/theme settings, receipt settings, bank accounts, user & role management, all modules, all reports. |
| **Inventory Manager** | Products, batches, barcodes, expiry alerts, vendors, purchases, purchase returns. No access to theme/branding settings, no access to customer ledgers beyond read-only, no user management. |
| **Accountant** | Vendor & customer ledgers, payments, bank accounts (view/reconcile), all financial reports. Read-only on products/batches/POS. No user management, no branding settings. |
| **Salesman** | POS/sales screen only: create sales, select customer, select batch, process split payment, print receipt, process sales returns. No access to purchases, vendor ledgers, branding, or user management. |

### 3.1 Authentication

- Laravel Breeze (Livewire stack) provides login, password reset, and session scaffolding — no self-registration in production (users are created by Admin only).

---

## 4. Non-Functional Requirements & Performance Benchmarks

### 4.1 Performance
- POS "add to cart" via barcode scan to visible cart update: **< 300ms**.
- Full POS checkout (cart finalize → payment posted → receipt rendered): **< 2 seconds** end-to-end on standard shop broadband/local network.
- Ledger statement page (500+ rows) initial render: **< 1.5 seconds**.
- Expiry alert scan (scheduled job) processes the full batch table nightly without blocking other scheduled jobs.

### 4.2 Reliability & Data Integrity
- No financial operation (sale, purchase, payment, return) may partially commit — all are wrapped in atomic database transactions (see [[rules.md]]).
- Ledger running balances must always be reproducible by summing entries in order — no drift between a stored `running_balance` column and a recomputation from raw entries.

### 4.3 Compatibility
- Supported browsers: latest Chrome, Edge, Safari (desktop and mobile).
- Print output verified against 58mm and 80mm thermal printer widths via browser print, plus standard A4 fallback for non-thermal printers (via `barryvdh/laravel-dompdf` for statement/report PDFs, not per-sale receipts).
- Barcode scanners: standard USB HID keyboard-wedge devices (no special driver integration required).

### 4.4 Responsiveness
- Every screen (including POS and ledgers) must be fully usable at mobile viewport widths (≥360px) with no horizontal scroll and thumb-friendly touch targets (see [[design.md]] §4).

### 4.5 Localization
- All user-facing strings sourced from `lang/en` and `lang/ur` — no hardcoded UI strings in Blade/Livewire views.
- RTL support is a full layout mirror, not a text-direction-only patch.

---

## 5. Related Documents

- [[architecture.md]] — system architecture, folder structure, database schema, packages.
- [[rules.md]] — coding standards, financial integrity rules, security guardrails.
- [[phases.md]] — phased delivery plan with verification criteria.
- [[design.md]] — glassmorphism design system, color/typography specs, mobile UI standards.
- [[memory.md]] — living project state tracker and decision log.
