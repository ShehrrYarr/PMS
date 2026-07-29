# Design System
## Pesticides Management System

Design direction: **White Glassmorphism** — bright, translucent, high-contrast, bold typography, mobile-first. Every screen (admin, ledgers, inventory, POS) shares this system; POS gets extra emphasis on touch targets and legibility since it's used under counter conditions (fast-paced, sometimes gloved hands, variable lighting).

---

## 1. Glassmorphism Rules

### 1.1 Core Recipe
Glass panels sit on a soft, light gradient background — never pure white behind pure white glass, or contrast collapses.

```css
:root {
  --page-bg-start: #f4f6fa;
  --page-bg-end:   #e9edf5;

  --glass-bg:        rgba(255, 255, 255, 0.55);
  --glass-bg-strong: rgba(255, 255, 255, 0.75);   /* modals, active cards */
  --glass-border:    rgba(255, 255, 255, 0.85);
  --glass-shadow:    0 8px 32px rgba(31, 41, 55, 0.08);

  --blur-panel: 16px;
  --blur-nav:   20px;
}

body {
  background: linear-gradient(160deg, var(--page-bg-start), var(--page-bg-end));
  min-height: 100vh;
}

.glass-panel {
  background: var(--glass-bg);
  backdrop-filter: blur(var(--blur-panel));
  -webkit-backdrop-filter: blur(var(--blur-panel));
  border: 1px solid var(--glass-border);
  border-radius: 1rem; /* rounded-2xl */
  box-shadow: var(--glass-shadow);
}
```

### 1.2 Panel Hierarchy
| Element | Background | Blur | Notes |
|---|---|---|---|
| Navbar / Sidebar | `--navbar-*` / `--sidebar-*` custom properties (see §2) at ~85% opacity | `--blur-nav` (20px) | Needs stronger opacity than content cards since it holds nav text at all times |
| Content cards (dashboard widgets, list rows) | `--glass-bg` (55%) | `--blur-panel` (16px) | Default card treatment |
| Modals / active POS cart panel | `--glass-bg-strong` (75%) | `--blur-panel` | Higher opacity — these hold critical, must-not-be-ambiguous data (payment split, cart total) |
| Ledger tables | Solid white (`#ffffff`) rows on a glass card wrapper | n/a on rows | Financial tables prioritize scan-ability over aesthetic — glass on the container, not on individual data rows |

### 1.3 Contrast Rule (non-negotiable)
Text on any glass surface must meet **WCAG AA (4.5:1)** minimum against the *effective* rendered color (glass background composited over the page gradient), not just against the glass color alone. In practice: body text is `#1a202c` (near-black) on all glass panels; never place text below `#4a5568` gray on a glass surface. Financial figures (amounts, running balances) are always full-weight `#1a202c` or the semantic debit/credit color (§2.3), never a muted gray, regardless of surrounding UI hierarchy.

---

## 2. Color Palette & CSS Custom Properties

### 2.1 Base Palette (defaults, overridden per-shop via `theme_settings`)
```css
:root {
  /* Admin-configurable — seeded defaults, read from theme_settings at runtime */
  --navbar-primary-color:   #2f6f4f;   /* deep agro-green, evokes the product domain */
  --navbar-accent-color:    #e8f5ee;
  --sidebar-primary-color:  #1f4d38;
  --sidebar-accent-color:   #eaf6f0;

  /* Fixed system colors — not admin-configurable */
  --color-success: #1f8a4c;
  --color-danger:  #c0392b;
  --color-warning: #d98c00;
  --color-info:    #2563eb;

  --text-primary:   #1a202c;
  --text-secondary: #4a5568;
  --text-on-dark:   #f7fafc;
}
```

Rendering: `Admin > Branding Settings` writes to `theme_settings`; `layouts/app.blade.php` injects a `<style>` block (or inline `style="--navbar-primary-color: ..."` on the root element) computed from the current row, so no CSS rebuild/deploy is needed to change a shop's colors — matches [[prd.md]] §2.1 acceptance criteria.

### 2.2 Navbar / Sidebar Application
- Navbar: `background: color-mix(in srgb, var(--navbar-primary-color) 85%, white)` composited with the glass blur (§1.1) — keeps the admin-chosen hue visible through the translucency rather than washing it out to plain white.
- Sidebar: same pattern with `--sidebar-primary-color`; active nav item uses `--sidebar-accent-color` as its background pill.
- Admin must be able to pick any hex value; the UI (color picker in `BrandingSettings`) should warn (not block) if the chosen color would fail contrast against `--text-on-dark` for navbar text — a soft validation, not a hard rule, since it's the shop owner's brand choice.

