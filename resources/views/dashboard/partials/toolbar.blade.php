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
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="flex items-center space-x-2 cursor-pointer">
                    <img src="{{auth()->user()->getAvatar()}}" alt="avatar" class="rounded-full w-[35px]" />
                    <span>{{auth()->user()->name}}</span>
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a href="{{route('user.profile')}}">{{__('dashboard.profile')}}</a>
                    </li>
                    <li class="border-t mt-1 pt-1">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="log-out"></i>{{__('auth.logout')}}
                        </a>
                    </li>
                </ul>
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

