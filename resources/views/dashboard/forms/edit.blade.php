@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto bg-white p-4 rounded-lg shadow-md">
        <h2 class="md:text-2xl font-bold mb-6">{{ __('dashboard.edit_form') }}</h2>
        <div class="card">
            <div class="card-body p-0">
                <form action="{{ route('forms.update', $form) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <label for="form_utl" class="label">
                            <span class="label-text">{{ __('dashboard.form_url') }}</span>
                        </label>
                        <input type="text" id="form_utl" name="form_url" value="{{ $form->formUrl() }}"
                               class="input input-bordered w-full" disabled>
                    </div>

                    <div class="form-control w-full">
                        <label for="title" class="label">
                            <span class="label-text">{{ __('dashboard.title') }}</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title', $form->title) }}"
                               class="input input-bordered w-full @error('title') input-error @enderror" required>
                        @error('title')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label for="description" class="label">
                            <span class="label-text">{{ __('dashboard.description') }}</span>
                        </label>
                        <textarea id="description" name="description" rows="4"
                                  class="textarea textarea-bordered w-full @error('description') textarea-error @enderror">{{ old('description', $form->description) }}</textarea>
                        @error('description')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">{{ __('dashboard.enabled') }}</span>
                            <input type="checkbox" id="is_enabled" name="is_enabled" class="checkbox"
                                  {{ old('is_enabled', $form->is_enabled) ? 'checked' : '' }}>
                        </label>
                        @error('is_enabled')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer">
                            <span class="label-text">{{ __('dashboard.send_notifications') }}</span>
                            <input type="checkbox" id="send_notify" name="send_notify" class="checkbox"
                                  {{ old('send_notify', $form->send_notify) ? 'checked' : '' }}>
                        </label>
                        @error('send_notify')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('dashboard.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
