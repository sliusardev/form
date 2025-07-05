@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto">
        <div class="flex flex-wrap justify-center lg:justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Form Submissions</h2>
            <div class="flex space-x-2">
                <a href="{{ route('submissions.index', ['view' => 'table']) }}" class="px-4 py-2 rounded-md {{ request('view', 'table') === 'table' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M3 18h18M3 6h18" />
                    </svg>
                    <span class="ml-1">Table</span>
                </a>
                <a href="{{ route('submissions.index', ['view' => 'cards']) }}" class="px-4 py-2 rounded-md {{ request('view') === 'cards' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="ml-1">Cards</span>
                </a>
            </div>
        </div>

        @if(request('view') === 'cards')
            @includeIf('dashboard.partials.submissions.cards')
        @else
            @includeIf('dashboard.partials.submissions.table', ['hideTitle' => true])
        @endif

        <div class="flex justify-center mt-10 gap-2">
            {{ $submissions->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Save preference when clicking on view buttons
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
