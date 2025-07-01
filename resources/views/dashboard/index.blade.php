@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold text-gray-800">{{ __('dashboard.welcome_dashboard') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-4">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-lg font-medium">{{ __('dashboard.forms_count') }}</h4>
            <p class="text-3xl">{{$formsCount}}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-lg font-medium">{{ __('dashboard.active_forms') }}</h4>
            <p class="text-3xl">{{$activeFormsCount}}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-lg font-medium">{{ __('dashboard.total_submissions') }}</h4>
            <p class="text-3xl">1,245</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <h4 class="text-lg font-medium">{{ __('dashboard.new_this_week') }}</h4>
            <p class="text-3xl">87</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow mt-6 p-6">
        <h5 class="text-xl font-medium mb-4">{{ __('dashboard.submission_trends') }}</h5>
        <canvas id="submissionChart" height="100"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('submissionChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: '{{ __('dashboard.submissions_label') }}',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        borderColor: 'rgba(59, 130, 246, 1)',
                        tension: 0.4,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endpush
