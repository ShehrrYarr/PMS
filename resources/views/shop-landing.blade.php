<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pesticides Management System — Run your shop, simplified</title>
        <meta name="description" content="Point of sale, inventory & expiry tracking, vendor/customer ledgers, purchases, and reports for pesticide and agro-input retailers — in English or Urdu.">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700;800&family=Noto+Nastaliq+Urdu:wght@500;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css'])
    </head>
    <body class="relative min-h-screen overflow-x-hidden font-sans antialiased">
        {{-- Decorative glow blobs — purely visual, matches the app's glass aesthetic --}}
        <div class="pointer-events-none fixed -top-32 -start-32 h-96 w-96 rounded-full bg-[var(--sidebar-primary-color)]/20 blur-3xl"></div>
        <div class="pointer-events-none fixed top-1/3 -end-40 h-[28rem] w-[28rem] rounded-full bg-[var(--color-info)]/10 blur-3xl"></div>

        <div class="relative">
            <header class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-6 py-6">
                <div class="flex items-center gap-2 text-lg font-bold text-[var(--text-primary)]">
                    <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-[var(--sidebar-primary-color)] text-[var(--text-on-dark)]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3M5.6 5.6l2.1 2.1m8.6 8.6 2.1 2.1M3 12h3m12 0h3M5.6 18.4l2.1-2.1m8.6-8.6 2.1-2.1"/><circle cx="12" cy="12" r="3.25"/></svg>
                    </span>
                    <span data-en="Pesticides Management System" data-ur="پیسٹیسائیڈز مینجمنٹ سسٹم">Pesticides Management System</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="inline-flex items-center gap-1 rounded-full bg-white/40 p-1 text-sm font-semibold" role="group" aria-label="Language">
                        <button type="button" id="lang-btn-en" onclick="setLandingLang('en')" class="lang-btn min-h-[36px] rounded-full px-3 py-1.5 transition">English</button>
                        <button type="button" id="lang-btn-ur" onclick="setLandingLang('ur')" class="lang-btn min-h-[36px] rounded-full px-3 py-1.5 transition">اردو</button>
                    </div>
                    <a href="{{ route('demo.login') }}" class="rounded-xl bg-[var(--sidebar-primary-color)] px-4 py-2 text-sm font-bold text-[var(--text-on-dark)] shadow-sm transition hover:opacity-90" data-en="See Demo" data-ur="ڈیمو دیکھیں">
                        See Demo
                    </a>
                </div>
            </header>

            <main class="mx-auto max-w-6xl px-6 pb-24 pt-10 sm:pt-16">
                {{-- Hero --}}
                <section class="text-center">
                    <span class="glass-panel inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-bold uppercase tracking-wide text-[var(--sidebar-primary-color)]" data-en="Built for pesticide &amp; agro-input retailers" data-ur="پیسٹیسائیڈز اور زرعی ان پٹ ریٹیلرز کے لیے تیار کردہ">
                        Built for pesticide &amp; agro-input retailers
                    </span>

                    <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-extrabold leading-tight text-[var(--text-primary)] sm:text-5xl">
                        <span data-en="Run your shop like clockwork —" data-ur="اپنی دکان کو بالکل صحیح طریقے سے چلائیں —">Run your shop like clockwork —</span>
                        <span class="text-[var(--sidebar-primary-color)]" data-en="from the till to the ledger." data-ur="کاؤنٹر سے لے کر کھاتے تک۔">from the till to the ledger.</span>
                    </h1>

                    <p class="mx-auto mt-5 max-w-2xl text-lg text-[var(--text-secondary)]" data-en="Point of sale, batch &amp; expiry tracking, vendor and customer ledgers, purchases, and reports — all in one place, in English or Urdu. And the till keeps selling even when the internet doesn’t." data-ur="پوائنٹ آف سیل، بیچ اور معیاد ختم ہونے کی نگرانی، وینڈر اور کسٹمر کھاتے، خریداری، اور رپورٹس — سب کچھ ایک ہی جگہ، انگریزی یا اردو میں۔ اور انٹرنیٹ بند ہونے پر بھی کاؤنٹر چلتا رہتا ہے۔">
                        Point of sale, batch &amp; expiry tracking, vendor and customer ledgers, purchases, and reports — all in one place, in English or Urdu. And the till keeps selling even when the internet doesn’t.
                    </p>

                    <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <a href="{{ route('demo.login') }}" class="w-full rounded-xl bg-[var(--sidebar-primary-color)] px-7 py-3.5 text-base font-bold text-[var(--text-on-dark)] shadow-lg shadow-[var(--sidebar-primary-color)]/20 transition hover:opacity-90 sm:w-auto" data-en="See Demo — Instant Access" data-ur="ڈیمو دیکھیں — فوری رسائی">
                            See Demo — Instant Access
                        </a>
                        <a href="#features" class="w-full rounded-xl px-7 py-3.5 text-base font-bold text-[var(--text-primary)] transition hover:bg-black/5 sm:w-auto" data-en="Explore Features ↓" data-ur="خصوصیات دیکھیں ↓">
                            Explore Features ↓
                        </a>
                    </div>
                    <p class="mt-3 text-sm text-[var(--text-secondary)]" data-en="No signup. No credit card. Explore the full app as an admin." data-ur="کوئی سائن اپ نہیں۔ کوئی کریڈٹ کارڈ نہیں۔ ایڈمن کے طور پر مکمل ایپ دیکھیں۔">No signup. No credit card. Explore the full app as an admin.</p>
                </section>

                {{-- Features --}}
                <section id="features" class="mt-24 scroll-mt-8">
                    <h2 class="text-center text-2xl font-bold text-[var(--text-primary)] sm:text-3xl" data-en="Everything your shop needs, built in" data-ur="آپ کی دکان کی ہر ضرورت، ایک ہی جگہ">Everything your shop needs, built in</h2>
                    <p class="mx-auto mt-2 max-w-xl text-center text-[var(--text-secondary)]" data-en="One system for the counter, the warehouse, and the books." data-ur="کاؤنٹر، گودام اور حساب کتاب کے لیے ایک ہی نظام۔">One system for the counter, the warehouse, and the books.</p>

                    <div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        {{-- Offline POS gets the full row rather than a seventh
                             card: it's the differentiator for shops on patchy
                             rural connections, and a 7th card would strand one
                             tile alone on the last row of a 3-up grid. --}}
                        <div class="glass-panel-strong p-6 text-start ring-1 ring-[var(--sidebar-primary-color)]/25 sm:col-span-2 sm:p-8 lg:col-span-3">
                            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-10">
                                <div class="lg:max-w-md">
                                    <span class="inline-flex items-center rounded-full bg-[var(--sidebar-primary-color)]/10 px-3 py-1 text-xs font-bold uppercase tracking-wide text-[var(--sidebar-primary-color)]" data-en="Works without internet" data-ur="انٹرنیٹ کے بغیر کام کرتا ہے">
                                        Works without internet
                                    </span>

                                    <div class="mt-4 flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--sidebar-primary-color)]/10 text-[var(--sidebar-primary-color)]">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25a15 15 0 0 1 4.2-2.73M21 8.25a15 15 0 0 0-6.15-3.15M6.35 11.66A10.5 10.5 0 0 1 9 10.1m6.35.28a10.5 10.5 0 0 1 2.3 1.28M9.67 15.07a5.25 5.25 0 0 1 4.66 0M12 18.75h.008v.008H12v-.008ZM3.5 3.5l17 17"/></svg>
                                    </div>

                                    <h3 class="mt-4 text-xl font-bold text-[var(--text-primary)]" data-en="Offline Point of Sale" data-ur="آف لائن پوائنٹ آف سیل">Offline Point of Sale</h3>
                                    <p class="mt-2 text-sm leading-relaxed text-[var(--text-secondary)]" data-en="One click loads your stock and customers onto the till. When the line goes down — or the power comes back after a cut — keep ringing up sales, printing receipts and taking payments exactly as normal." data-ur="ایک کلک میں آپ کا اسٹاک اور کسٹمرز کاؤنٹر پر لوڈ ہو جاتے ہیں۔ انٹرنیٹ بند ہو جائے — یا بجلی جانے کے بعد واپس آئے — فروخت، رسیدیں اور ادائیگیاں معمول کے مطابق جاری رکھیں۔">
                                        One click loads your stock and customers onto the till. When the line goes down — or the power comes back after a cut — keep ringing up sales, printing receipts and taking payments exactly as normal.
                                    </p>
                                </div>

                                @php
                                    $offlinePoints = [
                                        ['en' => 'Sell, print receipts and take cash, bank or on-account payments with no connection at all.', 'ur' => 'بغیر کسی کنکشن کے فروخت کریں، رسیدیں پرنٹ کریں اور نقد، بینک یا ادھار ادائیگی لیں۔'],
                                        ['en' => 'Hold a customer’s order, serve the next person, and pick it back up in seconds.', 'ur' => 'کسی کسٹمر کا آرڈر روکیں، اگلے گاہک کو نمٹائیں، اور سیکنڈوں میں واپس شروع کریں۔'],
                                        ['en' => 'Every sale queues safely on the till and posts itself when you reconnect — the sync button shows red offline, green online, with the pending count.', 'ur' => 'ہر سیل کاؤنٹر پر محفوظ رہتی ہے اور دوبارہ جڑتے ہی خود سرور پر چلی جاتی ہے — سِنک بٹن آف لائن پر سرخ، آن لائن پر سبز، زیر التوا تعداد کے ساتھ۔'],
                                    ];
                                @endphp

                                <ul class="flex-1 space-y-3">
                                    @foreach ($offlinePoints as $point)
                                        <li class="flex items-start gap-3">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mt-0.5 h-5 w-5 shrink-0 text-[var(--sidebar-primary-color)]" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                            <span class="text-sm leading-relaxed text-[var(--text-secondary)]" data-en="{{ $point['en'] }}" data-ur="{{ $point['ur'] }}">{{ $point['en'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        @php
                            $features = [
                                ['icon' => 'cart', 'title' => 'Point of Sale', 'title_ur' => 'پوائنٹ آف سیل', 'body' => 'Fast, barcode-ready checkout with instant thermal receipts and downloadable PDF invoices.', 'body_ur' => 'بارکوڈ سے تیز چیک آؤٹ، فوری تھرمل رسیدیں اور ڈاؤن لوڈ ایبل پی ڈی ایف انوائسز۔'],
                                ['icon' => 'boxes', 'title' => 'Inventory & Batches', 'title_ur' => 'انوینٹری اور بیچز', 'body' => 'Track stock down to the batch, with automatic alerts before anything expires.', 'body_ur' => 'ہر بیچ تک اسٹاک کی نگرانی کریں، معیاد ختم ہونے سے پہلے خودکار الرٹس کے ساتھ۔'],
                                ['icon' => 'book', 'title' => 'Vendor & Customer Ledgers', 'title_ur' => 'وینڈر اور کسٹمر کھاتے', 'body' => 'Running balances, on-account sales, and full statement history — always up to date.', 'body_ur' => 'چلتا بیلنس، ادھار فروخت، اور مکمل اسٹیٹمنٹ تاریخ — ہمیشہ اپ ڈیٹ۔'],
                                ['icon' => 'truck', 'title' => 'Purchases & Payments', 'title_ur' => 'خریداری اور ادائیگیاں', 'body' => 'Record purchases with split cash/bank/on-account payments in one balanced entry.', 'body_ur' => 'نقد/بینک/ادھار ادائیگیوں کی تقسیم کے ساتھ خریداری ایک ہی متوازن اندراج میں ریکارڈ کریں۔'],
                                ['icon' => 'chart', 'title' => 'Reports & Analytics', 'title_ur' => 'رپورٹس اور تجزیات', 'body' => 'Profit margins, sales trends, and cash-vs-bank breakdowns on a live dashboard.', 'body_ur' => 'منافع کا مارجن، فروخت کے رجحانات، اور نقد بمقابلہ بینک کی تفصیل ایک لائیو ڈیش بورڈ پر۔'],
                                ['icon' => 'store', 'title' => 'Multi-Shop Ready', 'title_ur' => 'ملٹی شاپ کے لیے تیار', 'body' => 'Every shop gets its own secure, branded workspace and its own web address.', 'body_ur' => 'ہر دکان کو اپنا محفوظ، برانڈڈ ورک اسپیس اور اپنا ویب ایڈریس ملتا ہے۔'],
                            ];
                        @endphp

                        @foreach ($features as $feature)
                            <div class="glass-panel p-6 text-start transition hover:-translate-y-0.5">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--sidebar-primary-color)]/10 text-[var(--sidebar-primary-color)]">
                                    @switch($feature['icon'])
                                        @case('cart')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.836l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 1.907-4.723 2.325-7.227a1.125 1.125 0 0 0-1.11-1.313H5.106M7.5 14.25 5.106 5.272M6 18.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/></svg>
                                        @break
                                        @case('boxes')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5 12 3 3 7.5m18 0-9 4.5m9-4.5v9L12 21m0-9L3 7.5m9 4.5v9m-9-9v9l9 4.5"/></svg>
                                        @break
                                        @case('book')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                                        @break
                                        @case('truck')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25h5.056a2.25 2.25 0 0 1 1.847.977l1.294 1.883a1.125 1.125 0 0 1-.928 1.765H14.25M2.25 14.25h9.75V6.108a2.25 2.25 0 0 0-1.784-2.201l-5.25-1.125a2.25 2.25 0 0 0-2.716 2.201v9.267"/></svg>
                                        @break
                                        @case('chart')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5 9 7.5l4 4 8-8M3 21h18M3 21V17m4.5 4v-6m4-2v8m4-11v11m4-6v6"/></svg>
                                        @break
                                        @case('store')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" class="h-6 w-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75 4.5 3h15L21 9.75M3 9.75v9.75A1.5 1.5 0 0 0 4.5 21h15a1.5 1.5 0 0 0 1.5-1.5V9.75M3 9.75h18M9 21v-5.25a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5V21"/></svg>
                                        @break
                                    @endswitch
                                </div>
                                <h3 class="mt-4 text-base font-bold text-[var(--text-primary)]" data-en="{{ $feature['title'] }}" data-ur="{{ $feature['title_ur'] }}">{{ $feature['title'] }}</h3>
                                <p class="mt-1.5 text-sm leading-relaxed text-[var(--text-secondary)]" data-en="{{ $feature['body'] }}" data-ur="{{ $feature['body_ur'] }}">{{ $feature['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- Demo CTA band --}}
                <section class="glass-panel-strong mt-24 flex flex-col items-center gap-5 px-8 py-12 text-center sm:flex-row sm:justify-between sm:text-start">
                    <div>
                        <h2 class="text-xl font-bold text-[var(--text-primary)] sm:text-2xl" data-en="See it in action, right now" data-ur="ابھی اسے عملی طور پر دیکھیں">See it in action, right now</h2>
                        <p class="mt-1.5 text-[var(--text-secondary)]" data-en="One click into a fully working shop, logged in as an admin. No forms to fill out." data-ur="ایک کلک میں مکمل فعال دکان میں داخل ہوں، ایڈمن کے طور پر لاگ ان۔ کوئی فارم بھرنے کی ضرورت نہیں۔">One click into a fully working shop, logged in as an admin. No forms to fill out.</p>
                    </div>
                    <a href="{{ route('demo.login') }}" class="shrink-0 rounded-xl bg-[var(--sidebar-primary-color)] px-7 py-3.5 text-base font-bold text-[var(--text-on-dark)] shadow-lg shadow-[var(--sidebar-primary-color)]/20 transition hover:opacity-90" data-en="See Demo" data-ur="ڈیمو دیکھیں">
                        See Demo
                    </a>
                </section>

                {{-- Existing customer sign-in --}}
                <p class="mt-10 text-center text-sm text-[var(--text-secondary)]">
                    <span data-en="Already have a shop on this platform? Sign in at your shop's own link, e.g." data-ur="کیا اس پلیٹ فارم پر آپ کی پہلے سے دکان ہے؟ اپنی دکان کے اپنے لنک سے سائن اِن کریں، مثال کے طور پر">Already have a shop on this platform? Sign in at your shop's own link, e.g.</span>
                    <code dir="ltr" class="rounded bg-black/5 px-1.5 py-0.5">/your-shop-name</code>.
                </p>
            </main>

            <footer class="border-t border-black/5 py-8 text-center text-sm text-[var(--text-secondary)]">
                &copy; {{ date('Y') }} <span data-en="Pesticides Management System" data-ur="پیسٹیسائیڈز مینجمنٹ سسٹم">Pesticides Management System</span>
            </footer>
        </div>

        {{-- WhatsApp contact widget --}}
        @php
            $whatsappNumber = '923120883979';
            $whatsappMessage = "Hi! I'm interested in the Pesticides Management System. Can you tell me more?";
            $whatsappUrl = 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode($whatsappMessage);
        @endphp
        <div class="fixed bottom-5 end-5 z-50 flex flex-col items-end gap-3">
            <div id="whatsapp-bubble" class="relative hidden max-w-[230px] rounded-2xl glass-panel-strong px-4 py-3 text-start shadow-lg">
                <button
                    type="button"
                    onclick="dismissWhatsappBubble()"
                    aria-label="Dismiss"
                    class="absolute -top-2 -end-2 flex h-6 w-6 items-center justify-center rounded-full bg-white text-sm font-bold text-[var(--text-secondary)] shadow-sm hover:text-[var(--text-primary)]"
                >
                    &times;
                </button>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="block">
                    <p class="text-sm font-bold text-[var(--text-primary)]" data-en="Need help?" data-ur="مدد چاہیے؟">Need help?</p>
                    <p class="mt-0.5 text-sm font-bold text-[#1ba653] underline" data-en="Contact us" data-ur="ہم سے رابطہ کریں">Contact us</p>
                </a>
            </div>

            <a
                href="{{ $whatsappUrl }}"
                target="_blank"
                rel="noopener"
                aria-label="Contact us on WhatsApp"
                class="relative flex h-16 w-16 items-center justify-center rounded-full bg-[#25D366] shadow-lg transition hover:scale-105"
            >
                <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-75 animate-ping"></span>
                <svg viewBox="0 0 448 512" fill="currentColor" class="relative h-8 w-8 text-white">
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                </svg>
            </a>
        </div>

        <script>
            function setLandingLang(lang) {
                document.querySelectorAll('[data-en]').forEach(function (el) {
                    el.textContent = lang === 'ur' ? el.dataset.ur : el.dataset.en;
                });

                document.documentElement.lang = lang === 'ur' ? 'ur' : 'en';
                document.documentElement.dir = lang === 'ur' ? 'rtl' : 'ltr';
                document.body.classList.toggle('font-urdu', lang === 'ur');

                document.getElementById('lang-btn-en').className = 'lang-btn min-h-[36px] rounded-full px-3 py-1.5 transition ' +
                    (lang === 'en' ? 'bg-[var(--sidebar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-white/60');
                document.getElementById('lang-btn-ur').className = 'lang-btn min-h-[36px] rounded-full px-3 py-1.5 transition ' +
                    (lang === 'ur' ? 'bg-[var(--sidebar-primary-color)] text-white' : 'text-[var(--text-primary)] hover:bg-white/60');

                localStorage.setItem('landing-lang', lang);
            }

            function dismissWhatsappBubble() {
                document.getElementById('whatsapp-bubble').classList.add('hidden');
                sessionStorage.setItem('whatsapp-bubble-dismissed', '1');
            }

            document.addEventListener('DOMContentLoaded', function () {
                setLandingLang(localStorage.getItem('landing-lang') === 'ur' ? 'ur' : 'en');

                if (! sessionStorage.getItem('whatsapp-bubble-dismissed')) {
                    setTimeout(function () {
                        document.getElementById('whatsapp-bubble').classList.remove('hidden');
                    }, 3000);
                }
            });
        </script>
    </body>
</html>
