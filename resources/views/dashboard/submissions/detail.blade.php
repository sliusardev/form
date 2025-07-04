@extends('layouts.app')

                            @section('content')
                                <div class="max-w-full mx-auto">
                                    <div class="mb-6 flex flex-wrap justify-center lg:justify-between items-center">
                                        <h2 class="text-3xl font-semibold text-gray-800">Submission Details</h2>
                                        <a href="{{ route('submissions.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-gray-700 hover:bg-gray-300">
                                            ← Back to Submissions
                                        </a>
                                    </div>

                                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                                            <div>
                                                <p class="text-sm text-gray-600">Submission ID</p>
                                                <p class="font-medium">#{{ $submission->id }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Form</p>
                                                <p class="font-medium">{{ $submission->form->title }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Submitted Date</p>
                                                <p class="font-medium">{{ $submission->created_at->format('M d, Y H:i') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">IP Address</p>
                                                <p class="font-medium">{{ $submission->ip_address }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500">Status</p>
                                                <p class="font-medium">
                                                    <span class="px-2 py-1 text-xs rounded-full {{ $submission->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ ucfirst($submission->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Form Data</h3>

                                        <div class="mb-4">
                                            <div class="border-b flex">
                                                <button id="tab-formatted" class="py-2 px-4 font-medium border-b-2 border-blue-500 text-blue-600 active-tab">Formatted</button>
                                                <button id="tab-json" class="py-2 px-4 font-medium text-gray-500 hover:text-gray-700">JSON</button>
                                            </div>
                                        </div>

                                        <div id="formatted-view" class="space-y-4">
                                            @foreach($submission->payload as $key => $value)
                                                @if(!is_array($value))
                                                    <div class="grid grid-cols-3 gap-4 border-b pb-2">
                                                        <div class="col-span-1 text-gray-600 font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                                        <div class="col-span-2">{{ $value }}</div>
                                                    </div>
                                                @else
                                                    <div class="grid grid-cols-3 gap-4 border-b pb-2">
                                                        <div class="col-span-1 text-gray-600 font-medium">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                                        <div class="col-span-2">
                                                            <pre class="text-sm bg-gray-50 p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div id="json-view" class="hidden">
                                            <div id="json-editor" class="border rounded-md" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                </div>
                            @endsection

                            @push('scripts')
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.4/ace.js"></script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Tab switching
                                    const formattedTab = document.getElementById('tab-formatted');
                                    const jsonTab = document.getElementById('tab-json');
                                    const formattedView = document.getElementById('formatted-view');
                                    const jsonView = document.getElementById('json-view');

                                    formattedTab.addEventListener('click', function() {
                                        formattedView.classList.remove('hidden');
                                        jsonView.classList.add('hidden');
                                        formattedTab.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');
                                        formattedTab.classList.remove('text-gray-500');
                                        jsonTab.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600');
                                        jsonTab.classList.add('text-gray-500');
                                    });

                                    jsonTab.addEventListener('click', function() {
                                        formattedView.classList.add('hidden');
                                        jsonView.classList.remove('hidden');
                                        jsonTab.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');
                                        jsonTab.classList.remove('text-gray-500');
                                        formattedTab.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600');
                                        formattedTab.classList.add('text-gray-500');

                                        // Initialize Ace editor if not already done
                                        if (!window.jsonEditor) {
                                            const editor = ace.edit("json-editor");
                                            editor.setTheme("ace/theme/monokai");
                                            editor.session.setMode("ace/mode/json");
                                            editor.setValue(JSON.stringify({!! json_encode($submission->payload) !!}, null, 4));
                                            editor.setReadOnly(true);
                                            window.jsonEditor = editor;
                                        }
                                    });
                                });
                            </script>
                            @endpush
