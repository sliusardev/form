<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">
<head>
    <!-- =======================
         META / SEO
    ======================== -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', '') {{__('main.meta_title')}}</title>
    <meta name="description" content="{{__('main.meta_description')}}">
    <meta property="og:title" content="{{__('main.og_title')}}" />
    <meta property="og:description" content="{{__('main.og_description')}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('img/screens/landing.png')}}" />

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


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M8QN4FB4');</script>
    <!-- End Google Tag Manager -->


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-C7M3XS6DPL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-C7M3XS6DPL');
    </script>
</head>

<body class="bg-white text-gray-800 leading-relaxed antialiased">

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8QN4FB4"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- =======================
     HEADER / NAV
======================== -->
<header class="w-full border-b border-gray-800 bg-gray-800 text-white sticky top-0 z-50">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <!-- Brand -->
        <a href="{{route('home', app()->getLocale())}}" class="text-3xl font-semibold text-white">FormPost</a>

        <!-- Desktop nav -->
        <nav id="navMenu" class="hidden md:flex items-center gap-8 text-base">
            <a href="#features" class="hover:text-gray-300">{{__('main.nav_features')}}</a>
            <a href="#pricing" class="hover:text-gray-300">{{__('main.nav_pricing')}}</a>
            <a href="#integration" class="hover:text-gray-300">{{__('main.nav_how_it_works')}}</a>
            <a href="#screens" class="hover:text-gray-300">{{__('main.nav_screenshots')}}</a>
            <a href="{{route('about', app()->getLocale())}}" class="hover:text-gray-300">{{__('main.about_us')}}</a>
{{--            <a href="#" class="hover:text-gray-300">{{__('main.nav_docs')}}</a>--}}
{{--            <a href="#" class="hover:text-gray-300">{{__('main.nav_contact')}}</a>--}}
        </nav>


        <div class="flex items-center gap-4">
            <div class="relative">
                <button id="langSwitcher" class="hover:text-gray-300 flex items-center gap-1 bg-gray-800 text-lg font-medium py-1 px-2 rounded-lg border-1 border-gray-400 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="n   one" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ app()->getLocale() }}</span>
                </button>
                <div id="langMenu" class="hidden absolute bg-gray-800 text-white rounded-lg shadow-lg mt-2">
                    <a href="{{ route('lang.switch', ['locale' => 'en']) }}" class="block px-4 py-2 hover:bg-gray-700">English</a>
                    <a href="{{ route('lang.switch', ['locale' => 'uk']) }}" class="block px-4 py-2 hover:bg-gray-700">Українська</a>
                </div>
            </div>

            <!-- Right-side actions -->
            @if (Route::has('login'))
                @auth
                    <a href="{{route('dashboard')}}" type="button" class="hidden md:block bg-white hover:bg-gray-100 text-gray-800 text-base font-medium py-2 px-4 rounded-lg shadow transition cursor-pointer p-2">
                        {{__('dashboard.dashboard')}}
                    </a>
                @else
                    <div class="hidden md:flex items-center gap-3">
                        <a href="{{route('login')}}" type="button" class="hover:text-gray-300 bg-gray-700 text-lg font-medium py-1 px-4 rounded-lg border-1 border-white shadow">
                            {{__('dashboard.login')}}
                        </a>
                        <a href="{{route('register')}}" type="button" class="bg-white hover:bg-gray-100 text-gray-800 text-base font-medium py-2 px-4 rounded-lg border-0 shadow transition cursor-pointer">
                            {{__('dashboard.get_started')}}
                        </a>
                    </div>
                @endauth
            @endif

            <button id="menuBtn" class="md:hidden p-2 rounded-lg border border-gray-700 bg-gray-800 text-white" aria-label="Toggle navigation" aria-expanded="false" aria-controls="mobilePanel">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile hamburger -->

    </div>

    <!-- Mobile panel -->
    <div id="mobilePanel" class="md:hidden hidden border-t border-gray-800 bg-gray-800 text-white" role="dialog" aria-label="Mobile navigation">
        <div class="container mx-auto px-4 py-3 text-lg space-y-2">
            <a href="#features" class="block hover:text-gray-300">{{__('main.nav_features')}}</a>
            <a href="#pricing" class="block hover:text-gray-300">{{__('main.nav_pricing')}}</a>
            <a href="#integration" class="block hover:text-gray-300">{{__('main.nav_how_it_works')}}</a>
            <a href="#screens" class="block hover:text-gray-300">{{__('main.nav_screenshots')}}</a>
            <a href="{{route('about', app()->getLocale())}}" class="hover:text-gray-300">{{__('main.about_us')}}</a>
{{--            <a href="#" class="block hover:text-gray-300">{{__('main.nav_docs')}}</a>--}}
{{--            <a href="#" class="block hover:text-gray-300">{{__('main.nav_contact')}}</a>--}}
            <div class=" border-t border-gray-700 my-t pt-3">
                @auth
                    <a href="{{route('dashboard')}}" type="button" class="bg-white hover:bg-gray-100 text-gray-800 text-base font-medium py-2 px-4 rounded-lg shadow transition cursor-pointer p-2">
                        {{__('dashboard.dashboard')}}
                    </a>
                @else
                    <div class="pt-2 flex items-center gap-4">
                        <a href="{{route('login')}}" class="hover:text-gray-300 bg-gray-700 text-lg font-medium py-2 px-4 rounded-lg border-1 border-white shadow">{{__('main.nav_login')}}</a>
                        <a href="{{route('register')}}" class="bg-white  text-gray-800 text-lg font-medium py-2 px-4 rounded-lg shadow">
                            {{__('main.nav_get_started')}}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div></header>

@includeIf('dashboard.partials.notify-section')


@yield('content')

<!-- =======================
     FOOTER
======================== -->
<footer class="container mx-auto px-4 py-8 text-sm text-gray-600">
    <div class="border-t border-gray-200 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
        <div>&copy; 2024 - {{now()->year}} FormPost. {{__('dashboard.all_rights_reserved')}}</div>
        <div class="flex items-center gap-4">
            <a href="{{route('terms', app()->getLocale())}}" class="hover:underline">{{__('dashboard.terms_of_service')}}</a>
            <a href="{{route('privacy', app()->getLocale())}}" class="hover:underline">{{__('dashboard.privacy_policy')}}</a>
        </div>
    </div>
</footer>

@stack('scripts')

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

    // Language switcher
    const langSwitcher = document.getElementById('langSwitcher');
    const langMenu = document.getElementById('langMenu');
    langSwitcher.addEventListener('click', () => {
        langMenu.classList.toggle('hidden');
    });
</script>
</body>
</html>
