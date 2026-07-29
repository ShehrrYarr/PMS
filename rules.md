# Rules & Standards
## Pesticides Management System

This document is binding for all code written against [[architecture.md]]. Where this document and general Laravel convention disagree, this document wins — the system handles money and stock, so predictability beats idiom.

---

## 1. Coding & Architectural Standards

### 1.1 PHP
- Every PHP file declares `declare(strict_types=1);` as the first statement after `<?php`.
- Follow **PSR-12** formatting; run `laravel/pint` (default preset) before every commit — do not hand-format.
- Prefer typed properties, typed method signatures, and `readonly` properties for value objects (e.g. DTOs passed into services) over untyped arrays.
- Use PHP 8.2 features where they clarify intent: enums (`PaymentMethod`, `LedgerEntryType`, `UserRole` — see [[architecture.md]] §2), readonly properties, first-class callable syntax. Do not use them decoratively where a plain method would do.
- No `mixed` return types on service methods — every service method has a concrete return type (a model, a DTO, or `void`).

### 1.2 Architectural Layering
- **Livewire components validate input and orchestrate; they do not contain business logic.** A component's submit method should read like: validate → call one service method → flash success → reset form. If a component method is doing arithmetic on money or stock, that logic belongs in a service.
- **Services own transactions.** Any service method that writes to more than one table (e.g. `SaleService::create()` touching `sales`, `sale_items`, `batches`, `payments`, `customer_ledgers`) opens its own `DB::transaction()` — never rely on the caller to wrap it.
- **Models stay thin.** Relationships, casts, scopes, and small computed accessors only. No business logic in model methods beyond simple derived attributes (e.g. `Batch::isExpiringSoon()` as a pure date comparison is fine; `Batch::sell()` that touches ledgers is not — that belongs in `SaleService`).
- **Observers are for side effects, not core logic.** `BatchObserver` may dispatch `BatchExpiringSoon` when a batch is saved with an expiry inside the alert window; it must not perform ledger or stock writes.

### 1.3 Livewire v3 Conventions
- Use Livewire v3 **Form Objects** (`Livewire\Form`) for any form with more than 3 fields (purchase entry, POS checkout, vendor/customer forms) — keeps validation rules colocated and testable independent of the component.
- Use `#[Computed]` properties for derived, cacheable-per-request values (e.g. cart total, running ledger balance on a detail page) instead of recalculating in the Blade view or storing redundant public properties.
- Child components (`PosCart`, `PosPaymentSplit`) communicate with their parent via Livewire events (`$this->dispatch()` / `#[On]`), never by reaching into parent public properties directly.
- No business validation logic duplicated between a Form Object's `rules()` and a Service — the Form Object validates shape/presence (required, numeric, exists:), the Service validates business invariants (sufficient stock, payment split sums to total).

### 1.4 Money Handling
- All monetary values are stored as `decimal(12,2)` columns and cast via Eloquent `decimal:2` casts (or a shared `HasMoneyCasts` trait — see [[architecture.md]] §2) — never `float`.
- All monetary arithmetic in PHP uses `bcmath`-safe patterns or string-based decimal comparison where precision matters (payment-split-sum validation); do not compare floats with `==`.
- Currency is always PKR; no currency-conversion logic exists or should be added (see §3 guardrails).

---

## 2. Financial Integrity Rules

These rules exist because a ledger that can silently drift is worse than no ledger at all — the whole point of [[prd.md]] §2.2 is that vendor/customer balances are trustworthy.

