@extends('layouts.site')

@section('content')
    <!-- =======================
     HERO
======================== -->
    <section id="hero" class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">{{ __('main.hero_title') }}</h1>
        <p class="text-lg text-gray-600 mb-3 w-full mx-auto">{{ __('main.hero_description_1') }}</p>
        <p class="text-lg text-gray-600 mb-8 w-full mx-auto">{{ __('main.hero_description_2') }}</p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{route('register')}}" class="bg-gray-800 hover:bg-gray-900 text-white font-medium py-3 px-6 rounded-lg shadow transition">
                {{ __('main.hero_start_now') }}
            </a>
            <a href="#integration" class="border border-gray-300 hover:border-gray-400 text-gray-800 font-medium py-3 px-6 rounded-lg transition">
                {{ __('main.hero_see_integration') }}
            </a>
        </div>
    </section>

    <!-- =======================
         LOGOS / TRUST (optional simple row)
    ======================== -->
    <section class="container mx-auto px-4 pb-6">
        <div class="text-center text-xs uppercase tracking-wide text-gray-500">
            {{ __('main.logos_trust') }}
        </div>
    </section>

    <!-- =======================
         FEATURES
    ======================== -->
    <section id="features" class="container mx-auto px-4 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">{{ __('main.features_title') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Feature -->
            <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <div class="text-3xl">🚫</div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('main.feature_no_subscriptions') }}</h3>
                </div>
                <p class="text-gray-600">{{ __('main.feature_no_subscriptions_description') }}</p>
            </div>
            <!-- Feature -->
            <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <div class="text-3xl mb-3">💳</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('main.feature_pay_as_you_go') }}</h3>
                </div>
                <p class="text-gray-600">{{ __('main.feature_pay_as_you_go_description') }}</p>
            </div>
            <!-- Feature -->
            <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-2">
                    <div class="text-3xl mb-3">⚡</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('main.feature_fast_integration') }}</h3>
                </div>
                <p class="text-gray-600">{{ __('main.feature_fast_integration_description') }}</p>
            </div>
        </div>
    </section>

    <!-- =======================
         PRICING
    ======================== -->
    <section id="pricing" class="bg-gray-50">
        <div class="container mx-auto px-4 py-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-6">{{ __('main.pricing_title') }}</h2>
            <p class="text-center text-gray-700 mb-8">{{ __('main.pricing_description') }}</p>

            <div class="max-w-2xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Rates Card -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('main.rates_title') }}</h3>
                    <ul class="space-y-2 text-gray-800">
                        <li>• <strong>{{$submissionCost * 1000}} {{$currency}}</strong> {{ __('main.rates_submissions') }}</li>
                        <li>• <strong>{{$formCost * 10}} {{$currency}}</strong> {{ __('main.rates_forms') }}</li>
                        <li>• <strong>{{$minPayment}} {{$currency}}</strong> {{ __('main.rates_minimum') }}</li>
                    </ul>
                    <div class="mt-6">
                        <a href="{{route('register')}}" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-medium py-2.5 px-5 rounded-lg shadow">
                            {{ __('main.calculator_continue') }}
                        </a>
                    </div>
                </div>

                <!-- Calculator -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('main.calculator_title') }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="subInput" class="text-sm text-gray-700">{{ __('main.calculator_submissions') }}</label>
                            <input id="subInput" type="number" min="0" step="100" value="1000" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800" />
                            <p class="text-xs text-gray-500 mt-1">{{ __('main.rates_submissions') }}</p>
                        </div>
                        <div>
                            <label for="formInput" class="text-sm text-gray-700">{{ __('main.calculator_forms') }}</label>
                            <input id="formInput" type="number" min="0" step="1" value="10" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800" />
                            <p class="text-xs text-gray-500 mt-1">{{ __('main.rates_forms') }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            <div class="text-sm text-gray-600">{{ __('main.calculator_total') }}</div>
                            <div class="text-2xl font-semibold text-gray-900">
                                {{$currency}} <span id="totalCost">0.00</span>
                            </div>
                        </div>
                        <a href="{{route('register')}}" class="bg-gray-800 hover:bg-gray-900 text-white font-medium py-2.5 px-5 rounded-lg shadow">
                            {{ __('main.calculator_continue') }}
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
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">{{ __('main.integration_title') }}</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <ol class="list-decimal list-inside space-y-3 text-gray-800">
                    <li><strong>{{ __('main.integration_step_1') }}</strong></li>
                    <li><strong>{{ __('main.integration_step_2') }}</strong></li>
                    <li><strong>{{ __('main.integration_step_3') }}</strong></li>
                </ol>
                <p class="text-gray-600 mt-4">{{ __('main.integration_description') }}</p>
            </div>

            <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="text-sm text-gray-700 mb-2 font-medium">{{ __('main.html_example_title') }}</div>
                <pre class="text-sm bg-gray-50 border border-gray-200 rounded-lg p-3 overflow-x-auto"><code>&lt;form action="https://formpost.org/your-endpoint" method="POST"&gt;
  &lt;label&gt;Your Email&lt;/label&gt;
  &lt;input type="email" name="email" required /&gt;

  &lt;label&gt;Message&lt;/label&gt;
  &lt;textarea name="message" required&gt;&lt;/textarea&gt;

  &lt;button type="submit"&gt;Send&lt;/button&gt;
&lt;/form&gt;</code></pre>
                <p class="text-xs text-gray-500 mt-2">{{ __('main.html_example_description') }}</p>
            </div>
        </div>
    </section>

    <!-- =======================
         SCREENSHOTS (Swiper)
    ======================== -->
    <section id="screens" class="max-w-[1200px] mx-auto px-4 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-6">{{ __('main.screenshots_title') }}</h2>

        <div class="swiper bg-white rounded-xl border border-gray-200 shadow-sm flex items-center justify-center" id="screensSwiper" aria-label="Product screenshots">
            <div class="swiper-wrapper">
                <div class="swiper-slide flex justify-center">
                    <img src="{{asset('img/screens/1.png')}}" data-src="{{asset('img/screens/1.png')}}" alt="Dashboard overview" class="swiper-lazy w-full h-auto object-contain rounded-xl" />
                </div>
                <div class="swiper-slide flex justify-center">
                    <img src="{{asset('img/screens/2.png')}}" data-src="{{asset('img/screens/2.png')}}" alt="Dashboard overview" class="swiper-lazy w-full h-auto object-contain rounded-xl" />
                </div>
                <div class="swiper-slide flex justify-center">
                    <img src="{{asset('img/screens/3.png')}}" data-src="{{asset('img/screens/3.png')}}" alt="Dashboard overview" class="swiper-lazy w-full h-auto object-contain rounded-xl" />
                </div>
                <div class="swiper-slide flex justify-center">
                    <img src="{{asset('img/screens/4.png')}}" data-src="{{asset('img/screens/4.png')}}" alt="Dashboard overview" class="swiper-lazy w-full h-auto object-contain rounded-xl" />
                </div>
                <div class="swiper-slide flex justify-center">
                    <img src="{{asset('img/screens/5.png')}}" data-src="{{asset('img/screens/5.png')}}" alt="Dashboard overview" class="swiper-lazy w-full h-auto object-contain rounded-xl" />
                </div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- =======================
         TESTIMONIALS (optional)
    ======================== -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">{{ __('main.testimonials_title') }}</h2>
        <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            <figure class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <blockquote class="italic text-gray-800">{{ __('main.testimonial_1') }}</blockquote>
                <figcaption class="text-sm text-gray-600 mt-3">{{ __('main.testimonial_author_1') }}</figcaption>
            </figure>
            <figure class="rounded-xl border border-gray-200 p-6 shadow-sm">
                <blockquote class="italic text-gray-800">{{ __('main.testimonial_2') }}</blockquote>
                <figcaption class="text-sm text-gray-600 mt-3">{{ __('main.testimonial_author_2') }}</figcaption>
            </figure>
        </div>
    </section>

    <!-- =======================
         FAQ (compact)
    ======================== -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">{{ __('main.faq_title') }}</h2>
        <div class="max-w-3xl mx-auto divide-y divide-gray-200 border border-gray-200 rounded-xl">
            <details class="p-5 group">
                <summary class="cursor-pointer font-medium text-gray-900 flex items-center justify-between">
                    {{ __('main.faq_backend_question') }}
                    <span class="ml-3 text-gray-500 group-open:rotate-180 transition">&#9660;</span>
                </summary>
                <p class="mt-3 text-gray-700">{{ __('main.faq_backend_answer') }}</p>
            </details>
            <details class="p-5 group">
                <summary class="cursor-pointer font-medium text-gray-900 flex items-center justify-between">
                    {{ __('main.faq_pricing_question') }}
                    <span class="ml-3 text-gray-500 group-open:rotate-180 transition">&#9660;</span>
                </summary>
                <p class="mt-3 text-gray-700">{{ __('main.faq_pricing_answer') }}</p>
            </details>
            <details class="p-5 group">
                <summary class="cursor-pointer font-medium text-gray-900 flex items-center justify-between">
                    {{ __('main.faq_plans_question') }}
                    <span class="ml-3 text-gray-500 group-open:rotate-180 transition">&#9660;</span>
                </summary>
                <p class="mt-3 text-gray-700">{{ __('main.faq_plans_answer') }}</p>
            </details>
        </div>
    </section>

    <!-- =======================
         CTA BAND
    ======================== -->
    <section class="container mx-auto px-4 py-12 text-center bg-gray-800 text-white rounded-xl shadow-sm">
        <h2 class="text-2xl sm:text-3xl font-bold mb-3">{{ __('main.cta_title') }}</h2>
        <p class="text-lg mb-6 opacity-90">{{ __('main.cta_description') }}</p>
        <a href="{{route('register')}}" class="bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow hover:bg-gray-100">
            {{ __('main.cta_button') }}
        </a>
    </section>
@endsection

@push('scripts')
    <script>
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
            const costSubs  = subs * submissionCost; // Use submissionCost for per 1000 submissions
            const costForms = forms * formCost;        // Use formCost for per 10 forms
            let total = costSubs + costForms;
            // if (total < minPayment) total = minPayment;               // Apply minimum payment
            totalCostSpan.textContent = total.toFixed(2);
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
@endpush
