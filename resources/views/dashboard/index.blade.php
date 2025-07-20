@extends('layouts.app')

@push('head')

@endpush

@section('content')
    <h2 class="text-center md:text-2xl font-semibold text-gray-800">{{ __('dashboard.welcome_dashboard') }}</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-sm md:text-lg font-medium">{{ __('dashboard.forms_count') }}</h4>
            <p class="text-2xl">{{$formsCount}}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-sm md:text-lg font-medium">{{ __('dashboard.active_forms') }}</h4>
            <p class="text-2xl">{{$activeFormsCount}}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-sm md:text-lg font-medium">{{ __('dashboard.total_submissions') }}</h4>
            <p class="text-2xl">{{$submissionsCount}}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-sm md:text-lg font-medium">{{ __('dashboard.new_this_week') }}</h4>
            <p class="text-2xl">{{$submissionsThisWeekCount}}</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow mt-6 p-6">
        <h5 class="text-xl font-medium mb-4">{{ __('dashboard.submission_trends') }}</h5>
        <canvas id="submissionChart" height="100"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        window.submissionChartLabels = @json($labels ?? []);
        window.submissionChartCounts = @json($counts ?? []);
    </script>
@endpush
