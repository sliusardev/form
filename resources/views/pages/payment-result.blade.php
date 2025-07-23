<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-lg mx-auto mt-20 text-center">
        @if($status === 'success')
            <h1 class="text-3xl font-bold text-green-600">✅ {{ $message }}</h1>
        @elseif($status === 'failed')
            <h1 class="text-3xl font-bold text-red-600">❌ {{ $message }}</h1>
        @else
            <h1 class="text-3xl font-bold text-gray-600">⚠️ {{ $message }}</h1>
        @endif

        <a href="/" class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded">Повернутись на головну</a>
    </div>
</body>
</html>
