@extends('layouts.app')

@section('content')
    <div class="card bg-base-100 shadow-xl w-full">
        <div class="card-body">
            <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                <h2 class="card-title text-center md:text-2xl font-semibold my-3">{{ __('dashboard.payments') }}</h2>
            </div>

            <div class="data-list">
                <div class="mb-4 flex justify-end">
                    <form action="{{ route('payments.index') }}" method="GET" class="join">
                        <input type="text" name="search" placeholder="{{ __('dashboard.search') }}" value="{{ request('search') }}" class="input input-sm input-bordered join-item w-full max-w-xs ">
                        <button class="join-item btn btn-sm bg-gray-800 text-white hover:bg-gray-500 transition-colors flex items-center gap-2">{{ __('dashboard.search') }}</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                        <tr>
                            <th>
                                <a href="{{ route('payments.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}" class="inline-flex items-center gap-1">
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
                            <th>{{ __('dashboard.user') }}</th>
                            <th>{{ __('dashboard.company') }}</th>
                            <th>{{ __('dashboard.status') }}</th>
                            <th>{{ __('dashboard.provider') }}</th>
                            <th>{{ __('dashboard.amount') }}</th>
                            <th>{{ __('dashboard.currency') }}</th>
                            <th>{{ __('dashboard.payment_id') }}</th>
                            <th>{{ __('dashboard.created_at') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($payments as $item)
                            <tr class="hover">
                                <th>{{ $item->id }}</th>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->provider }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->currency }}</td>
                                <td>{{ $item->payment_id }}</td>
                                <td>{{ $item->created_at->format('Y-m-d H:m:s') }}</td>
                                <td>
                                    <div class="flex justify-end gap-2">
                                        <div>
                                            <button class="btn btn-ghost btn-xs" onclick="payload{{ $item->id }}.showModal()" id="modal-payload-{{ $item->id }}">
                                                {{ __('dashboard.payload') }}
                                            </button>
                                            <dialog id="payload{{ $item->id }}" class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box">
                                                    <form method="dialog">
                                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                    </form>
                                                    <h3 class="text-lg font-bold">{{ $item->payment_id }}</h3>
                                                    <div class="py-4 code">
                                                        <pre><code>{{ $item->getPayloadJson() }}</code></pre>
                                                    </div>
                                                </div>
                                            </dialog>
                                        </div>

                                        <div>
                                            <button class="btn btn-ghost btn-xs" onclick="order{{ $item->id }}.showModal()" id="modal-order-{{ $item->id }}">
                                                {{ __('dashboard.order') }}
                                            </button>
                                            <dialog id="order{{ $item->id }}" class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box">
                                                    <form method="dialog">
                                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                    </form>
                                                    <h3 class="text-lg font-bold">{{ $item->payment_id }}</h3>

                                                    <div class="py-4 code">
                                                        @foreach($item->order as $key => $value)
                                                            <div class="mb-2">
                                                                <span class="font-semibold">{{ $key }}:</span>
                                                                <span>{{ is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </dialog>
                                        </div>

{{--                                        <a href="#" class="btn btn-ghost btn-xs text-error">{{ __('dashboard.delete') }}</a>--}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5" class="text-center">{{ __('dashboard.no_payments_found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-center mt-10 gap-2">
                {{ $payments->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
