@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="mb-6 flex flex-wrap justify-center lg:justify-between items-center">
            <h2 class="text-3xl font-semibold text-gray-800">{{ __('dashboard.submission_details') }}</h2>
            <a href="{{ route('submissions.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                ← {{ __('dashboard.submissions') }}
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6 border-b border-gray-200 pb-4">
                <div>
                    <p class="text-sm text-gray-600">{{ __('dashboard.submission') }} ID</p>
                    <p class="font-medium">#{{ $submission->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">{{ __('dashboard.form') }}</p>
                    <p class="font-medium">{{ $submission->form->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">{{ __('dashboard.submission_date') }}</p>
                    <p class="font-medium">{{ $submission->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">{{ __('dashboard.method') }}</p>
                    @if(strtoupper($submission->method) === 'POST')
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $submission->method }}</span>
                    @elseif(strtoupper($submission->method) === 'GET')
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $submission->method }}</span>
                    @else
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $submission->method }}</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-500">IP {{ __('dashboard.address') }}</p>
                    <p class="font-medium">{{ $submission->ip_address }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">IP {{ __('dashboard.hash') }}</p>
                    <p class="font-medium">{{ $submission->hash }}</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2">{{ __('dashboard.form') }} {{ __('dashboard.form_data') }}</h3>

            <div x-data="tabs" class="tab-switcher">

                <!-- name of each tab group should be unique -->
                <div class="tabs tabs-lift">
                    <label class="tab">
                        <input type="radio" name="my_tabs_4"  checked="checked" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        {{ __('dashboard.formatted') }}
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        @includeIf('dashboard.partials.submissions.formatted-view')
                    </div>

                    <label class="tab">
                        <input type="radio" name="my_tabs_4"/>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        JSON
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        @includeIf('dashboard.partials.submissions.json-view')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
