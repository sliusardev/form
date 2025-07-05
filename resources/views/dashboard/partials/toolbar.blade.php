<div class="flex items-center justify-between h-16 bg-white border-b-gray-600 px-4 py-4">
    <div class="flex items-center space-x-2">
        <button id="sidebarToggle" class="text-gray-500 focus:outline-none cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <div class="flex items-center space-x-4">
        <div class="relative">
            <button id="userToggle" class="flex items-center space-x-2 focus:outline-none">
                <img src="{{auth()->user()->getAvatar()}}" alt="avatar" class="rounded-full w-[35px]" />
                <span>{{auth()->user()->name}}</span>
                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="userMenu" class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg py-1 hidden">
                <a href="{{route('user.profile')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    {{__('dashboard.profile')}}
                </a>
                <hr class="my-1">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <i data-feather="log-out"></i><span>{{__('auth.logout')}}</span>
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('userToggle').addEventListener('click', () => {
            document.getElementById('userMenu').classList.toggle('hidden');
        });
    </script>
@endpush

