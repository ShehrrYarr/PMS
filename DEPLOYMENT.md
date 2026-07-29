# Deployment Runbook — Namecheap Shared Hosting (cPanel)

This is a step-by-step checklist for deploying the Pesticides Management
System to Namecheap shared hosting. It assumes a standard Stellar/Stellar
Plus/Stellar Business cPanel plan. Steps are marked **[SSH]** where a
terminal (available on Stellar Plus and above, or on request from
support) makes life easier, with a File-Manager-only alternative given
alongside.

There is no CI/CD here — this is a manual push-button-free deploy. Follow
the checklist top to bottom on first deploy; see [Redeploying an update](#redeploying-an-update)
for the shorter loop after that.

---

## 0. Before you start

Gather these first:

- cPanel login (username + password) and your domain name.
- Confirm your plan's PHP version options support **PHP 8.2** (Namecheap's
  MultiPHP Manager lists available versions per domain — this app is
  pinned to `^8.2` in `composer.json` and has not been tested against 8.3+).
- Decide whether you have SSH access (Manage → check for "SSH Access" in
  cPanel, or ask Namecheap support to enable it on Stellar Plus/Business).

---

## 1. Create the MySQL database

In cPanel → **MySQL Databases**:

1. Create a database, e.g. `pesticides` → cPanel will prefix it to
   something like `cpuser_pesticides`.
2. Create a database user with a strong, generated password.
3. Add the user to the database with **All Privileges**.
4. Note the full prefixed database name, username, and password — you'll
   need them for `.env`. Host is almost always `localhost`.

---

## 2. Select the PHP version and verify extensions

In cPanel → **MultiPHP Manager**: select your domain, set PHP version to
**8.2**.

Then in cPanel → **MultiPHP INI Editor** (or "Select PHP Extensions"),
confirm these are **enabled** for the domain — the app will fail or
silently corrupt money math without them:

- `bcmath` — **critical**: every price/quantity calculation in this app
  uses bcmath string arithmetic (never floats); if disabled, purchases,
  sales, and ledger postings will fatal-error immediately.
- `gd` — needed by `milon/barcode` to render batch barcode images.
- `gmp` — used by the same barcode library for Code128 checksum math.
- `mbstring`, `openssl`, `pdo_mysql`, `curl`, `fileinfo`, `tokenizer`,
  `xml`, `ctype`, `intl`, `zip` — standard Laravel requirements; usually
  on by default on Namecheap, but worth a quick visual check.

---

## 3. Restructure the document root (the `public/` trick)

Shared hosting serves whatever is in `public_html/` directly — it has no
concept of Laravel's `public/` being the *only* web-exposed folder. If you
upload the whole Laravel app as-is into `public_html/`, your `.env`,
`app/`, and `database/` folders become downloadable by anyone who guesses
the URL. Two options, pick one:

