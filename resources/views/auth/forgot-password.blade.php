@extends('layouts.auth')

@section('title', __('auth.forgot_password'))

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{ __('auth.forgot_password') }}</h2>
            @if(session('status'))
                <div class="alert alert-success text-green-600 text-center mb-4">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="email">{{ __('auth.email') }}</label>
                    <input type="email" id="email" name="email"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300 @error('email') border-red-500 @enderror"
                           placeholder="you@gmail.com" required autofocus value="{{ old('email') }}">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-150">
                    {{ __('auth.send_password_reset_link') }}
                </button>
            </form>
            <p class="mt-4 text-sm text-center text-gray-600">
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">{{ __('auth.back_to_login') }}</a>
            </p>
        </div>
    </div>
@endsection
