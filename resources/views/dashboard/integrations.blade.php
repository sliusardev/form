@extends('layouts.app')

@section('content')

    <div class="max-w-full mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Integrations</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Slack</h3>
                <p class="text-gray-600 mb-4">Receive real-time notifications in your Slack workspace.</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Connect</button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Zapier</h3>
                <p class="text-gray-600 mb-4">Automate workflows by connecting with over 5,000 apps.</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Connect</button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Webhook</h3>
                <p class="text-gray-600 mb-4">Send submission data to any custom endpoint in real-time.</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Configure</button>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Google Sheets</h3>
                <p class="text-gray-600 mb-4">Automatically append form submissions to a spreadsheet.</p>
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Connect</button>
            </div>
        </div>
    </div>
@endsection
