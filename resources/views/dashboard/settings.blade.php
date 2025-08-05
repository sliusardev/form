@extends('layouts.app')

@section('content')
    <div class="card bg-base-100 shadow-xl w-full">
        <div class="card-body">
            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <h2 class="card-title text-center md:text-2xl font-semibold my-3">{{ __('dashboard.settings') }}</h2>

                <button class="btn" popovertarget="popover-1" style="anchor-name:--anchor-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18M3 18h18" />
                    </svg>
                    {{ __('dashboard.artisan_commands') }}
                </button>

                <ul class="dropdown menu w-52 rounded-box bg-base-100 shadow-sm" popover id="popover-1" style="position-anchor:--anchor-1">
                    <form action="{{ route('settings.artisan') }}" method="POST" class="">
                        @csrf
                        <li>
                            <button type="submit" name="action" value="optimize:clear" class="btn bg-red-500 text-white hover:bg-red-400 transition-colors">
                                {{ __('dashboard.clear_cache') }}
                            </button>
                        </li>
                        <li>
                            <button type="submit" name="action" value="migrate" class="btn bg-blue-500 text-white hover:bg-blue-400 transition-colors">
                                {{ __('dashboard.run_migrations') }}
                            </button>
                        </li>
                    </form>
                </ul>
            </div>

            <form class="" action="{{ route('settings.update') }}" method="POST">
                @csrf

                <div class="tabs tabs-lift">
                    <!-- Billing Tab -->
                    <label class="tab">
                        <input type="radio" name="my_tabs_4" checked="checked"/>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" />
                        </svg>
                        {{ __('dashboard.billing') }}
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        <!-- Billing Form -->
                        <div class="space-y-4 grid grid-cols-1 md:grid-cols-3 gap-2">
                            @foreach($currencies as $currency)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.one_submission_cost', ['currency' => $currency, 'cost' => '']) }}</label>
                                    <input type="number" step="0.01" name="one_submission_cost_{{$currency}}" id="one_submission_cost_{{$currency}}" value="{{ old('one_submission_cost_' . $currency, $settings['one_submission_cost_' . $currency] ?? '') }}"  class="w-full bg-white border @error('name') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.one_form_cost', ['currency' => $currency, 'cost' => '']) }}</label>
                                    <input type="number" step="0.01" name="one_form_cost_{{$currency}}" id="one_form_cost_{{$currency}}" value="{{ old('one_form_cost_' . $currency, $settings['one_form_cost_' . $currency] ?? '') }}"  class="w-full bg-white border @error('slug') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.min_payment', ['currency' => $currency, 'cost' => '']) }}</label>
                                    <input type="number" step="0.01" name="min_payment_{{$currency}}" id="min_payment_{{$currency}}" value="{{ old('min_payment_' . $currency, $settings['min_payment_' . $currency] ?? '') }}"  class="w-full bg-white border @error('slug') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>

                <div class="my-3">
                    <button type="submit" class="btn bg-gray-700 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">{{ __('dashboard.save') }}</button>
                </div>

            </form>

        </div>
    </div>

@endsection
