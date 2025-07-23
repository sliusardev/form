@extends('layouts.app')

@section('content')
    <div class="card bg-base-100 shadow-xl w-full">
        <div class="card-body">
            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <h2 class="card-title text-center md:text-2xl font-semibold my-3">Users</h2>
                <a href="#" class="btn btn-primary">
                    {{__('dashboard.create')}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                </a>
            </div>

            <div class="data-list">
                <div class="mb-4">
                    <form action="{{ route('users.index') }}" method="GET" class="join">
                        <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}" class="input input-bordered join-item w-full max-w-xs">
                        <button class="btn btn-primary join-item">Search</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="inline-flex items-center gap-1">
                                        ID
                                        @if(request('sort') === 'id')
                                            @if(request('direction', 'asc') === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover">
                                    <th>{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <a href="#" class="btn btn-ghost btn-xs">Edit</a>
                                            <a href="#" class="btn btn-ghost btn-xs text-error">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-center mt-10 gap-2">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
