@extends('layouts.site')

@section('title', __('auth.email_verification_title'))

@section('content')
    <div class="min-h-3 lg:min-h-screen flex items-center justify-center p-4 bg-gray-100">
        <div class="max-w-xl w-full bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('auth.email_verification_title') }}</h2>

            <div class="mb-6 text-center">
                <p class="text-gray-700 mb-4">
                    {{ __('auth.email_verification_thanks') }}
                </p>
                <p class="text-gray-700 mb-4">
                    {{ __('auth.email_verification_not_received') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ __('auth.email_verification_link_sent_alert') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-600 transition duration-150">
                    {{ __('auth.resend_verification_email') }}
                </button>
            </form>

            <p class="mt-4 text-sm text-center text-gray-600">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-blue-500 hover:underline">
                    {{ __('auth.logout') }}
                </a>
            </p>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
@endsection
