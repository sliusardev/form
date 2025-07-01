<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard — FormPilot</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
</head>
<body class="h-screen overflow-hidden bg-gray-100 font-sans">
<div class="flex h-screen">
    <!-- Sidebar -->
    @includeIf('dashboard.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Topbar -->
        @includeIf('dashboard.partials.toolbar')
        <!-- Dashboard -->
        <div class="p-6">

            @includeIf('dashboard.partials.notify-section')

            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
