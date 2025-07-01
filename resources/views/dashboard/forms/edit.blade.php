@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{ __('dashboard.edit_form') }}</h2>
        <form action="{{ route('forms.update', $form) }}" method="POST" class="bg-white rounded-lg shadow p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="form_utl" class="block text-gray-700 font-medium mb-1">{{ __('dashboard.form_url') }}</label>
                <input type="text" id="form_utl" name="form_url" value="{{ $form->formUrl() }}" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300" disabled>
            </div>

            <div>
                <label for="title" class="block text-gray-700 font-medium mb-1">{{ __('dashboard.title') }}</label>
                <input type="text" id="title" name="title" value="{{ old('title', $form->title) }}" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300 @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium mb-1">{{ __('dashboard.description') }}</label>
                <textarea id="description" name="description" rows="4" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300 @error('description') border-red-500 @enderror">{{ old('description', $form->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_enabled" name="is_enabled" class="mr-2" {{ old('is_enabled', $form->is_enabled) ? 'checked' : '' }}>
                <label for="is_enabled" class="text-gray-700">{{ __('dashboard.enabled') }}</label>
                @error('is_enabled')
                    <p class="text-red-500 text-sm ml-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="send_notify" name="send_notify" class="mr-2" {{ old('send_notify', $form->send_notify) ? 'checked' : '' }}>
                <label for="send_notify" class="text-gray-700">{{ __('dashboard.send_notifications') }}</label>
                @error('send_notify')
                    <p class="text-red-500 text-sm ml-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
                    {{ __('dashboard.save') }}
                </button>
            </div>
        </form>
    </div>
@endsection
