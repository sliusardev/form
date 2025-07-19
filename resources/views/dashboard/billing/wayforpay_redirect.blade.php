@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen">
        <h2 class="text-2xl font-semibold mb-4">Redirecting to WayForPay...</h2>
        <form id="wayforpayForm" action="{{ $wayforpayUrl }}" method="POST">
            @foreach($paymentData as $key => $value)
                @if(is_array($value))
                    @foreach($value as $i => $v)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
        </form>
        <p class="text-gray-600">Please wait, you are being redirected to the payment page...</p>
    </div>
    <script>
        document.getElementById('wayforpayForm').submit();
    </script>
@endsection

