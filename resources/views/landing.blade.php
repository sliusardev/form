<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FormPilot — Smart Form Backend</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Tailwind config to enable class-based dark mode
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">

<!-- Toggle Button -->
<div class="fixed top-4 right-4 z-50">
{{--    <button onclick="document.documentElement.classList.toggle('dark')" class="bg-gray-200 dark:bg-gray-700 text-sm text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">--}}
{{--        Toggle Theme--}}
{{--    </button>--}}

    <a href="{{route('login')}}" type="button" class="bg-gray-200 dark:bg-gray-700 text-sm text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg shadow-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
        Login
    </a>
</div>

<!-- Hero Section -->
<section class="bg-gradient-to-tr from-blue-600 to-purple-700 text-white py-20 text-center">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Simplify Your Form Backend</h1>
        <p class="text-lg md:text-xl mb-6">Collect form submissions without coding a backend. Fast. Secure. Reliable.</p>
        <a href="#pricing" class="bg-white text-blue-700 font-semibold py-3 px-6 rounded-lg shadow hover:bg-gray-100 transition">Start for Free</a>
    </div>
</section>

<!-- Benefits -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div>
                <div class="text-4xl mb-2">🚀</div>
                <h5 class="text-xl font-semibold mb-2">Fast Integration</h5>
                <p>Connect your HTML form in seconds with no backend setup.</p>
            </div>
            <div>
                <div class="text-4xl mb-2">🛡️</div>
                <h5 class="text-xl font-semibold mb-2">Spam Protection</h5>
                <p>Built-in honeypot & reCAPTCHA v3 support.</p>
            </div>
            <div>
                <div class="text-4xl mb-2">📊</div>
                <h5 class="text-xl font-semibold mb-2">Analytics</h5>
                <p>Track submissions and user behavior with our dashboard.</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="bg-gray-100 dark:bg-gray-800 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-8">How It Works</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div>
                <h5 class="text-xl font-semibold mb-2">1. Copy your HTML form</h5>
                <p>Add our form endpoint URL in the action attribute.</p>
            </div>
            <div>
                <h5 class="text-xl font-semibold mb-2">2. Deploy & Collect</h5>
                <p>Deploy your site and start collecting submissions.</p>
            </div>
            <div>
                <h5 class="text-xl font-semibold mb-2">3. Get Notified</h5>
                <p>Get instant email or Slack notifications with every form.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing -->
<section id="pricing" class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-10">Simple Pricing</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Free -->
            <div class="border rounded-xl p-6 hover:scale-[1.02] transition dark:border-gray-700">
                <h4 class="text-2xl font-bold mb-2">Free</h4>
                <p class="text-gray-500 dark:text-gray-400">Perfect to get started</p>
                <h3 class="text-3xl font-bold my-4">$0<span class="text-base font-normal">/mo</span></h3>
                <ul class="mb-6 space-y-1">
                    <li>50 submissions/mo</li>
                    <li>Email notifications</li>
                    <li>Spam protection</li>
                </ul>
                <a href="{{route('register')}}" class="inline-block px-5 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900">Get Started</a>
            </div>

            <!-- Pro -->
            <div class="border-2 border-blue-600 rounded-xl p-6 hover:scale-[1.02] transition shadow dark:border-blue-400">
                <h4 class="text-2xl font-bold mb-2">Pro</h4>
                <p class="text-gray-500 dark:text-gray-400">For growing teams</p>
                <h3 class="text-3xl font-bold my-4">$15<span class="text-base font-normal">/mo</span></h3>
                <ul class="mb-6 space-y-1">
                    <li>5,000 submissions</li>
                    <li>Slack/Discord/Webhook</li>
                    <li>File uploads</li>
                </ul>
                <a href="#" class="inline-block px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Upgrade</a>
            </div>

            <!-- Enterprise -->
            <div class="border rounded-xl p-6 hover:scale-[1.02] transition dark:border-gray-700">
                <h4 class="text-2xl font-bold mb-2">Enterprise</h4>
                <p class="text-gray-500 dark:text-gray-400">Custom solution</p>
                <h3 class="text-3xl font-bold my-4">Contact Us</h3>
                <ul class="mb-6 space-y-1">
                    <li>Unlimited forms</li>
                    <li>Custom branding</li>
                    <li>SOC 2 / GDPR</li>
                </ul>
                <a href="#" class="inline-block px-5 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900">Contact</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-blue-700 text-white text-center">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4">Start collecting forms now</h2>
        <p class="mb-6">Sign up and get your first form running in under 2 minutes.</p>
        <form class="flex flex-col md:flex-row items-center justify-center gap-3 max-w-xl mx-auto">
            <input type="email" class="w-full px-4 py-2 rounded-lg text-gray-800" placeholder="Enter your email" required />
            <button class="bg-white text-blue-700 font-semibold px-6 py-2 rounded-lg hover:bg-gray-100 transition" type="submit">Get Started</button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="py-6 bg-gray-900 text-white text-center">
    <div class="container mx-auto px-4">
        <small>&copy; 2025 FormPilot. All rights reserved.</small>
    </div>
</footer>

</body>
</html>
