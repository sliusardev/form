<div id="sidebar" class="w-64 bg-gray-800 text-white flex-col p-4 sm:hidden md:flex z-30 h-full">
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold">FormPost</h4>
        <button id="sidebarCollapse" class="text-white focus:outline-none lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
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
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const toggleSidebarBtn = document.getElementById('sidebarCollapse');

            function toggleSidebar() {
                sidebar.classList.remove('md:flex');
                sidebar.classList.remove('flex-col');
                sidebar.classList.remove('xs:hidden');
                sidebar.classList.toggle('hidden');
            }

            function sidebarCollapse() {
                toggleSidebar();
                toggleBtn.classList.toggle('hidden');
            }

            toggleBtn.addEventListener('click', toggleSidebar);
            toggleSidebarBtn.addEventListener('click', toggleSidebar);
        });
    </script>
@endpush
