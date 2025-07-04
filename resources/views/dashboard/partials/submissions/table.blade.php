<div class="max-w-full mx-auto">
    @if(!isset($hideTitle) || !$hideTitle)
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Form Submissions</h2>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-600">ID</th>
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
                    <td class="px-6 py-4 text-gray-800">{{ $submission->form->title ?? 'Unknown Form' }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $submission->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($submission->status) }}
                            </span>
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $submission->hash }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('submissions.show', $submission) }}" class="text-blue-500 hover:underline">View</a>
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
