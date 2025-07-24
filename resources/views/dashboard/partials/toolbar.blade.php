<div class="flex items-center justify-between h-16 bg-white border-b-gray-600 px-4 py-4">
    <div class="flex items-center space-x-2">
        <button id="sidebarToggle" class="text-gray-500 focus:outline-none cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    <div class="flex items-center space-x-4">
        <div class="relative" id="user-menu">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 rounded-lg px-3 py-2 transition-colors duration-200">
                    <img src="{{auth()->user()->getAvatar()}}" alt="avatar" class="rounded-full w-[35px] h-[35px] border-2 border-gray-200" />
                    <span class="font-medium text-gray-700">{{auth()->user()->name}}</span>
                    <svg class="ml-1 w-4 h-4 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </label>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-lg bg-white rounded-lg w-56 border border-gray-100">
                    <li>
                        <a href="{{route('user.profile')}}" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-50 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-gray-700">{{__('dashboard.profile')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('company.show')}}" class="flex items-center space-x-3 px-3 py-2 hover:bg-gray-50 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-gray-700">{{__('dashboard.company')}}</span>
                        </a>
                    </li>
                    <li class="border-t border-gray-100 mt-2 pt-2">
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center space-x-3 px-3 py-2 hover:bg-red-50 rounded-md transition-colors duration-150 text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>{{__('auth.logout')}}</span>
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

