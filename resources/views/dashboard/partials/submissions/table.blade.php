<div class="max-w-full mx-auto">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-200 border-b">
            <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-600">ID</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">Method</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">Form</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">Date</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">Status</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">Hash</th>
                <th class="px-6 py-3 text-left font-medium text-gray-600">Actions</th>
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
                    </td>                    <td class="px-6 py-4 text-gray-800">
                        <a href="{{ route('submissions.show', $submission) }}" class="text-gray-800 hover:underline">
                            {{ $submission->form->title ?? 'Unknown Form' }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $submission->hash }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('submissions.show', $submission) }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <span>View</span>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No submissions found</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
