@extends('layouts.auth')

@section('title', __('auth.login'))

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">{{__('auth.log_in')}}t</h2>
            <form method="POST" action="{{ route('auth.login') }}" class="space-y-4">
            @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="email">{{__('auth.email')}}</label>
                    <input type="email" id="email" name="email"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                           placeholder="you@gmail.com" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1" for="password">{{__('auth.password_field')}}</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                           required>
                </div>

                <p class="mt-4 text-sm text-left text-gray-600">
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">{{ __('auth.forgot_password') }}</a>
                </p>

                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-600 transition duration-150">
                    {{__('auth.login')}}
                </button>
                <p class="mt-4 text-sm text-center text-gray-600">
                    {{__('auth.create_an_account')}}
                    <a href="{{route('register')}}" class="text-blue-500 hover:underline">{{__('auth.register')}}</a>
                </p>
            </form>

            <div class="mt-6">
                <div class="relative flex items-center justify-center">
                    <span class="absolute bg-white px-2 text-gray-500 text-sm">or</span>
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="mt-4 space-y-3">
                    <a href="{{route('socialite.auth.redirect', 'google')}}" type="button"
                       class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2 hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                        <span>{{__('auth.login_with')}} Google</span>
                    </a>
                    <a href="{{route('socialite.auth.redirect', 'github')}}" type="button"
                       class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2 hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/512317/github-142.svg" alt="GitHub" class="w-5 h-5">
                        <span>{{__('auth.login_with')}} GitHub</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
