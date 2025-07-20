@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Billing</h2>

        <form action="{{ route('way-for-pay.pay') }}" method="POST" class="space-y-6">
            @csrf

            <div class="gap-4 grid grid-cols-1">
                <div class="billing-item flex items-center gap-3 border-b border-gray-100 pb-4">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.submission_limit')}} | Current {{$company->submission_limit }}</label>
                        <input type="number" value="1000" step="0" min="0" name="submission_limit" id="submission_limit"  class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                        <small class="text-blue-500">One submission costs {{$submissionOne}} {{$currency}}</small>
                    </div>

                </div>
                <div class="billing-item flex items-center gap-3 border-b border-gray-100 pb-4">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.form_limit')}}  | Current {{$company->form_limit }}</label>
                        <input type="number" value="10" step="0" min="0" name="form_limit" id="form_limit" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                        <small class="text-blue-500">One form costs {{$formOne}} {{$currency}}</small>
                    </div>

                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Total Cost. Min {{$minPayment}} {{$currency}}</label>
                <input type="text" id="total_cost" value="0" readonly class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                <small class="text-green-800">Minimum {{$minPayment}} {{$currency}}</small>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Pay</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submissionLimitInput = document.getElementById('submission_limit');
        const formLimitInput = document.getElementById('form_limit');
        const submissionOne = {{ $submissionOne }};
        const formOne = {{ $formOne }};
        const currency = "{{ $currency }}";

        updateSubmissionCost()
        updateFormCost()
        updateTotalCost();

        function updateFormCost() {
            const value = parseInt(formLimitInput.value, 10);
            if (!isNaN(value)) {
                const cost = value * formOne;
                formLimitInput.nextElementSibling.textContent = `Cost: ${cost} ${currency}`;
            }
        }

        function updateSubmissionCost() {
            const value = parseInt(submissionLimitInput.value, 10);
            if (!isNaN(value)) {
                const cost = value * submissionOne;
                submissionLimitInput.nextElementSibling.textContent = `Cost: ${cost} ${currency}`;
            }
        }

        function updateTotalCost() {
            const submissionLimit = parseInt(submissionLimitInput.value, 10) || 0;
            const formLimit = parseInt(formLimitInput.value, 10) || 0;
            const totalCost = (submissionLimit * submissionOne) + (formLimit * formOne);
            document.getElementById('total_cost').value = totalCost + ' ' + currency;
        }

        submissionLimitInput.addEventListener('input', updateSubmissionCost);
        formLimitInput.addEventListener('input', updateFormCost);

        submissionLimitInput.addEventListener('input', updateTotalCost);
        formLimitInput.addEventListener('input', updateTotalCost);

    });
</script>
@endpush
