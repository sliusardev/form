@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-base-100 p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h2 class="text-2xl font-semibold">Create Billing Plan</h2>
        </div>

        <form action="{{ route('billing-plans.store') }}" method="POST">
            @csrf

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Plan Name</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="input input-bordered w-full @error('name') input-error @enderror"
                    required>
                @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Price (UAH)</span>
                </label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0"
                    class="input input-bordered w-full @error('price') input-error @enderror"
                    required>
                @error('price')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Billing Cycle</span>
                </label>
                <select name="billing_cycle" id="billing_cycle"
                    class="select select-bordered w-full @error('billing_cycle') select-error @enderror"
                    required>
                    <option value="" disabled {{ old('billing_cycle') ? '' : 'selected' }}>Select billing cycle</option>
                    <option value="monthly" {{ old('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ old('billing_cycle') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
                @error('billing_cycle')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Description</span>
                </label>
                <textarea name="description" id="description" rows="3"
                    class="textarea textarea-bordered w-full @error('description') textarea-error @enderror"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full mb-4">
                <label class="label">
                    <span class="label-text">Features</span>
                </label>
                <div id="features-container">
                    @if(old('features'))
                        @foreach(old('features') as $index => $feature)
                            <div class="flex items-center mb-2 feature-row">
                                <input type="text" name="features[]" value="{{ $feature }}"
                                    class="input input-bordered flex-1 @error('features.' . $index) input-error @enderror"
                                    required>
                                <button type="button" class="btn btn-ghost btn-circle ml-2 remove-feature">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-center mb-2 feature-row">
                            <input type="text" name="features[]"
                                class="input input-bordered flex-1"
                                required>
                            <button type="button" class="btn btn-ghost btn-circle ml-2 remove-feature">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                            </button>
                        </div>
                    @endif
                </div>

                <button type="button" id="add-feature" class="btn btn-ghost btn-sm mt-2 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle mr-1"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                    Add Feature
                </button>

                @error('features')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control mb-6">
                <label class="label cursor-pointer justify-start">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                        class="checkbox checkbox-primary">
                    <span class="ml-2 label-text">Active</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('billing-plans.index') }}" class="btn btn-ghost">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    Create Plan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const featuresContainer = document.getElementById('features-container');
        const addFeatureButton = document.getElementById('add-feature');

        addFeatureButton.addEventListener('click', function() {
            const featureRow = document.createElement('div');
            featureRow.className = 'flex items-center mb-2 feature-row';

            featureRow.innerHTML = `
                <input type="text" name="features[]"
                    class="input input-bordered flex-1"
                    required>
                <button type="button" class="btn btn-ghost btn-circle ml-2 remove-feature">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                </button>
            `;

            featuresContainer.appendChild(featureRow);

            // Add event listener to the new remove button
            const removeButton = featureRow.querySelector('.remove-feature');
            removeButton.addEventListener('click', function() {
                if (featuresContainer.querySelectorAll('.feature-row').length > 1) {
                    featuresContainer.removeChild(featureRow);
                }
            });
        });

        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-feature').forEach(button => {
            button.addEventListener('click', function() {
                if (featuresContainer.querySelectorAll('.feature-row').length > 1) {
                    this.closest('.feature-row').remove();
                }
            });
        });
    });
</script>
@endpush