### 2.3 Semantic Ledger Colors
- **Debit (money owed to the shop / shop's receivable increasing)**: rendered in `--color-success` green when it represents an inflow-favorable event from the shop's perspective, `--color-danger` red when it represents an outflow/liability increasing — the exact mapping is defined once in `LedgerService`'s formatting helper and must be applied consistently across `VendorLedger`, `CustomerLedger`, and receipt views, never re-decided ad hoc per view.
- Running balance: bold, larger font weight than individual line entries — it's the number a shop owner scans for first.

---

## 3. Typography Matrix

### 3.1 Font Families
| Locale | Direction | Font | Fallback stack |
|---|---|---|---|
| English (`en`) | LTR | **Inter** | `Inter, ui-sans-serif, system-ui, sans-serif` |
| Urdu (`ur`) | RTL | **Noto Nastaliq Urdu** (display/headings) + **Noto Sans Arabic** (body/UI-dense areas like tables and POS) | `"Noto Nastaliq Urdu", "Noto Sans Arabic", ui-sans-serif, sans-serif` |

Rationale: Noto Nastaliq Urdu is the correct calligraphic register for headings/receipt text and reads as authentically Urdu, but it's visually heavier and less compact than Noto Sans Arabic — using it for dense UI (data tables, POS cart lines) hurts scan speed. Nastaliq is reserved for headings, receipt header/footer, and branding; Noto Sans Arabic handles body/table/form text in Urdu mode.

### 3.2 Scale (bold, oversized per [[prd.md]] "high-contrast, larger typography" requirement)
```css
:root {
  --font-size-xs:   0.875rem;  /* 14px — table meta only */
  --font-size-sm:   1rem;      /* 16px — baseline body, never smaller */
  --font-size-base: 1.125rem;  /* 18px — default UI text */
  --font-size-lg:   1.375rem;  /* 22px — card headings, POS product names */
  --font-size-xl:   1.75rem;   /* 28px — section headings */
  --font-size-2xl:  2.25rem;   /* 36px — dashboard KPI numbers, POS total */

  --font-weight-body: 500;      /* medium, not thin — nothing in this system is font-weight 300/400 */
  --font-weight-emphasis: 700;  /* bold — amounts, running balances, buttons */
}
```
- No text anywhere renders below `--font-size-sm` (16px) — this is a counter-use system, often viewed at arm's length or by staff who aren't stationary.
- POS product name, quantity, and line total: `--font-size-lg`, `--font-weight-emphasis`.
- POS running total: `--font-size-2xl`, `--font-weight-emphasis`, always in a fixed, always-visible position (not scrolled out of view on mobile — see §4).
- Urdu body text is rendered ~1 step larger than the equivalent English size (`--font-size-base` → effectively `--font-size-lg` in `ur` locale) since Noto Sans Arabic/Nastaliq read smaller at equivalent pixel size than Inter.

---

## 4. Mobile-First Touch UI Standards

### 4.1 Touch Targets
- Minimum touch target: **44×44px** (Apple HIG / WCAG 2.5.5 baseline), applied to every button, list row action, and form control across the entire system — not just POS.
- Minimum spacing between adjacent tappable elements: **8px**, to prevent mis-taps on a shop counter tablet.

### 4.2 POS Mobile Layout — Bottom Sheet Cart
- On viewports below `768px` (tablet breakpoint), the POS cart (`PosCart`) collapses into a persistent **bottom sheet**: a collapsed bar showing item count + running total is always docked to the bottom of the screen; tapping it expands the full cart/checkout flow over the product grid.
- Product search/scan input stays pinned to the top of the viewport at all times (scanner input must never require scrolling to reach).
- `PosPaymentSplit` opens as a full-screen modal on mobile (not an inline panel) — split payment entry needs focus without the product grid competing for space.

### 4.3 Mobile Ledger Views
- `VendorLedger`/`CustomerLedger` tables collapse from a multi-column table to **stacked full-screen cards** per entry below `640px` — each card shows date, description, debit/credit, and running balance in a fixed vertical order, avoiding horizontal scroll (horizontal-scroll tables are explicitly disallowed on mobile per [[prd.md]] §4.4).
- Filters (date range, transaction type) collapse into a single "Filters" bottom sheet trigger rather than an inline filter bar on mobile.

### 4.4 Receipt Print CSS
```css
@media print {
  body * { visibility: hidden; }
  #receipt, #receipt * { visibility: visible; }
  #receipt {
    position: absolute; left: 0; top: 0;
    width: 80mm; /* or 58mm per receipt_settings.paper_width */
    font-family: "Noto Sans Arabic", Inter, sans-serif; /* single stack covers both locales on thermal paper */
    font-size: 12px;
    color: #000;
  }
}
```
- Receipt always prints in high-contrast black-on-white regardless of the active admin theme colors — glassmorphism and brand colors are a screen-only concept, never applied to print output.
- Both 58mm and 80mm presets are validated against real content (long product names, Urdu text) to confirm no clipping — see [[phases.md]] Phase 5 verification.

### 4.5 General Mobile-First Rules
- All layouts are built mobile-first in Tailwind (`base` styles = mobile, `md:`/`lg:` prefixes add desktop enhancements) — never the reverse (building desktop then trying to cram it down).
- No feature is desktop-only. If a feature can't reasonably fit a phone screen (e.g. a dense report), it degrades to a stacked/scrollable single-column layout rather than being hidden on mobile.

---

## 5. Related Documents

- [[prd.md]] — mobile/localization requirements this design system implements.
- [[architecture.md]] — `theme_settings`/`receipt_settings` schema that drives §2 and §4.4.
- [[phases.md]] — Phase 1 establishes the base system, Phase 6 finishes enforcing it everywhere.
