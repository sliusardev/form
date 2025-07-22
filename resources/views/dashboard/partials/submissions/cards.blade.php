<div class="max-w-full mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($submissions as $submission)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">#{{ $submission->id }}</h3>
                        <span class="px-2 py-1 text-xs rounded-full {{ $submission->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-700"><span class="font-medium">Form:</span> {{ $submission->form->title ?? 'Unknown Form' }}</p>
                        <p class="text-gray-700"><span class="font-medium">Date:</span> {{ $submission->created_at->format('Y-m-d H:i') }}</p>
                        <p class="text-gray-700"><span class="font-medium">Hash:</span> {{ $submission->hash }}</p>
                        <p class="text-gray-700"><span class="font-medium">Method:</span> {{ $submission->method }}</p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('submissions.show', $submission) }}" class="text-blue-500 hover:underline">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No submissions found
            </div>
        @endforelse
    </div>
</div><?php
