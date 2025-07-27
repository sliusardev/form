@extends('layouts.app')

@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">
@endpush

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('dashboard.profile_settings') }}</h2>

    <!-- Profile Form -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-medium mb-4">{{ __('dashboard.profile_information') }}</h3>
        <form method="POST" action="{{ route('user.update') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.full_name') }}</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.email') }}</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.phone') }}</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                       class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="123-456-7890" />
                <input type="hidden" name="phone_country_code" id="phone_country_code" value="{{ $user->phone_country_code}}">
            </div>

            <div>
                <button type="submit" class="btn bg-gray-700 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">{{ __('dashboard.save') }}</button>
            </div>
        </form>
    </div>

    <!-- Password Change -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium mb-4">{{ __('dashboard.change_password') }}</h3>
        <form method="POST" action="{{ route('user.update-password') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ __('dashboard.current_password') }}
                    @if(!$user->password)
                        <span class="text-gray-500 text-xs">{{ __('dashboard.current_password_note') }}</span>
                    @endif
                </label>
                <input type="password" name="current_password"
                       class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       @if($user->password) required @endif />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.new_password') }}</label>
                    <input type="password" name="password"
                           class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.confirm_password') }}</label>
                    <input type="password" name="password_confirmation"
                           class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required />
                </div>
            </div>
            <div>
                <button type="submit" class="btn bg-gray-700 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">{{ __('dashboard.update') }}</button>
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.querySelector("#phone");
            const phoneCountryCode = document.querySelector("#phone_country_code");

            const iti = window.intlTelInput(phoneInput, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
                preferredCountries: ["ua", "us", "pl", 'gb', 'nl', 'de', 'fr', 'it', 'es'],
                separateDialCode: true,
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    const savedCountryCode = phoneCountryCode.value;
                    if (savedCountryCode) {
                        fetch('https://cdn.jsdelivr.net/npm/country-flag-emoji-json@2.0.0/dist/index.json')
                            .then(res => res.json())
                            .then(countries => {
                                const dialCode = savedCountryCode.replace('+', '');
                                for (let country of countries) {
                                    if (country.phone === dialCode) {
                                        return callback(country.code.toLowerCase());
                                    }
                                }
                                callback('ua');
                            })
                            .catch(() => callback('ua'));
                    } else {
                        fetch('https://ipapi.co/json/')
                            .then(res => res.json())
                            .then(data => {
                                callback(data.country_code.toLowerCase());
                            })
                            .catch(() => callback('ua'));
                    }
                }
            });

            // Update hidden country code field before form submission
            const form = phoneInput.closest('form');
            form.addEventListener('submit', function() {
                const selectedCountry = iti.getSelectedCountryData();
                if (selectedCountry && selectedCountry.dialCode) {
                    phoneCountryCode.value = '+' + selectedCountry.dialCode;
                } else {
                    phoneCountryCode.value = '';
                }
            });

            // Set country if we have a saved dial code
            if (phoneCountryCode.value) {
                setTimeout(() => {
                    const allCountries = iti.getCountryData();
                    const dialCode = phoneCountryCode.value.replace('+', '');
                    const matchingCountry = allCountries.find(country =>
                        country.dialCode === dialCode
                    );
                    if (matchingCountry) {
                        iti.setCountry(matchingCountry.iso2);
                    }
                }, 100);
            }
        });
    </script>
@endpush
