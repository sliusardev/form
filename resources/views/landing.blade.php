<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">
<head>
    <!-- =======================
         META / SEO
    ======================== -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>FormPost — Simple Form Submissions (No Subscriptions)</title>
    <meta name="description" content="Collect form submissions without a backend. Buy submissions and forms as needed. No subscriptions, no frameworks — just simple integration.">
    <meta property="og:title" content="FormPost — Simple Form Submissions" />
    <meta property="og:description" content="Buy submissions and forms as needed. No subscriptions. Easy integration." />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="/og-image.png" />

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Font to match your dashboard style -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind v4 (CDN for dev; compile a static CSS for prod) -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @layer base {
            html { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        }
    </style>

    <!-- Swiper v11 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body class="bg-white text-gray-800 leading-relaxed antialiased">

<!-- =======================
     HEADER / NAV
======================== -->
<header class="w-full border-b border-gray-200 bg-white sticky top-0 z-50">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <!-- Brand -->
        <a href="{{route('home')}}" class="text-2xl font-semibold text-gray-800">FormPost</a>

        <!-- Desktop nav -->
        <nav id="navMenu" class="hidden md:flex items-center gap-8 text-sm">
            <a href="#features" class="hover:text-gray-900">Features</a>
            <a href="#pricing" class="hover:text-gray-900">Pricing</a>
            <a href="#integration" class="hover:text-gray-900">How It Works</a>
            <a href="#screens" class="hover:text-gray-900">Screenshots</a>
            <a href="#" class="hover:text-gray-900">Docs</a>
            <a href="#" class="hover:text-gray-900">Contact</a>
        </nav>

        <!-- Right-side actions -->
        @if (Route::has('login'))
            @auth
                <a href="{{route('register')}}" type="button" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-4 rounded-lg shadow transition cursor-pointer p-2">
                    {{__('dashboard.dashboard')}}
                </a>
            @else
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{route('login')}}" type="button" class="text-sm hover:text-gray-900 cursor-pointer p-2">
                        {{__('dashboard.login')}}
                    </a>
                    <a href="{{route('register')}}" type="button" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-4 rounded-lg shadow transition cursor-pointer p-2">
                        {{__('dashboard.get_started')}}
                    </a>
                </div>
            @endauth
        @endif

        <!-- Mobile hamburger -->
        <button id="menuBtn" class="md:hidden p-2 rounded-lg border border-gray-200" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mobilePanel">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile panel -->
    <div id="mobilePanel" class="md:hidden hidden border-t border-gray-200 bg-white" role="dialog" aria-label="Mobile navigation">
        <div class="container mx-auto px-4 py-3 text-sm space-y-2">
            <a href="#features" class="block hover:text-gray-900">Features</a>
            <a href="#pricing" class="block hover:text-gray-900">Pricing</a>
            <a href="#integration" class="block hover:text-gray-900">How It Works</a>
            <a href="#screens" class="block hover:text-gray-900">Screenshots</a>
            <a href="#" class="block hover:text-gray-900">Docs</a>
            <a href="#" class="block hover:text-gray-900">Contact</a>
{{--            <div class="pt-2 flex items-center gap-3">--}}
{{--                <a href="#" class="text-sm hover:text-gray-900">Login</a>--}}
{{--                <a href="#pricing" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-4 rounded-lg shadow">--}}
{{--                    Get Started--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>
</header>

<!-- =======================
     HERO
======================== -->
<section id="hero" class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
        Get Started with Simple Form Submissions
    </h1>
    <p class="text-lg text-gray-600 mb-3 w-full mx-auto">
        Collect form submissions without writing a backend. Point your HTML form to our endpoint and start collecting submissions in minutes.
    </p>

    <p class="text-lg text-gray-600 mb-8 w-full mx-auto">
        Pay only for what you need – no subscriptions, no hassle. Buy submissions and forms only when you need them.
    </p>

    <div class="flex items-center justify-center gap-3">
        <a href="#pricing" class="bg-gray-800 hover:bg-gray-900 text-white font-medium py-3 px-6 rounded-lg shadow transition">
            Start Now
        </a>
        <a href="#integration" class="border border-gray-300 hover:border-gray-400 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
            See Integration
        </a>
    </div>
</section>

<!-- =======================
     LOGOS / TRUST (optional simple row)
======================== -->
<section class="container mx-auto px-4 pb-6">
    <div class="text-center text-xs uppercase tracking-wide text-gray-500">
        Trusted by developers who prefer building features, not backends
    </div>
</section>

<!-- =======================
     FEATURES
======================== -->
<section id="features" class="container mx-auto px-4 py-12">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">Why FormPost?</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <!-- Feature -->
        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="text-3xl mb-3">🚫</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Subscriptions</h3>
            <p class="text-gray-600">No monthly fees or contracts. Buy capacity only when you need it.</p>
        </div>
        <!-- Feature -->
        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="text-3xl mb-3">💳</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Pay‑as‑You‑Go</h3>
            <p class="text-gray-600">Transparent pricing — $10 per 1,000 submissions, $10 per 10 forms. $15 minimum.</p>
        </div>
        <!-- Feature -->
        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="text-3xl mb-3">⚡</div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Fast Integration</h3>
            <p class="text-gray-600">Change your form’s <code class="px-1 rounded bg-gray-100 border border-gray-200">action</code> and you’re done. No backend to maintain.</p>
        </div>
    </div>
</section>

<!-- =======================
     PRICING
======================== -->
<section id="pricing" class="bg-gray-50">
    <div class="container mx-auto px-4 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-6">Simple, Usage‑Based Pricing</h2>
        <p class="text-center text-gray-700 mb-8">No hidden fees. No subscriptions. Just buy capacity.</p>

        <div class="max-w-2xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Rates Card -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Rates</h3>
                <ul class="space-y-2 text-gray-800">
                    <li>• <strong>$10</strong> per <strong>1,000</strong> submissions</li>
                    <li>• <strong>$10</strong> per <strong>10</strong> forms</li>
                    <li>• <strong>$15</strong> minimum purchase</li>
                </ul>
                <div class="mt-6">
                    <a href="{{route('register')}}" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-medium py-2.5 px-5 rounded-lg shadow">
                        Buy Capacity
                    </a>
                </div>
            </div>

            <!-- Calculator -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Estimate your cost</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="subInput" class="text-sm text-gray-700">Submissions</label>
                        <input id="subInput" type="number" min="0" step="1000" value="1000"
                               class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800" />
                        <p class="text-xs text-gray-500 mt-1">Billed in blocks of 1,000</p>
                    </div>
                    <div>
                        <label for="formInput" class="text-sm text-gray-700">Forms</label>
                        <input id="formInput" type="number" min="0" step="10" value="10"
                               class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800" />
                        <p class="text-xs text-gray-500 mt-1">Billed in blocks of 10</p>
                    </div>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <div class="text-sm text-gray-600">Total</div>
                        <div class="text-2xl font-semibold text-gray-900" id="totalCost">$20.00</div>
                        <div class="text-xs text-gray-500">(Minimum $15)</div>
                    </div>
                    <a href="{{route('register')}}" class="bg-gray-800 hover:bg-gray-900 text-white font-medium py-2.5 px-5 rounded-lg shadow">
                        Continue
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =======================
     HOW IT WORKS / INTEGRATION
======================== -->
<section id="integration" class="container mx-auto px-4 py-12">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">How It Works</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <ol class="list-decimal list-inside space-y-3 text-gray-800">
                <li><strong>Get your endpoint.</strong> We generate a unique URL for each of your forms.</li>
                <li><strong>Point your form to us.</strong> Update the form <code class="px-1 rounded bg-gray-100 border border-gray-200">action</code>.</li>
                <li><strong>Receive submissions.</strong> View them in your dashboard or via email/webhooks.</li>
            </ol>
            <p class="text-gray-600 mt-4">Works with any static site, landing builder, or CMS.</p>
        </div>

        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="text-sm text-gray-700 mb-2 font-medium">HTML example</div>
            <pre class="text-sm bg-gray-50 border border-gray-200 rounded-lg p-3 overflow-x-auto"><code>&lt;form action="https://formpost.org/your-endpoint" method="POST"&gt;
  &lt;label&gt;Your Email&lt;/label&gt;
  &lt;input type="email" name="email" required /&gt;

  &lt;label&gt;Message&lt;/label&gt;
  &lt;textarea name="message" required&gt;&lt;/textarea&gt;

  &lt;button type="submit"&gt;Send&lt;/button&gt;
&lt;/form&gt;</code></pre>
            <p class="text-xs text-gray-500 mt-2">That’s it — no server or backend code required.</p>
        </div>
    </div>
</section>

<!-- =======================
     SCREENSHOTS (Swiper)
======================== -->
<section id="screens" class="max-w-[1200px] mx-auto px-4 py-12">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-6">Dashboard Screenshots</h2>

    <div class="swiper bg-white rounded-xl border border-gray-200 shadow-sm flex items-center justify-center" id="screensSwiper" aria-label="Product screenshots">
        <div class="swiper-wrapper">
            <div class="swiper-slide flex justify-center">
                <img src="{{asset('img/screens/1.png')}}" data-src="{{asset('img/screens/1.png')}}" alt="Dashboard overview"
                     class="swiper-lazy w-full h-auto object-contain rounded-xl"
                />
            </div>
            <div class="swiper-slide flex justify-center">
                <img src="{{asset('img/screens/2.png')}}" data-src="{{asset('img/screens/2.png')}}" alt="Dashboard overview"
                     class="swiper-lazy w-full h-auto object-contain rounded-xl"
                />
            </div>
            <div class="swiper-slide flex justify-center">
                <img src="{{asset('img/screens/3.png')}}" data-src="{{asset('img/screens/3.png')}}" alt="Dashboard overview"
                     class="swiper-lazy w-full h-auto object-contain rounded-xl"
                />
            </div>
            <div class="swiper-slide flex justify-center">
                <img src="{{asset('img/screens/4.png')}}" data-src="{{asset('img/screens/4.png')}}" alt="Dashboard overview"
                     class="swiper-lazy w-full h-auto object-contain rounded-xl"
                />
            </div>
            <div class="swiper-slide flex justify-center">
                <img src="{{asset('img/screens/5.png')}}" data-src="{{asset('img/screens/5.png')}}" alt="Dashboard overview"
                     class="swiper-lazy w-full h-auto object-contain rounded-xl"
                />
            </div>
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination"></div>
{{--        <div class="swiper-button-prev text-gray-500 rounded-full p-2"></div>--}}
{{--        <div class="swiper-button-next text-gray-500 rounded-full p-2"></div>--}}
    </div>

    <!-- No-JS fallback -->
    <noscript>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <img src="{{asset('img/screens/1.png')}}" class="w-full rounded-lg border" alt="">
            <img src="{{asset('img/screens/2.png')}}" class="w-full rounded-lg border" alt="">
            <img src="{{asset('img/screens/3.png')}}" class="w-full rounded-lg border" alt="">
            <img src="{{asset('img/screens/4.png')}}" class="w-full rounded-lg border" alt="">
            <img src="{{asset('img/screens/5.png')}}" class="w-full rounded-lg border" alt="">
        </div>
    </noscript>
</section>

<!-- =======================
     TESTIMONIALS (optional)
======================== -->
<section class="container mx-auto px-4 py-12">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">What Developers Say</h2>
    <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
        <figure class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <blockquote class="italic text-gray-800">“We had forms live in minutes. No backend, no server. Exactly what we needed.”</blockquote>
            <figcaption class="text-sm text-gray-600 mt-3">— Jane D., Frontend Engineer</figcaption>
        </figure>
        <figure class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <blockquote class="italic text-gray-800">“Pay‑as‑you‑go pricing keeps our costs sane. No monthly bloat.”</blockquote>
            <figcaption class="text-sm text-gray-600 mt-3">— Mark L., Agency Owner</figcaption>
        </figure>
    </div>
</section>

<!-- =======================
     FAQ (compact)
======================== -->
<section class="container mx-auto px-4 py-12">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">FAQ</h2>
    <div class="max-w-3xl mx-auto divide-y divide-gray-200 border border-gray-200 rounded-xl">
        <details class="p-5 group">
            <summary class="cursor-pointer font-medium text-gray-900 flex items-center justify-between">
                Do I need a backend?
                <span class="ml-3 text-gray-500 group-open:rotate-180 transition">&#9660;</span>
            </summary>
            <p class="mt-3 text-gray-700">No. Point your form’s <code class="px-1 rounded bg-gray-100 border border-gray-200">action</code> to our endpoint and submit.</p>
        </details>
        <details class="p-5 group">
            <summary class="cursor-pointer font-medium text-gray-900 flex items-center justify-between">
                How is pricing calculated?
                <span class="ml-3 text-gray-500 group-open:rotate-180 transition">&#9660;</span>
            </summary>
            <p class="mt-3 text-gray-700">Submissions are billed per 1,000, forms per 10. We apply a $15 minimum to each purchase.</p>
        </details>
        <details class="p-5 group">
            <summary class="cursor-pointer font-medium text-gray-900 flex items-center justify-between">
                Can I switch plans later?
                <span class="ml-3 text-gray-500 group-open:rotate-180 transition">&#9660;</span>
            </summary>
            <p class="mt-3 text-gray-700">There are no plans. Just buy more capacity when you need it.</p>
        </details>
    </div>
</section>

<!-- =======================
     CTA BAND
======================== -->
<section class="container mx-auto px-4 py-12 text-center bg-gray-800 text-white rounded-xl shadow-sm">
    <h2 class="text-2xl sm:text-3xl font-bold mb-3">Ready to ship your forms?</h2>
    <p class="text-lg mb-6 opacity-90">Create your endpoint and start collecting submissions today.</p>
    <a href="{{route('register')}}" class="bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow hover:bg-gray-100">
        Get Started Free
    </a>
</section>

<!-- =======================
     FOOTER
======================== -->
<footer class="container mx-auto px-4 py-8 text-sm text-gray-600">
    <div class="border-t border-gray-200 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
        <div>&copy; 2024 - {{now()->year}} FormPost. All rights reserved.</div>
        <div class="flex items-center gap-4">
            <a href="#pricing" class="hover:underline">Pricing</a>
            <a href="#docs" class="hover:underline">Docs</a>
            <a href="/terms.html" class="hover:underline">Terms</a>
            <a href="/privacy.html" class="hover:underline">Privacy</a>
        </div>
    </div>
</footer>

<!-- =======================
     SCRIPTS
======================== -->
<script>
    // Mobile nav toggle
    const menuBtn = document.getElementById('menuBtn');
    const mobilePanel = document.getElementById('mobilePanel');
    menuBtn.addEventListener('click', () => {
        const isHidden = mobilePanel.classList.toggle('hidden');
        menuBtn.setAttribute('aria-expanded', String(!isHidden));
    });

    const submissionCost = {{ $submissionCost }};
    const formCost = {{ $formCost }};
    const minPayment = {{ $minPayment }};

    // Pricing calculator
    const subInput = document.getElementById('subInput');
    const formInput = document.getElementById('formInput');
    const totalCostSpan = document.getElementById('totalCost');
    function updateCost() {
        const subs = Math.max(0, Number(subInput.value) || 0);
        const forms = Math.max(0, Number(formInput.value) || 0);
        const costSubs  = Math.ceil(subs / 1000) * 10; // $10 per 1000
        const costForms = Math.ceil(forms / 10) * 10;  // $10 per 10
        let total = costSubs + costForms;
        // if (total < 15) total = 15;                    // $15 minimum
        totalCostSpan.textContent = '$' + total.toFixed(2);
    }
    subInput.addEventListener('input', updateCost);
    formInput.addEventListener('input', updateCost);
    updateCost();

    // Swiper init for screenshots
    document.addEventListener('DOMContentLoaded', () => {
        const screensSwiper = new Swiper('#screensSwiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 16,
            speed: 800, // плавний перехід (800 мс)
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            lazy: { loadPrevNext: true, loadPrevNextAmount: 2 },
            keyboard: { enabled: true },
            a11y: {
                enabled: true,
                prevSlideMessage: 'Previous slide',
                nextSlideMessage: 'Next slide',
                paginationBulletMessage: 'Go to slide @{{index}}',
            },
        });
    });
</script>
</body>
</html>
