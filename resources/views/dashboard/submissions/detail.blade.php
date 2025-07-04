@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="mb-6 flex flex-wrap justify-center lg:justify-between items-center">
            <h2 class="text-3xl font-semibold text-gray-800">Submission Details</h2>
            <a href="{{ route('submissions.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                ← Back to Submissions
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Submission ID</p>
                    <p class="font-medium">#{{ $submission->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Form</p>
                    <p class="font-medium">{{ $submission->form->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Submitted Date</p>
                    <p class="font-medium">{{ $submission->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">IP Address</p>
                    <p class="font-medium">{{ $submission->ip_address }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="font-medium">
                        <span class="px-2 py-1 text-xs rounded-full {{ $submission->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Form Data</h3>

            <div x-data="tabs" class="tab-switcher">
                <div class="mb-6">
                    <div class="border-b flex space-x-1">
                        <button
                            data-tab="formatted-view"
                            @click="setActiveTab('formatted-view')"
                            :class="{'border-blue-600 text-blue-600 font-semibold': isActive('formatted-view'), 'text-gray-500 hover:text-gray-700': !isActive('formatted-view')}"
                            class="py-3 px-5 border-b-2 transition-all duration-200 rounded-t-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                <span>Formatted</span>
                            </div>
                        </button>

                        <button
                            data-tab="json-view"
                            @click="setActiveTab('json-view')"
                            :class="{'border-blue-600 text-blue-600 font-semibold': isActive('json-view'), 'text-gray-500 hover:text-gray-700': !isActive('json-view')}"
                            class="py-3 px-5 border-b-2 transition-all duration-200 rounded-t-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                <span>JSON</span>
                            </div>
                        </button>
                    </div>
                </div>

                <div class="tabs" id="views">
                    <div id="formatted-view" class="tab-content"
                         x-show="isActive('formatted-view')"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        @includeIf('dashboard.partials.submissions.formatted-view')
                    </div>
                    <div id="json-view" class="tab-content"
                         x-show="isActive('json-view')"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0">
                        @includeIf('dashboard.partials.submissions.json-view')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

@endpush
