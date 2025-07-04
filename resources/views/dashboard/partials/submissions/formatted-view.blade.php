@foreach($submission->payload as $key => $value)
    @if(!is_array($value))
        <div class="grid grid-cols-3 gap-4 border-b-yellow-500 pb-2">
            <div class="col-span-1 text-gray-600 font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
            <div class="col-span-2">{{ $value }}</div>
        </div>
    @else
        <div class="grid grid-cols-3 gap-4 border-b-yellow-500 pb-2">
            <div class="col-span-1 text-gray-600 font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
            <div class="col-span-2">
                <pre class="text-sm bg-gray-50 p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
    @endif
@endforeach

