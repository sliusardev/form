@extends('layouts.app')

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
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">{{ __('dashboard.save') }}</button>
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
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">{{ __('dashboard.update') }}</button>
            </div>
        </form>
    </div>

@endsection
