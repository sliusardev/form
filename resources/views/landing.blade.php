<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FormPilot – Simple Form Submissions</title>

    <!-- Font to match your dashboard vibe -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS v4 (CDN for dev; compile for prod) -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @layer base {
            html { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        }
    </style>
</head>
<body class="bg-white text-gray-800 leading-relaxed">

<!-- Header / Navigation -->
<header class="w-full border-b border-gray-200 bg-white">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <!-- Brand -->
        <a href="#" class="text-2xl font-semibold text-gray-800">FormPilot</a>

        <!-- Nav (desktop) -->
        <nav id="navMenu" class="hidden md:flex space-x-8 text-sm">
            <a href="#features" class="hover:text-gray-900">Features</a>
            <a href="#pricing" class="hover:text-gray-900">Pricing</a>
            <a href="#integration" class="hover:text-gray-900">How It Works</a>
            <a href="#" class="hover:text-gray-900">Docs</a>
            <a href="#" class="hover:text-gray-900">Contact</a>
        </nav>

        <!-- Right-side -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="#" class="text-sm hover:text-gray-900">Login</a>
            <a href="#pricing" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-4 rounded-lg shadow">
                Get Started
            </a>
        </div>

        <!-- Mobile menu btn -->
        <button id="menuBtn" class="md:hidden focus:outline-none" aria-label="Toggle Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Mobile menu panel -->
    <div id="mobilePanel" class="md:hidden hidden border-t border-gray-200 bg-white">
        <div class="px-4 py-3 space-y-2 text-sm">
            <a href="#features" class="block hover:text-gray-900">Features</a>
            <a href="#pricing" class="block hover:text-gray-900">Pricing</a>
            <a href="#integration" class="block hover:text-gray-900">How It Works</a>
            <a href="#" class="block hover:text-gray-900">Docs</a>
            <a href="#" class="block hover:text-gray-900">Contact</a>
            <div class="pt-2 flex items-center gap-3">
                <a href="#" class="text-sm hover:text-gray-900">Login</a>
                <a href="#pricing" class="bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-4 rounded-lg shadow">Get Started</a>
            </div>
        </div>
    </div>
</header>

<!-- Hero -->
<section class="container mx-auto px-4 py-16 text-center" id="hero">
    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
        Get Started with Simple Form Submissions
    </h1>
    <p class="text-lg text-gray-600 mb-8">
        Collect form submissions without writing a backend. Pay only for what you need – no subscriptions, no hassle.
    </p>
    <a href="#pricing" class="bg-gray-800 hover:bg-gray-900 text-white font-medium py-3 px-6 rounded-lg shadow-md">
        Start Now
    </a>
</section>

<!-- Features -->
<section class="container mx-auto px-4 py-12" id="features">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">Why Choose FormPilot?</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 text-center">
        <div class="p-4">
            <div class="text-4xl mb-2">🚫</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Subscriptions</h3>
            <p class="text-gray-600">No monthly fees or contracts. <strong>Pay-as-you-go</strong> for the submissions you actually use.</p>
        </div>
        <div class="p-4">
            <div class="text-4xl mb-2">💰</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Usage-Based Pricing</h3>
            <p class="text-gray-600">Transparent pricing – $10 per 1000 submissions, $10 per 10 forms. Minimum purchase $15.</p>
        </div>
        <div class="p-4">
            <div class="text-4xl mb-2">⚡</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Integration</h3>
            <p class="text-gray-600">Add our endpoint to your form and you’re done – <strong>no server code required</strong>.</p>
        </div>
    </div>
</section>

<!-- Pricing -->
<section class="container mx-auto px-4 py-12 bg-gray-50" id="pricing">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-6">Simple, Pay-As-You-Go Pricing</h2>
    <p class="text-center text-gray-700 mb-8">No subscriptions or hidden fees – just purchase the capacity you need.</p>

    <div class="max-w-xl mx-auto bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
        <ul class="text-gray-800 mb-6 list-disc list-inside">
            <li><strong>$10</strong> per 1,000 submissions</li>
            <li><strong>$10</strong> per 10 forms</li>
            <li><strong>$15</strong> minimum purchase</li>
        </ul>

        <!-- Calculator -->
        <div class="text-gray-800">
            <p class="font-medium mb-2">Calculate your cost:</p>
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                <div class="flex flex-col">
                    <label for="subInput" class="text-sm text-gray-700 mb-1"># of Submissions</label>
                    <input id="subInput" type="number" min="0" step="1000" value="1000"
                           class="w-28 border border-gray-300 rounded px-3 py-1 text-gray-800" />
                </div>
                <div class="flex flex-col">
                    <label for="formInput" class="text-sm text-gray-700 mb-1"># of Forms</label>
                    <input id="formInput" type="number" min="0" step="10" value="10"
                           class="w-24 border border-gray-300 rounded px-3 py-1 text-gray-800" />
                </div>
                <div class="flex flex-col text-center sm:text-right">
                    <div class="text-lg font-semibold mt-2 sm:mt-0">
                        Total Cost: <span id="totalCost" class="text-gray-900">$20.00</span>
                    </div>
                    <div class="text-sm text-gray-500">(Minimum $15)</div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="#" class="inline-block bg-gray-800 hover:bg-gray-900 text-white font-medium py-2.5 px-5 rounded-lg shadow">
                    Buy Capacity
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="container mx-auto px-4 py-12" id="integration">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-900 mb-8">How It Works</h2>

    <div class="max-w-3xl mx-auto mb-8 text-gray-800">
        <ol class="list-decimal list-inside space-y-3 text-lg">
            <li><strong>Add our endpoint</strong> to your HTML form’s action URL (we generate a unique URL for you).</li>
            <li><strong>Deploy your form</strong> on your site. Submissions are sent to our secure backend.</li>
            <li><strong>Receive & manage</strong> submissions in real-time in your dashboard or via email.</li>
        </ol>
    </div>

    <div class="max-w-xl mx-auto bg-gray-100 border border-gray-200 rounded-lg p-4 text-sm">
<pre class="text-left overflow-x-auto"><code class="language-html text-gray-800">
&lt;!-- Example HTML Form Integration --&gt;
&lt;form action="https://formpilot.io/your-form-endpoint" method="POST"&gt;
  &lt;label&gt;Your Email:&lt;/label&gt;
  &lt;input type="email" name="email" required&gt;
  &lt;button type="submit"&gt;Submit&lt;/button&gt;
&lt;/form&gt;
</code></pre>
    </div>

    <p class="text-center text-gray-600 mt-4">
        See our <a href="#" class="text-gray-800 underline decoration-gray-300 hover:decoration-gray-800">Documentation</a> for more details and examples.
    </p>
</section>

<!-- Testimonials (optional) -->
<section class="container mx-auto px-4 py-12 text-center">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">What Our Users Say</h2>
    <div class="max-w-2xl mx-auto">
        <figure class="mb-8">
            <blockquote class="text-gray-800 italic text-lg">“We set up contact forms in minutes. No backend code. It just works.”</blockquote>
            <figcaption class="text-gray-600 mt-2">— Jane D., Frontend Developer</figcaption>
        </figure>
        <figure>
            <blockquote class="text-gray-800 italic text-lg">“Pay-per-use keeps costs low for our small business.”</blockquote>
            <figcaption class="text-gray-600 mt-2">— John S., Small Business Owner</figcaption>
        </figure>
    </div>
</section>

<!-- CTA band with gray-800 brand color -->
<section class="container mx-auto px-4 py-12 text-center bg-gray-800 text-white rounded-lg shadow-md">
    <h2 class="text-2xl sm:text-3xl font-bold mb-4">Ready to Simplify Your Forms?</h2>
    <p class="text-lg mb-6">Get started today and receive 50 free submissions on sign-up. No credit card required.</p>
    <a href="#" class="bg-white text-gray-800 font-semibold py-3 px-6 rounded-lg shadow hover:bg-gray-100">
        Get Started for Free
    </a>
</section>

<!-- Footer -->
<footer class="container mx-auto px-4 py-6 text-center text-sm text-gray-600 mt-8 border-t border-gray-200">
    <div>&copy; 2025 FormPilot. All rights reserved.</div>
    <div class="mt-2">
        <a href="#" class="mx-2 hover:underline">Terms of Service</a>
        <a href="#" class="mx-2 hover:underline">Privacy Policy</a>
    </div>
</footer>

<!-- Scripts -->
<script>
    // Mobile menu toggle (separate panel for better control)
    const menuBtn = document.getElementById('menuBtn');
    const mobilePanel = document.getElementById('mobilePanel');
    menuBtn.addEventListener('click', () => {
        mobilePanel.classList.toggle('hidden');
    });

    // Pricing calculator
    const subInput = document.getElementById('subInput');
    const formInput = document.getElementById('formInput');
    const totalCostSpan = document.getElementById('totalCost');

    function updateCost() {
        const subs = Number(subInput.value) || 0;
        const forms = Number(formInput.value) || 0;

        const costSubs = Math.ceil(subs / 1000) * 10; // $10 per 1000
        const costForms = Math.ceil(forms / 10) * 10; // $10 per 10
        let total = costSubs + costForms;
        if (total < 15) total = 15;                   // $15 minimum

        totalCostSpan.textContent = '$' + total.toFixed(2);
    }

    subInput.addEventListener('input', updateCost);
    formInput.addEventListener('input', updateCost);
    updateCost();
</script>
</body>
</html>
