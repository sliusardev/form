@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Checkout</h1>

        <div class="mb-8 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-xl font-semibold mb-2">Subscription Details</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Plan:</p>
                    <p class="font-medium">{{ $plan->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Billing Cycle:</p>
                    <p class="font-medium">{{ ucfirst($plan->billing_cycle) }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Price:</p>
                    <p class="font-medium">{{ number_format($plan->price, 2) }} UAH</p>
                </div>
                <div>
                    <p class="text-gray-600">Auto-renew:</p>
                    <p class="font-medium">{{ $subscription->auto_renew ? 'Yes' : 'No' }}</p>
                </div>
            </div>

            <div class="mt-4">
                <p class="text-gray-600">Description:</p>
                <p>{{ $plan->description }}</p>
            </div>

            <div class="mt-4">
                <p class="text-gray-600">Features:</p>
                <ul class="list-disc pl-5 mt-2">
                    @foreach($plan->features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg mb-6">
            <p class="text-sm text-blue-700">
                <i class="fas fa-info-circle mr-2"></i>
                Your subscription will be active immediately after payment and will remain active until
                {{ $subscription->current_period_ends_at->format('F j, Y') }}.
            </p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
            <div class="flex justify-center">
                <form method="POST" action="https://www.liqpay.ua/api/3/checkout" accept-charset="utf-8">
                    <input type="hidden" name="data" value="{{ $data }}" />
                    <input type="hidden" name="signature" value="{{ $signature }}" />
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Pay {{ number_format($plan->price, 2) }} UAH
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center text-gray-500 text-sm mt-8">
            <p>Secure payment processing by LiqPay</p>
            <div class="mt-2">
                <img src="{{ asset('images/liqpay-logo.png') }}" alt="LiqPay" class="h-6 inline-block">
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://static.liqpay.ua/libjs/checkout.js"></script>
@endpush
