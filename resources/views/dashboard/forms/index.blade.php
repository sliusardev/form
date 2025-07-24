@extends('layouts.app')

@section('content')
    <div class="card bg-base-100 shadow-xl w-full">
        <div class="card-body">
            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <h2 class="card-title text-center md:text-2xl font-semibold my-3">{{ __('dashboard.your_forms') }}</h2>
                <a href="{{ route('forms.create') }}" class="btn bg-gray-700 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">
                    {{__('dashboard.create')}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                @foreach($forms as $form)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                        <div class="p-6 block">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">#{{ $form->id }}</h3>
                                @if($form->is_enabled)
                                    <span class="px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800">{{ __('dashboard.enabled_status') }}</span>
                                @else
                                    <span class="px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">{{ __('dashboard.disabled_status') }}</span>
                                @endif
                            </div>
                            <div class="space-y-2">
                                <p class="text-gray-700"><span class="font-medium">{{ __('dashboard.form_label') }}:</span> {{ $form->title ?? __('dashboard.unknown_form') }}</p>
                                <p class="text-gray-700">
                                    {{$form->description ?: __('dashboard.no_description_provided')}}
                                </p>
                                <p class="text-black-700"> {{ __('dashboard.submissions') }}: {{$form->submissions_count}}</p>
                                <div class="flex justify-between items-center text-sm opacity-70 border-t border-gray-100  py-2">
                                    <p class="text-black-700"> {{ $form->created_at->format('Y-m-d') }}</p>
                                    <div class="flex gap-2">
                                        <button onclick="copyToClipboard('{{ $form->formUrl() }}', this)" class="btn btn-sm btn-outline bt-info gap-1" title="{{__('dashboard.copy_url')}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                                        </button>
                                        <a href="{{ route('submissions.index', ['form_id' => $form->id]) }}" class="btn btn-sm btn-outline bg-gray-800 text-white gap-1" title="{{__('dashboard.view')}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        <a href="{{route('forms.edit', $form)}}" class="btn btn-sm btn-outline btn-soft gap-1" title="{{__('dashboard.edit')}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if($forms->isEmpty())
                    <div class="col-span-full flex justify-center items-center p-10">
                        <div class="alert">
                            <h2 class="text-2xl text-center">
                                {{__('dashboard.create_your_first_form')}}
                            </h2>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex justify-center mt-10 gap-2">
                {{ $forms->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(function () {
                const originalContent = button.innerHTML;
                const checkIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>`;
                button.innerHTML = checkIcon;
                button.disabled = true;
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    button.disabled = false;
                }, 2000);
            }, function (err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endpush
