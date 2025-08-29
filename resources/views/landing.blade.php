@extends('layouts.site')

@section('content')
<!-- =======================
 HERO
======================== -->
<section id="hero" class="container mx-auto px-4 py-16 text-center">
    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">{{ __('main.hero_title') }}</h1>
    <p class="text-xl text-gray-600 mb-6 w-full mx-auto">{{ __('main.hero_description_1') }}</p>
    <p class="text-xl text-gray-600 mb-8 w-full mx-auto">{{ __('main.hero_description_2') }}</p>
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
    <div class="text-center uppercase tracking-wide text-xl text-gray-600 mb-8">
        {{ __('main.logos_trust') }}
    </div>
</section>

<!-- =======================
 HOW IT WORKS / INTEGRATION
======================== -->
<section id="how-it-works" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ __('main.integration_title') }}</h2>
                <p class="text-xl text-gray-600 mb-8">{{ __('main.integration_subtitle') }}</p>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-sm mr-4 mt-1">1</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                {!!  __('main.integration_step_1') !!}
                            </h3>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-sm mr-4 mt-1">2</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                {!!  __('main.integration_step_2') !!}
                            </h3>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-sm mr-4 mt-1">3</div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                {!!  __('main.integration_step_3') !!}
                            </h3>
                        </div>
                    </div>
                </div>

{{--                <div class="mt-10">--}}
{{--                    <a href="#" class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-700 transition-colors duration-200">--}}
{{--                        Learn more about our API--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />--}}
{{--                        </svg>--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ __('main.html_example_title') }}</h3>
                <div class="bg-gray-900 rounded-lg p-2 overflow-x-auto text-sm">
                    <pre class="text-sm bg-gray-900 text-gray-100 border border-gray-700 rounded-lg p-3 overflow-x-auto shadow-md"><code><span class="text-green-400">&lt;form</span> <span class="text-blue-300">action</span><span class="text-white">=</span><span class="text-amber-300">"https://formpost.org/f/3QQPFnq8qVtVnfW"</span> <span class="text-blue-300">method</span><span class="text-white">=</span><span class="text-amber-300">"POST"</span><span class="text-green-400">&gt;</span>
  <span class="text-green-400">&lt;label&gt;</span><span class="text-gray-100">Your Email</span><span class="text-green-400">&lt;/label&gt;</span>
  <span class="text-green-400">&lt;input</span> <span class="text-blue-300">type</span><span class="text-white">=</span><span class="text-amber-300">"email"</span> <span class="text-blue-300">name</span><span class="text-white">=</span><span class="text-amber-300">"email"</span> <span class="text-blue-300">required</span> <span class="text-green-400">/&gt;</span>

  <span class="text-green-400">&lt;label&gt;</span><span class="text-gray-100">Message</span><span class="text-green-400">&lt;/label&gt;</span>
  <span class="text-green-400">&lt;textarea</span> <span class="text-blue-300">name</span><span class="text-white">=</span><span class="text-amber-300">"message"</span> <span class="text-blue-300">required</span><span class="text-green-400">&gt;&lt;/textarea&gt;</span>

  <span class="text-green-400">&lt;button</span> <span class="text-blue-300">type</span><span class="text-white">=</span><span class="text-amber-300">"submit"</span><span class="text-green-400">&gt;</span><span class="text-gray-100">Send</span><span class="text-green-400">&lt;/button&gt;</span>
<span class="text-green-400">&lt;/form&gt;</span></code></pre>
                </div>
                <p class="text-sm text-gray-500 mt-4 text-center">
                    {{ __('main.html_example_description') }}
                </p>
            </div>
        </div>
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
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">{{ __('main.feature_no_subscriptions') }}</h3>
            </div>
            <p class="text-gray-600">{{ __('main.feature_no_subscriptions_description') }}</p>
        </div>
        <!-- Feature -->
        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9l-7 7-7-7" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('main.feature_pay_as_you_go') }}</h3>
            </div>
            <p class="text-gray-600">{{ __('main.feature_pay_as_you_go_description') }}</p>
        </div>
        <!-- Feature -->
        <div class="rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
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

        <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
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
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ __('main.testimonials_title') }}</h2>
{{--            <p class="text-xl text-gray-600">What our users are saying about FormPost</p>--}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <blockquote class="text-lg text-gray-700 mb-6 leading-relaxed">
                    {{ __('main.testimonial_1') }}
                </blockquote>
                <div class="flex items-center">
{{--                    <div class="w-10 h-10 bg-indigo-300 rounded-full mr-4"></div>--}}
                    <div>
                        <p class="font-semibold text-gray-800">{{ __('main.testimonial_author_1') }}</p>
                        <p class="text-gray-500 text-sm">Frontend Developer</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
                <blockquote class="text-lg text-gray-700 mb-6 leading-relaxed">
                    {{ __('main.testimonial_2') }}
                </blockquote>
                <div class="flex items-center">
{{--                    <div class="w-10 h-10 bg-gray-300 rounded-full mr-4"></div>--}}
                    <div>
                        <p class="font-semibold text-gray-800">{{ __('main.testimonial_author_2') }}</p>
                        <p class="text-gray-500 text-sm">CTO, StartupXYZ</p>
                    </div>
                </div>
            </div>
        </div>
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
