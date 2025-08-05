@extends('layouts.app')

@section('content')
    <div class="card bg-base-100 shadow-xl w-full">
        <div class="card-body">
            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <h2 class="card-title text-center md:text-2xl font-semibold my-3">{{ __('dashboard.users') }}</h2>
                <a href="#" class="btn bg-gray-800 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">
                    {{__('dashboard.create')}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-plus"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                </a>
            </div>

            <div class="data-list">
                <div class="mb-4 flex justify-end">
                    <form action="{{ route('users.index') }}" method="GET" class="join">
                        <input type="text" name="search" placeholder="{{ __('dashboard.search_by_name_or_email') }}" value="{{ request('search') }}" class="input input-bordered join-item w-full max-w-xs input-sm">
                        <button class="join-item btn btn-sm bg-gray-800 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">{{ __('dashboard.search') }}</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="inline-flex items-center gap-1">
                                        {{ __('dashboard.id') }}
                                        @if(request('sort') === 'id')
                                            @if(request('direction', 'asc') === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th>{{ __('dashboard.name') }}</th>
                                <th>{{ __('dashboard.email') }}</th>
                                <th>{{ __('dashboard.roles') }}</th>
                                <th>{{ __('dashboard.company') }}</th>
                                <th>{{ __('dashboard.forms_count') }}</th>
                                <th>{{ __('dashboard.created_at') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover">
                                    <th>{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->getRolesNames() }}</td>
                                    <td>{{ $user->company->name }}</td>
                                    <td>{{ $user->companyForms->count() }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="text-right">
                                        <button class="btn btn-sm btn-neutral bg-gray-800" popovertarget="user-{{ $user->id }}" style="anchor-name:--user-{{ $user->id }}">
                                            Actions
                                        </button>
                                        <ul class="dropdown menu w-52 rounded-box bg-base-100 shadow-sm"
                                            popover id="user-{{ $user->id }}" style="position-anchor:--user-{{ $user->id }}">
                                            <li>
                                                <a href="#" class="">{{ __('dashboard.edit') }}</a>
                                            </li>
                                            <li>
                                                <a href="#" class="">{{ __('dashboard.delete') }}</a>
                                            </li>
                                            <li>
                                                <form action="{{route('users.login-as')}}" method="post" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" class="">{{ __('dashboard.login') }}</button>
                                                </form>

                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('dashboard.no_users_found') }}</td>
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
