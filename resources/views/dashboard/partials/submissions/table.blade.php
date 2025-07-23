<div class="max-w-full mx-auto">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-200 border-b">
            <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-600">{{ __('dashboard.id') }}</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">{{ __('dashboard.method') }}</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">{{ __('dashboard.form') }}</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">{{ __('dashboard.date') }}</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">{{ __('dashboard.hash') }}</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($submissions as $submission)
                <tr>
                    <td class="px-6 py-4 text-gray-800">#{{ $submission->id }}</td>
                    <td class="px-6 py-4">
                        @if(strtoupper($submission->method) === 'POST')
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $submission->method }}</span>
                        @elseif(strtoupper($submission->method) === 'GET')
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $submission->method }}</span>
                        @else
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $submission->method }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800">
                        <a href="{{ route('submissions.show', $submission) }}" class="text-gray-800 hover:underline">
                            {{ $submission->form->title ?? __('dashboard.unknown_form') }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $submission->hash }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">{{ __('dashboard.no_submissions_yet') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
