@extends('layouts.app')

@section('content')

    <!-- name of each tab group should be unique -->
    <div class="tabs tabs-lift">
        <label class="tab">
            <input type="radio" name="my_tabs_4" checked="checked"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" /></svg>
            {{__('dashboard.billing')}}
        </label>
        <div class="tab-content bg-base-100 border-base-300 p-6">
            <form class="space-y-4" action="{{ route('settings.update') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.one_submission_cost', ['currency' => 'UAH'])}}</label>
                    <input type="number" name="one_submission_cost_uah" id="one_submission_cost_uah" value="{{ old('one_submission_cost_uah', $settings['one_submission_cost_uah'] ?? '') }}"  min="0" step="0.5" required class="w-full bg-white border @error('name') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.one_form_cost', ['currency' => 'UAH'])}}</label>
                    <input type="number" name="one_form_cost_uah" id="one_form_cost_uah" value="{{ old('one_form_cost_uah', $settings['one_form_cost_uah'] ?? '') }}" required class="w-full bg-white border @error('slug') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.min_payment', ['currency' => 'UAH'])}}</label>
                    <input type="number" name="min_payment_uah" id="min_payment_uah" value="{{ old('min_payment_uah', $settings['min_payment_uah'] ?? '') }}" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                </div>
                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">{{__('dashboard.save')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
