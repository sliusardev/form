@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto bg-white p-4 rounded-lg shadow-md">

        <div class="flex flex-wrap items-center justify-between mb-6 gap-3">
            <h2 class="text-3xl font-semibold text-gray-800">Billing Plans</h2>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('billing-plans.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition flex gap-2 items-center uppercase text-center">
                    {{__('Create Plan')}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                </a>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
            <div class="bg-white rounded-lg shadow-md p-6 relative">
                <div class="absolute top-2 right-2 flex space-x-2">
                    <a href="{{ route('billing-plans.edit', $plan) }}" class="text-blue-500 hover:text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    </a>
                    <form action="{{ route('billing-plans.destroy', $plan) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this plan?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </button>
                    </form>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $plan->name }}</h3>
                <div class="text-3xl font-bold mb-4">{{ $plan->price }} UAH</div>
                <div class="text-gray-500 mb-4">
                    {{ $plan->billing_cycle === 'monthly' ? 'per month' : 'per year' }}
                </div>
                <p class="mb-4">{{ $plan->description }}</p>
                <ul class="mb-6">
                    @foreach($plan->features as $feature)
                    <li class="flex items-center mb-2">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('subscribe', $plan) }}" class="block w-full text-center bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Subscribe Now
                </a>
            </div>
            @endforeach
        </div>

    </div>
@endsection

@push('scripts')
@endpush
