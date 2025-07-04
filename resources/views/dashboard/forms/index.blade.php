@extends('layouts.app')

@section('content')

    <div class="max-w-full mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Your Forms</h2>
            <a href="{{ route('forms.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition flex gap-2 items-center uppercase">
                {{__('dashboard.create')}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($forms as $form)
                <div class="bg-white rounded-lg shadow p-5">
                    <div class="border-b-gray-600">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">
                            <a href="" class="hover:underline">{{ $form->title }}</a>
                        </h3>
                    </div>


                    <p class="text-gray-600 text-sm mb-4">
                        {{$form->description ?: 'No description provided.'}}
                    </p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>Submissions: {{$form->submissions_count}}</span>
                        <div class="flex gap-2">
                            <a href="#" class="px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200 flex items-center gap-1 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                {{__('dashboard.view')}}
                            </a>
                            <a href="{{route('forms.edit', $form)}}" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors duration-200 flex items-center gap-1 text-sm font-medium border border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                {{__('dashboard.edit')}}
                            </a>
                        </div>

                    </div>
                    <hr class="my-3">
                    <div class="flex items-start justify-between text-sm text-gray-500">
                        {{__('dashboard.url')}}:
                        <x-ui.copy-text :id="'form-url-' . $form->id" :text="$form->formUrl()" />
                    </div>
                </div>
            @endforeach

            @if($forms->isEmpty())
                <div class="col-span-full flex justify-center items-center p-10">
                    <h2 class="text-2xl text-center">Create your first form</h2>
                </div>
                <div class="col-span-full flex justify-center mt-4">
                    <a href="{{ route('forms.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition flex gap-2 items-center uppercase">
                        {{__('dashboard.create')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                    </a>
                </div>
            @endif

        </div>

        <div class="flex justify-center mt-10 gap-2">
            {{ $forms->appends(request()->query())->links() }}
        </div>
    </div>
@endsection

@push('scripts')
{{--    <script>--}}
{{--        function copyToClipboard(elementId) {--}}
{{--            const text = document.getElementById(elementId).innerText;--}}
{{--            navigator.clipboard.writeText(text)--}}
{{--                .then(() => {--}}
{{--                    const formId = elementId.split('-').pop();--}}
{{--                    const tooltip = document.getElementById(`tooltip-${formId}`);--}}
{{--                    tooltip.classList.add('opacity-100');--}}
{{--                    setTimeout(() => {--}}
{{--                        tooltip.classList.remove('opacity-100');--}}
{{--                    }, 2000);--}}
{{--                })--}}
{{--                .catch(err => {--}}
{{--                    console.error('Failed to copy: ', err);--}}
{{--                });--}}
{{--        }--}}
{{--    </script>--}}
@endpush
