@extends('layouts.site')

@section('title', __('auth.reset_password'))

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gray-100">
        <div class="max-w-xl w-full bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('auth.reset_password') }}</h2>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="email">{{ __('auth.email') }}</label>
                    <input type="email" id="email" name="email"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 @error('email') border-red-500 @enderror"
                           placeholder="you@gmail.com" required autofocus value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="password">{{ __('auth.new_password') }}</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 @error('password') border-red-500 @enderror"
                           required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="password_confirmation">{{ __('auth.confirm_password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-600 transition duration-150">
                    {{ __('auth.reset_password') }}
                </button>
            </form>

            <p class="mt-4 text-sm text-center text-gray-600">
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">{{ __('auth.back_to_login') }}</a>
            </p>
        </div>
    </div>
@endsection
