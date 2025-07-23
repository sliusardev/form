<div class="max-w-full mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 gap-6">
        @forelse($submissions as $submission)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <a href="{{ route('submissions.show', $submission) }}" class="p-6 block">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">#{{ $submission->id }}</h3>
                        @if(strtoupper($submission->method) === 'POST')
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $submission->method }}</span>
                        @elseif(strtoupper($submission->method) === 'GET')
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $submission->method }}</span>
                        @else
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $submission->method }}</span>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-700"><span class="font-medium">Form:</span> {{ $submission->form->title ?? 'Unknown Form' }}</p>
                        <p class="text-gray-700"><span class="font-medium">Hash:</span> {{ $submission->hash }}</p>
                        <p class="text-black-700 border-t border-gray-100 pt-2"> {{ $submission->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No submissions found
            </div>
        @endforelse
    </div>
</div><?php