1. **Ledger entries are immutable.** `vendor_ledgers` and `customer_ledgers` rows are insert-only. There is no `update` path in `LedgerService` for an existing row, and no route/component should ever attempt one. Corrections are made by inserting a new reversing entry that references the original via `reference_type`/`reference_id`.
2. **Every financial mutation is atomic.** `PurchaseService`, `SaleService`, `SaleReturnService`, `PurchaseReturnService`, and any standalone payment-recording path wrap all of their writes (transaction/return row, line items, batch quantity change, payment rows, ledger entry) in a single `DB::transaction()`. If any step throws, the whole operation rolls back — a sale is never "half posted."
3. **Split payments must sum exactly to the transaction total.** `PaymentSplitService` performs this check before any write occurs, using decimal-safe comparison (not floating point). A mismatch throws `UnbalancedPaymentSplitException` and aborts before the transaction opens.
4. **Running balances are derived, and must remain reproducible.** `running_balance` is stored per-row for fast reads, but it must always equal `previous_running_balance + debit - credit` (or the ledger's defined sign convention — see [[architecture.md]] §3.4). Any maintenance script that recomputes a ledger from scratch must produce identical values to what's stored; if it doesn't, that's a `LedgerMismatchException`-worthy bug, not a "just update the row" fix.
5. **Stock changes and their ledger/payment effects commit together.** A batch's `quantity_remaining` is only ever changed inside the same transaction as the sale/purchase/return that caused it — never as a separate follow-up write.
6. **Returns cannot exceed what was originally transacted.** `sale_items.quantity_returned` and `purchase_items.quantity_returned` are checked against the line's original `quantity` before a return is accepted; exceeding it throws `InvalidReturnQuantityException`.
7. **No silent rounding.** All monetary rounding (if ever needed) happens at `decimal(12,2)` storage precision only, applied consistently; intermediate calculations are not pre-rounded in a way that could make component amounts fail to sum to a total.

---

## 3. Tech Stack Guardrails

### 3.1 Use
| Need | Use |
|---|---|
| Roles/permissions | `spatie/laravel-permission` |
| Barcode generation | `milon/barcode` |
| PDF statements/reports | `barryvdh/laravel-dompdf` |
| Auth scaffolding | `laravel/breeze` (Livewire stack) |
| Formatting/linting | `laravel/pint` |
| Static analysis | `larastan/larastan` (PHPStan for Laravel) — recommended addition for Phase 6 hardening |

### 3.2 Avoid
| Avoid | Why |
|---|---|
| Hand-rolled RBAC / ad-hoc `if ($user->role === 'admin')` checks scattered across components | Use spatie policies/gates consistently — scattered role checks are exactly how a Salesman ends up able to edit a vendor ledger by accident |
| `float`/`double` for any monetary column or calculation | Floating point rounding errors are unacceptable in a financial ledger — see §2 |
| Eloquent polymorphic `morphTo`/`morphMany` for `payments.payable` | Deliberately using an explicit `payable_type` string + `payable_id` int pair instead, resolved manually in `PaymentSplitService`/reports — keeps reporting SQL joinable without polymorphic join gymnastics, at the cost of losing automatic Eloquent relation loading. This is a conscious tradeoff, not an oversight (see [[architecture.md]] §3.17) |
| Queue-based/async processing for core sale/purchase writes | Everything in the sale/purchase/return/payment path must complete synchronously within the request so the receipt can print immediately — no eventual consistency on money |
| A generic multi-tenant package (e.g. `stancl/tenancy`) | Out of scope per [[prd.md]] §1.3 — this is a single-location system; adding tenancy scaffolding now is premature complexity |
| Native ESC/POS printer SDKs or local print-agent bridges | Receipt printing is browser-print HTML per [[prd.md]] §2.6 — do not introduce a native printing dependency |
| Building a `territories`/geo-permission table or middleware | Explicitly dropped — see [[prd.md]] §3, salesmen are role-scoped only, not area-scoped |
| Tax calculation fields/logic | Out of scope per [[prd.md]] §1.3 — don't add `tax_rate`/`tax_amount` columns speculatively |
| Frontend framework (React/Vue) for POS or any screen | Livewire v3 + Alpine.js is the whole frontend stack per [[prd.md]] — don't introduce a second UI paradigm |

### 3.3 YAGNI Discipline
Do not add configuration flags, abstraction layers, or database columns "for future flexibility" that aren't required by a feature in [[prd.md]] or a phase in [[phases.md]]. If a future phase needs it, add it in that phase. Concretely: no multi-warehouse columns, no multi-currency columns, no soft-tenant-id columns, no unused `EnsureActiveShop` middleware logic beyond the pass-through noted in [[architecture.md]] §2 — that stub exists only as a documented extension point, not active logic.

---

## 4. Error Handling & Security

### 4.1 Custom Exceptions
Defined in `app/Exceptions/` (see [[architecture.md]] §2) and caught at the Livewire component boundary to render a user-facing validation message — never allowed to bubble up as a generic 500:
- `InsufficientStockException` — sale/return attempted against a batch without enough `quantity_remaining`.
- `UnbalancedPaymentSplitException` — payment lines don't sum to transaction total.
- `LedgerMismatchException` — a recomputation check finds the stored `running_balance` doesn't match derived value (should only ever fire in maintenance/testing tooling, never in normal request flow — if it fires in production, treat it as a data-integrity incident, not a user error).
- `InvalidReturnQuantityException` — return quantity exceeds what remains returnable on the original line.

### 4.2 Validation
- Every Livewire Form Object defines explicit `rules()` — no relying on implicit casting or client-side-only validation.
- Server-side validation is authoritative; any client-side (Alpine.js) validation is a UX convenience only and must be re-checked server-side.
- Batch selection at POS validates the scanned/selected barcode resolves to an active batch with `quantity_remaining > 0` before it's allowed into the cart.

### 4.3 Authorization
- Every Livewire component that performs a write authorizes via a Policy (`$this->authorize(...)`) or a `spatie` permission check at the top of the action method — not just by hiding the button in the Blade view. UI-level hiding is a courtesy, not a security boundary.
- Role permissions matrix (Admin / Inventory Manager / Accountant / Salesman) is defined once in `RoleAndPermissionSeeder` and referenced by Policies — do not duplicate the permission matrix as inline conditionals in multiple components.

### 4.4 General Web Security
- CSRF protection stays on (Laravel default) — never disable it for POS or any form.
- All user-supplied strings rendered in Blade use default escaping (`{{ }}`); `{!! !!}` is prohibited except for the two explicitly sanitized/admin-controlled fields (`receipt_settings.header_text`/`footer_text`, if rich text is ever introduced — plain text only in v1, so this should not be needed yet).
- File uploads (logo) are validated by MIME type and size server-side, stored outside of publicly-executable paths per Laravel's default `storage`/`public` disk convention, never trusted by client-reported extension alone.
- Audit trail: every financial-write row (`sales`, `purchases`, `payments`, ledger entries, returns) records `user_id`/`created_by` — sufficient for v1 accountability. `spatie/laravel-activitylog` (see [[architecture.md]] §4) is a Phase 6 candidate if settings-change auditing (branding/theme/receipt config) proves necessary beyond model timestamps.

---

## 5. Related Documents

- [[prd.md]] — the features these rules constrain.
- [[architecture.md]] — the structures (services, schema) these rules govern.
- [[phases.md]] — when each rule becomes relevant as features are built.
- [[memory.md]] — decision log referencing why specific guardrails (e.g. dropped territory system, explicit `payable_type` over polymorphism) were chosen.
