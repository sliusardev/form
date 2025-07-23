@foreach($submission->formated() as $key => $value)
    @if(!is_array($value))
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-2 border-b border-gray-100">
            <div class="col-span-1 text-gray-700 font-medium md:border-r border-gray-100 bg-gray-50 overflow-x-auto break-words whitespace-normal">
                {{ ucwords(str_replace('_', ' ', $key)) }}
            </div>
            <div class="col-span-2 max-w-full overflow-x-auto break-words whitespace-normal">
                {{ $value }}
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-2">
            <div class="col-span-1 text-gray-600 font-medium">
                {{ ucwords(str_replace('_', ' ', $key)) }}
            </div>
            <div class="col-span-2">
                <pre class="text-sm bg-gray-50 p-2 rounded overflow-x-auto">
                    {{ json_encode($value, JSON_PRETTY_PRINT) }}
                </pre>
            </div>
        </div>
    @endif
@endforeach
