@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-base-100 p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">{{ $plan->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('billing-plans.edit', $plan) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('billing-plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plan?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Delete</button>
                </form>
                <a href="{{ route('billing-plans.index') }}" class="btn btn-outline">Back to Plans</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="card bg-base-200 p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Plan Details</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">Price:</span> ${{ number_format($plan->price, 2) }} / {{ $plan->billing_cycle }}</p>
                    <p><span class="font-medium">Status:</span>
                        <span class="badge {{ $plan->is_active ? 'badge-success' : 'badge-error' }}">
                            {{ $plan->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                    <p><span class="font-medium">Slug:</span> {{ $plan->slug }}</p>
                </div>
            </div>

            <div class="card bg-base-200 p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2">Description</h2>
                <p class="whitespace-pre-line">{{ $plan->description }}</p>
            </div>
        </div>

        <div class="card bg-base-200 p-4 rounded-lg">
            <h2 class="text-lg font-semibold mb-4">Features</h2>
            <ul class="list-disc list-inside space-y-1">
                @forelse($plan->features as $feature)
                    <li>{{ $feature }}</li>
                @empty
                    <li class="text-gray-500">No features listed</li>
                @endforelse
            </ul>
        </div>

        <div class="mt-6 text-sm text-gray-500">
            <p>Created: {{ $plan->created_at->format('F j, Y, g:i a') }}</p>
            <p>Last Updated: {{ $plan->updated_at->format('F j, Y, g:i a') }}</p>
        </div>
    </div>
@endsection
