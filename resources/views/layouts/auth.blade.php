<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>@yield('title', 'Login'). FormPost — Simple Form Submissions from your site.</title>
    <meta name="description" content="Collect form submissions without a backend. Buy submissions and forms as needed. No subscriptions, no frameworks — just simple integration.">
    <meta property="og:title" content="FormPost — Simple Form Submissions" />
    <meta property="og:description" content="Collect form submissions without a backend. Buy submissions and forms as needed. No subscriptions, no frameworks — just simple integration." />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('img/screens/landing.png')}}" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    @if ($errors->any())
        <div class="mb-4 mx-auto">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 mx-auto">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @yield('content')
</body>
</html>