**Option A — subfolder + symlink (recommended, keeps cPanel's default doc root):**

1. Upload/clone the entire Laravel app into a folder *outside*
   `public_html`, e.g. `~/pesticides-app/`.
2. Delete the default `public_html/` (back up anything in it first) and
   replace it with a symlink to the app's `public/` folder:
   ```bash
   rm -rf ~/public_html
   ln -s ~/pesticides-app/public ~/public_html
   ```
   **[No SSH]** cPanel File Manager can't create symlinks — instead, ask
   Namecheap support to run the two commands above for you (a common,
   quick request), or use Option B.

**Option B — addon-domain-style doc root change (no symlink needed):**

1. Upload the entire Laravel app into `~/pesticides-app/`.
2. In cPanel → **Domains**, edit your domain's **Document Root** to point
   at `~/pesticides-app/public` directly.

Either way, everything except the compiled `public/build` assets and
`public/index.php` stays outside the web-servable directory — this is
the whole point.

---

## 4. Get the code onto the server

This project is not currently in a git repository. Two paths:

**Zip upload (works on every plan tier, no SSH needed):**

1. Locally, build production assets first: `npm run build`.
2. Zip the project folder, **excluding** `node_modules/`, `vendor/`,
   `.git/` (if you later init one), and your local `.env` — none of
   these belong on the server as-is (vendor gets reinstalled server-side
   or uploaded separately, see step 5).
3. In cPanel **File Manager**, upload the zip into `~/pesticides-app/`
   and extract it there.

**[SSH] git clone (nicer for future redeploys):**

If you'd rather deploy from git going forward, initialize a repo locally
first (`git init`, push to GitHub/GitLab — private, since this contains
business logic), then on the server:
```bash
git clone <your-repo-url> ~/pesticides-app
```

---

## 5. Install PHP dependencies

**[SSH] (preferred):**
```bash
cd ~/pesticides-app
composer install --no-dev --optimize-autoloader
```
`--no-dev` skips phpstan/phpunit/faker/pint/sail — none of which belong
on a production server. If `composer` isn't on `$PATH`, cPanel usually
exposes it as `~/bin/composer` or you can install it directly via cPanel
→ **Setup Node.js/PHP App** helper tools.

**[No SSH] fallback:**
Run `composer install --no-dev --optimize-autoloader` on your local
machine, then upload the resulting `vendor/` folder alongside the app
code (it'll be tens of MB — zip it, upload via File Manager, extract).

---

## 6. Upload compiled frontend assets

Vite's build output (`public/build/`) is what the browser actually loads
— run the build **locally** (shared hosting has no Node.js build step
here) and upload the folder:
```bash
npm run build
```
Then upload the generated `public/build/` directory into the server's
`public/build/` (via File Manager or `scp`/`rsync` if you have SSH).

---

## 7. Configure `.env`

Copy `.env.production.example` (in the project root) to `.env` on the
server and fill in the real values — **do not** reuse the local dev
`.env`. Key things to set:

- `APP_KEY` — leave blank for now, generated in step 8.
- `APP_ENV=production`, `APP_DEBUG=false` — **never** leave debug mode on
  in production; it leaks stack traces (including `.env` values in some
  cases) to any visitor who triggers an error.
- `APP_URL=https://yourdomain.com` — must match the real HTTPS URL once
  step 11's SSL is live, since Livewire and asset URLs are generated from it.
- `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` — from step 1.
- `MAIL_*` — cPanel → **Email Accounts** → create a mailbox (e.g.
  `noreply@yourdomain.com`) → **Connect Devices** shows the exact SMTP
  host/port for that domain.

Also set file permissions so the file isn't web-readable:
```bash
chmod 640 .env
```

---

## 8. Generate app key, migrate, and seed

**[SSH]:**
```bash
php artisan key:generate --force
php artisan migrate --force
```
`--force` is required in production since Laravel normally prompts for
confirmation before running migrations there.

**Do not run `php artisan db:seed` (the default `DatabaseSeeder`) on
production.** It creates four demo accounts — including
`admin@example.com` with the password `password` — that exist purely for
local development and testing (see `database/seeders/DatabaseSeeder.php`).
Shipping those to a public server would hand out a working admin login to
anyone who reads this file. Instead, seed only the non-user reference
data, then create one real Admin account by hand:
```bash
php artisan db:seed --class=RoleAndPermissionSeeder
php artisan db:seed --class=ThemeSettingSeeder
php artisan db:seed --class=ReceiptSettingSeeder
php artisan tinker
```
Inside tinker:
```php
$user = \App\Models\User::create([
    'name' => 'Your Real Name',
    'email' => 'you@yourdomain.com',
    'password' => bcrypt('a-strong-unique-password'),
]);
$user->assignRole(\App\Enums\UserRole::Admin->value);
```
Log in with that account afterward and create any additional
Inventory/Accountant/Salesman users from the app's own user management —
per `prd.md` §3.1, users are meant to be Admin-created, not seeded.

**[No SSH]:** the same three `db:seed --class=...` commands and the
tinker snippet above can be run through cPanel's **Terminal** if
available under your plan, or by temporarily wrapping the tinker snippet
in a one-off `php artisan make:command` invoked once and then deleted —
ask if you land on a plan with no shell access at all and this needs a
web-based workaround.

---

## 9. Link the storage disk

The theme settings' logo (`theme_settings.logo_path`, rendered on the
printed receipt) is served from the `public` filesystem disk, which
needs the standard Laravel symlink:
```bash
php artisan storage:link
```
If this fails with a permissions/function-disabled error (some
budget hosts disable PHP's `symlink()`), ask Namecheap support to create
it manually: `ln -s ~/pesticides-app/storage/app/public ~/pesticides-app/public/storage`.
No logo has been uploaded yet in this app's UI as of Phase 6, but the
receipt view already reads from this path, so it's needed before that
feature is exercised.

---

## 10. Set file/folder permissions

Laravel needs to write to two directories at runtime (cache, sessions,
logs, compiled views):
```bash
chmod -R 755 storage bootstrap/cache
```
If the web server runs as a different user/group than your shell user
(uncommon on cPanel, where PHP-FPM usually runs as your account), you may
need `775` instead — only escalate if you hit a "permission denied"
writing to `storage/logs/laravel.log`.

Also cache the framework's config/routes/views for production performance:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
**Important:** if you change `.env` after this, you must re-run
`php artisan config:cache` — cached config silently ignores further
`.env` edits until you do.

---

## 11. Enable HTTPS (AutoSSL)

In cPanel → **SSL/TLS Status**, select your domain and run **AutoSSL** (or
it may already auto-provision within a few hours of the domain resolving
to Namecheap's server). Once the padlock is live:

- Confirm `APP_URL` in `.env` uses `https://`, then `php artisan config:cache` again.
- Confirm `SESSION_SECURE_COOKIE=true` is set (already in
  `.env.production.example`) so session cookies aren't sent over plain HTTP.
- Optional but recommended: in cPanel → **Domains**, turn on **Force
  HTTPS Redirect** for the domain.

---

## 12. Set up the scheduler (cron)

`CheckExpiringBatches` (the 30-day expiry alert sweep) runs via Laravel's
scheduler (`routes/console.php`), which itself needs exactly **one** cron
entry — Laravel dispatches whatever's actually due internally, so you
never add a cron line per command.

In cPanel → **Cron Jobs**, add (every minute):
```
* * * * * cd /home/<cpuser>/pesticides-app && php artisan schedule:run >> /dev/null 2>&1
```
Replace `/home/<cpuser>/pesticides-app` with the real absolute path from
step 3/4. Verify `php` on the cron `$PATH` resolves to PHP 8.2 — if
cPanel's cron environment defaults to a different CLI PHP version than
the one selected for the domain, use the version-specific binary instead,
e.g. `/usr/local/bin/php82 artisan schedule:run` (check cPanel → MultiPHP
Manager or ask support for the exact binary path on your account).

---

## 13. Post-deploy smoke test

Walk through this once, live, against the real domain — matches
`phases.md` Phase 6's verification checklist:

- [ ] `https://yourdomain.com` loads the login page over a valid padlock, no mixed-content warnings.
- [ ] Log in as the real Admin account created in step 8.
- [ ] Dashboard loads with theme colors applied (confirms `theme_settings` seeded correctly).
- [ ] Create a vendor, then a product + batch (confirms migrations + bcmath extension both working — a bcmath failure here throws immediately).
- [ ] Record a full purchase with a split payment; confirm it appears in the vendor ledger.
- [ ] Complete a POS sale; confirm the thermal receipt view renders and browser-prints cleanly.
- [ ] Confirm `storage/logs/laravel.log` has no unexpected errors from the above (`tail -n 50 storage/logs/laravel.log` over SSH, or view via File Manager).
- [ ] Confirm the cron entry exists and, after it's had a minute to fire at least once, that no error appears for it in cPanel → Cron Jobs' delivery log.

---

## 14. Backups

Namecheap's cPanel plans include **JetBackup** (or similar) under
**Backup** / **Backup Wizard** — confirm automatic daily backups are
enabled for both the MySQL database and the home directory (which covers
`.env`, `storage/app`, and everything else outside `public_html`). This
is the only durable copy of ledger/transaction history; don't rely on
"I'll redeploy from the zip" as a backup strategy — that only restores
code, not data.

---

## Redeploying an update

Once the app is live, a normal code change doesn't need to repeat every
step above:

1. Locally: run the test suite (`php artisan test`) and `npm run build`.
2. Upload changed files (or the new `public/build/` + changed `app/`,
   `resources/`, `routes/`, `database/migrations/` as needed) — via File
   Manager or `rsync`/`scp` if you have SSH.
3. **[SSH]**
   ```bash
   composer install --no-dev --optimize-autoloader   # only if composer.json changed
   php artisan migrate --force                        # only if new migrations exist
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Re-run the relevant parts of the step-13 smoke test for whatever you changed.

---

## Related documents

- [`memory.md`](memory.md) — architectural decisions and phase history.
- [`phases.md`](phases.md) — Phase 6's deployment scope this runbook fulfills.
- [`.env.production.example`](.env.production.example) — the production
  environment template referenced in step 7.
