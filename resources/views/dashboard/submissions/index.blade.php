@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto bg-white p-4 rounded-lg shadow-md">
        <div class="flex flex-col justify-center md:flex-row md:justify-between items-center mb-6">
            <h2 class="text-center md:text-2xl font-semibold text-gray-800 my-3">{{ __('dashboard.submissions') }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('submissions.index', ['view' => 'cards', 'form_id' => request('form_id')]) }}" class="px-2 py-2 rounded-md {{ request('view') === 'cards' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="ml-1">{{ __('dashboard.card_view') }}</span>
                </a>

                <a href="{{ route('submissions.index', ['view' => 'table', 'form_id' => request('form_id')]) }}" class="px-2 py-2 rounded-md {{ request('view', 'table') === 'table' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M3 18h18M3 6h18" />
                    </svg>
                    <span class="ml-1">{{ __('dashboard.table_view') }}</span>
                </a>

            </div>
        </div>

        <div class="mb-6">
                <label for="form_filter" class="sr-only">{{ __('dashboard.filter_by_form') }}</label>

                <select class="select w-full md:w-auto" id="form_filter" name="form_id">
                    <option value="">{{ __('dashboard.all_forms') }}</option>
                    @foreach($forms as $form)
                        <option value="{{ $form->id }}" {{ request('form_id') == $form->id ? 'selected' : '' }}>{{ $form->title }}</option>
                    @endforeach
                </select>

        </div>

        @if(request('view') === 'table')
            @includeIf('dashboard.partials.submissions.table')
        @else
            @includeIf('dashboard.partials.submissions.cards')
        @endif

        <div class="flex justify-center mt-10 gap-2">
            {{ $submissions->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form filter change
            const formFilter = document.getElementById('form_filter');
            if (formFilter) {
                formFilter.addEventListener('change', function() {
                    // Get current URL
                    let url = new URL(window.location.href);

                    // Update or add form_id parameter
                    if (this.value) {
                        url.searchParams.set('form_id', this.value);
                    } else {
                        url.searchParams.delete('form_id');
                    }

                    // Preserve the current view parameter
                    const currentView = url.searchParams.get('view') || 'table';
                    url.searchParams.set('view', currentView);

                    // Navigate to the new URL
                    window.location.href = url.toString();
                });
            }

            // Existing code for view preference
            document.querySelectorAll('a[href*="view="]').forEach(link => {
                link.addEventListener('click', function(e) {
                    const viewType = this.href.includes('view=cards') ? 'cards' : 'table';
                    localStorage.setItem('submissions_view_preference', viewType);
                });
            });

            // Set default view if no URL parameter is provided
            if (!window.location.href.includes('view=')) {
                const savedView = localStorage.getItem('submissions_view_preference') || 'table';
                if (savedView && window.location.href.indexOf('?') === -1) {
                    window.location.href = "{{ route('submissions.index') }}?view=" + savedView;
                } else if (savedView && window.location.href.indexOf('view=') === -1) {
                    window.location.href = window.location.href + (window.location.href.indexOf('?') !== -1 ? '&' : '?') + 'view=' + savedView;
                }
            }
        });
    </script>
@endpush
