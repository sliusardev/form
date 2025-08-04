<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">
<head>
    <!-- =======================
         META / SEO
    ======================== -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', '').FormPost — Simple Form Submissions from your site.</title>
    <meta name="description" content="Collect form submissions without a backend. Buy submissions and forms as needed. No subscriptions, no frameworks — just simple integration.">
    <meta property="og:title" content="FormPost — Simple Form Submissions" />
    <meta property="og:description" content="Collect form submissions without a backend. Buy submissions and forms as needed. No subscriptions, no frameworks — just simple integration." />
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
</head>

<body class="bg-white text-gray-800 leading-relaxed antialiased">

<!-- =======================
     HEADER / NAV
======================== -->
<header class="w-full border-b border-gray-800 bg-gray-800 text-white sticky top-0 z-50">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <!-- Brand -->
        <a href="{{route('home')}}" class="text-3xl font-semibold text-white">FormPost</a>

        <!-- Desktop nav -->
        <nav id="navMenu" class="hidden md:flex items-center gap-8 text-base">
            <a href="#features" class="hover:text-gray-300">Features</a>
            <a href="#pricing" class="hover:text-gray-300">Pricing</a>
            <a href="#integration" class="hover:text-gray-300">How It Works</a>
            <a href="#screens" class="hover:text-gray-300">Screenshots</a>
            <a href="#" class="hover:text-gray-300">Docs</a>
            <a href="#" class="hover:text-gray-300">Contact</a>

            <!-- Language Switcher -->
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
            <a href="#features" class="block hover:text-gray-300">Features</a>
            <a href="#pricing" class="block hover:text-gray-300">Pricing</a>
            <a href="#integration" class="block hover:text-gray-300">How It Works</a>
            <a href="#screens" class="block hover:text-gray-300">Screenshots</a>
            <a href="#" class="block hover:text-gray-300">Docs</a>
            <a href="#" class="block hover:text-gray-300">Contact</a>
            <div class=" border-t border-gray-700 my-t pt-3">
                @auth
                    <a href="{{route('dashboard')}}" type="button" class="bg-white hover:bg-gray-100 text-gray-800 text-base font-medium py-2 px-4 rounded-lg shadow transition cursor-pointer p-2">
                        {{__('dashboard.dashboard')}}
                    </a>
                @else
                    <div class="pt-2 flex items-center gap-4">
                        <a href="{{route('login')}}" class="hover:text-gray-300 bg-gray-700 text-lg font-medium py-2 px-4 rounded-lg border-1 border-white shadow">Login</a>
                        <a href="{{route('register')}}" class="bg-white  text-gray-800 text-lg font-medium py-2 px-4 rounded-lg shadow">
                            Get Started
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>


@yield('content')

<!-- =======================
     FOOTER
======================== -->
<footer class="container mx-auto px-4 py-8 text-sm text-gray-600">
    <div class="border-t border-gray-200 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
        <div>&copy; 2024 - {{now()->year}} FormPost. {{__('dashboard.all_rights_reserved')}}</div>
        <div class="flex items-center gap-4">
            <a href="{{route('terms')}}" class="hover:underline">{{__('dashboard.terms_of_service')}}</a>
            <a href="/privacy.html" class="hover:underline">{{__('dashboard.privacy_policy')}}</a>
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
