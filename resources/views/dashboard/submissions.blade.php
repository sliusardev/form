@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Form Submissions</h2>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">ID</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Form Name</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Submitted By</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Date</th>
                    <th class="px-6 py-3 text-left font-medium text-gray-600">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 text-gray-800">#1234</td>
                    <td class="px-6 py-4 text-gray-800">Contact Form</td>
                    <td class="px-6 py-4 text-gray-800">john@example.com</td>
                    <td class="px-6 py-4 text-gray-800">2025-06-25</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 text-gray-800">#1233</td>
                    <td class="px-6 py-4 text-gray-800">Survey Form</td>
                    <td class="px-6 py-4 text-gray-800">anna@example.com</td>
                    <td class="px-6 py-4 text-gray-800">2025-06-24</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 text-gray-800">#1232</td>
                    <td class="px-6 py-4 text-gray-800">Newsletter Signup</td>
                    <td class="px-6 py-4 text-gray-800">peter@example.com</td>
                    <td class="px-6 py-4 text-gray-800">2025-06-22</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-center mt-10">
            <nav class="inline-flex -space-x-px rounded-md shadow-sm">
                <a href="#" class="px-3 py-1 border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">Previous</a>
                <a href="#" class="px-3 py-1 border border-gray-300 bg-white text-blue-600 font-semibold">1</a>
                <a href="#" class="px-3 py-1 border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">2</a>
                <a href="#" class="px-3 py-1 border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">3</a>
                <a href="#" class="px-3 py-1 border border-gray-300 bg-white text-gray-700 hover:bg-gray-100">Next</a>
            </nav>
        </div>
    </div>
@endsection
