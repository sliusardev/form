@extends('layouts.app')

@section('content')
    <div class="card bg-base-100 shadow-xl w-full">
        <div class="card-body">
            <div class="flex flex-row md:justify-between items-center mb-6">
                <h2 class="card-title text-center md:text-2xl font-semibold my-3">Your Forms</h2>
                <a href="{{ route('forms.create') }}" class="btn btn-primary">
                    {{__('dashboard.create')}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($forms as $form)
                    <div class="card bg-base-100 shadow-md hover:shadow-lg transition-shadow duration-200 border border-base-300">
                        <div class="card-body p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold">#{{ $form->id }}</h3>
                                <div class="badge {{ $form->is_enabled === true ? 'badge-success' : 'badge-neutral' }}">
                                    {{ $form->is_enabled ? ucfirst('Enabled') : ucfirst('Disabled') }}
                                </div>
                            </div>

                            <div class="divider my-1"></div>

                            <h3 class="text-xl font-semibold mb-2">
                                <a href="" class="hover:underline">{{ $form->title }}</a>
                            </h3>

                            <p class="text-sm opacity-70 mb-4">
                                {{$form->description ?: 'No description provided.'}}
                            </p>

                            <div class="flex justify-between items-center text-sm opacity-70">
                                <span>Submissions: {{$form->submissions_count}}</span>
                                <div class="flex gap-2">
                                    <a href="#" class="btn btn-sm btn-primary gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        {{__('dashboard.view')}}
                                    </a>
                                    <a href="{{route('forms.edit', $form)}}" class="btn btn-sm btn-outline gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                        {{__('dashboard.edit')}}
                                    </a>
                                </div>
                            </div>

                            <div class="divider my-2"></div>

                            <div class="flex items-start justify-between text-sm opacity-70">
                                <x-ui.copy-text :id="'form-url-' . $form->id" :text="$form->formUrl()" />
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
@endpush
