@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto bg-white p-4 rounded-lg shadow-md">

        <div class="flex flex-wrap items-center justify-center lg:justify-between mb-6 gap-3">
            <h2 class="text-3xl font-semibold text-gray-800">My Subscriptions</h2>
        </div>


        @if($subscription)

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">{{ $subscription->billingPlan->name }}</h2>
                <span class="px-3 py-1 rounded-full {{ $subscription->isActive() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $subscription->isActive() ? 'Active' : 'Inactive' }}
            </span>
            </div>

            <div class="mb-4">
                <p class="text-gray-600">Billing cycle: {{ ucfirst($subscription->billingPlan->billing_cycle) }}</p>
                <p class="text-gray-600">Price: {{ $subscription->billingPlan->price }} UAH</p>
            </div>

            <div class="mb-6">
                <p class="text-gray-600">Current period ends: {{ $subscription->current_period_ends_at->format('M d, Y') }}</p>
                <p class="text-gray-600">Auto-renew: {{ $subscription->auto_renew ? 'Yes' : 'No' }}</p>
            </div>

            @if($subscription->isActive() && $subscription->auto_renew)
                <form action="{{ route('subscription.cancel') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Cancel Subscription
                    </button>
                </form>
            @elseif($subscription->isActive() && !$subscription->auto_renew)
                <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded">
                    Your subscription will end on {{ $subscription->expires_at->format('M d, Y') }}. You won't be charged again.
                </div>
            @else
                <a href="{{ route('billing-plans.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Subscribe to a Plan
                </a>
            @endif

        @else

            <p class="text-gray-600 mb-4">You don't have an active subscription.</p>
            <a href="{{ route('billing-plans.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                View Available Plans
            </a>

        @endif

    </div>


@endsection

@push('scripts')
@endpush

