@extends('layouts.site')

@section('content')
    <div class="flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 p-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-red-500 p-6 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-white text-2xl font-bold">Payment Wrong!</h1>
            </div>

            <div class="p-6">
                <div class="mb-8 text-center">
                    <p class="text-gray-700 text-lg mb-2">Thank you for your payment</p>
                    <p class="text-gray-500">Your transaction has been completed successfully.</p>
                    <p class="text-gray-500">A confirmation email has been sent to your inbox.</p>
                </div>

                {{--            <div class="border-t border-gray-200 pt-6 space-y-4">--}}
                {{--                <div class="flex justify-between items-center">--}}
                {{--                    <span class="text-gray-600">Transaction ID:</span>--}}
                {{--                    <span class="font-medium">{{ $transaction_id ?? 'TXN-'.time() }}</span>--}}
                {{--                </div>--}}
                {{--                <div class="flex justify-between items-center">--}}
                {{--                    <span class="text-gray-600">Date:</span>--}}
                {{--                    <span class="font-medium">{{ date('F d, Y') }}</span>--}}
                {{--                </div>--}}
                {{--                <div class="flex justify-between items-center">--}}
                {{--                    <span class="text-gray-600">Amount:</span>--}}
                {{--                    <span class="font-semibold text-red-600">${{ $amount ?? '0.00' }}</span>--}}
                {{--                </div>--}}
                {{--            </div>--}}

                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-red-500 text-white font-medium rounded-lg shadow-md hover:bg-red-600 transition duration-200 ease-in-out transform hover:scale-105">
                        Return to Home
                    </a>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">
                        If you have any questions, please contact our support team.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Optional confetti effect on successful payment
        window.addEventListener('load', function() {
            // Simple animation to enhance the success feeling
            const checkmark = document.querySelector('svg');
            checkmark.classList.add('animate-pulse');
            setTimeout(() => {
                checkmark.classList.remove('animate-pulse');
            }, 2000);
        });
    </script>
@endsection
