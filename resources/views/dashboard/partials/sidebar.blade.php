<div id="sidebar" class="w-64 bg-gray-800 text-white flex-col p-4 hidden absolute xl:relative xl:flex z-30 h-full ">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold">FormPost</h4>
        <button id="sidebarCollapse" class="text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <hr class="border-gray-600 mb-4">
    <nav class="space-y-2">
        <a href="{{route('dashboard')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
            {{__('dashboard.dashboard')}}
        </a>
        <a href="{{route('submissions.index')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
            {{__('dashboard.submissions')}}
        </a>
        <a href="{{route('forms.index')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
            {{__('dashboard.forms')}}
        </a>
        <a href="{{route('integrations.index')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
            {{__('dashboard.integrations')}}
        </a>
        <a href="{{route('company.index')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">
            {{__('dashboard.company')}}
        </a>
    </nav>


    @if(auth()->user()->isAdmin())
        <hr class="border-gray-600 my-4">

        <nav class="space-y-2">
{{--            <a href="{{route('billing-plans.index')}}" class="block px-4 py-2 hover:bg-gray-700 rounded">--}}
{{--                {{__('dashboard.billing_plans')}}--}}
{{--            </a>--}}
        </nav>
    @endif

</div>


@push('scripts')
@endpush
