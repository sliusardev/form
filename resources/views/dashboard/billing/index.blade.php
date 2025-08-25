@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">{{ __('dashboard.billing') }}</h2>

        <form action="{{ route('way-for-pay.pay') }}" method="POST" class="space-y-6">
            @csrf

            <div class="gap-4 grid grid-cols-1">
                <div class="billing-item flex items-center gap-3 border-b border-gray-100 pb-4">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.submission_limit')}}</label>
                        <input type="number" value="1000" step="0" min="0" name="submission_limit" id="submission_limit"  class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                        <small class="text-blue-500">{{ __('dashboard.one_submission_cost', ['cost' => $submissionOne, 'currency' => $currency]) }}</small>
                    </div>

                </div>
                <div class="billing-item flex items-center gap-3 border-b border-gray-100 pb-4">
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.form_limit')}}</label>
                        <input type="number" value="10" step="0" min="0" name="form_limit" id="form_limit" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                        <small class="text-blue-500">{{ __('dashboard.one_form_cost', ['cost' => $formOne, 'currency' => $currency]) }}</small>
                    </div>

                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('dashboard.min_total_cost', ['min' => $minPayment, 'currency' => $currency]) }}</label>
                <input type="text" id="total_cost" value="0" readonly class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"/>
                <small class="text-green-800">{{ __('dashboard.min_payment_note', ['min' => $minPayment, 'currency' => $currency]) }}</small>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn bg-blue-900 text-white hover:bg-blue-700 transition-colors flex items-center gap-2">{{ __('dashboard.pay') }} (WayForPay)</button>
                <button type="submit" formaction="{{ route('monobank.pay') }}" class="btn bg-gray-700 text-white hover:bg-gray-600 transition-colors flex items-center gap-2">{{ __('dashboard.pay') }} online</button>
            </div>
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
        const costLabel = "{{ __('dashboard.cost') }}";

        updateSubmissionCost()
        updateFormCost()
        updateTotalCost();

        function updateFormCost() {
            const value = parseInt(formLimitInput.value, 10);
            if (!isNaN(value)) {
                const cost = value * formOne;
                formLimitInput.nextElementSibling.textContent = `${costLabel}: ${cost} ${currency}`;
            }
        }

        function updateSubmissionCost() {
            const value = parseInt(submissionLimitInput.value, 10);
            if (!isNaN(value)) {
                const cost = value * submissionOne;
                submissionLimitInput.nextElementSibling.textContent = `${costLabel}: ${cost} ${currency}`;
            }
        }

        function updateTotalCost() {
            const submissionLimit = parseFloat(submissionLimitInput.value) || 0;
            const formLimit = parseFloat(formLimitInput.value) || 0;
            const totalCost = (submissionLimit * submissionOne) + (formLimit * formOne);
            document.getElementById('total_cost').value = totalCost.toFixed(2) + ' ' + currency;
        }

        submissionLimitInput.addEventListener('input', updateSubmissionCost);
        formLimitInput.addEventListener('input', updateFormCost);

        submissionLimitInput.addEventListener('input', updateTotalCost);
        formLimitInput.addEventListener('input', updateTotalCost);

    });
</script>
@endpush
