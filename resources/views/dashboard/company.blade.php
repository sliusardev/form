@extends('layouts.app')

@section('content')

    <!-- Profile Form -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-medium mb-4">{{__('dashboard.company_settings')}}</h3>
        <form class="space-y-4" action="{{ route('company.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.name')}}</label>
                <input type="text" name="name" id="name" value="{{ old('name', $company->name ?? '') }}" required class="w-full bg-white border @error('name') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.slug')}}</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $company->slug ?? '') }}" required class="w-full bg-white border @error('slug') border-red-500 @else border-gray-300 @enderror rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                @error('slug')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.hash')}}</label>
                <input type="text" name="hash" id="hash" value="{{ old('hash', $company->hash ?? '') }}" required class="w-full bg-white border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled/>
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">{{__('dashboard.save')}}</button>
            </div>
        </form>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const companyNameInput = document.getElementById('name');
    const companySlugInput = document.getElementById('slug');

    // Transliteration map for Cyrillic to Latin
    const transliterationMap = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
        'з': 'z', 'и': 'i', 'й': 'y', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
        'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'kh', 'ц': 'ts',
        'ч': 'ch', 'ш': 'sh', 'щ': 'shch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya',
        'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
        'З': 'Z', 'И': 'I', 'Й': 'Y', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
        'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'Kh', 'Ц': 'Ts',
        'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Shch', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu', 'Я': 'Ya',
        'і': 'i', 'ї': 'yi', 'є': 'ye', 'ґ': 'g',
        'І': 'I', 'Ї': 'Yi', 'Є': 'Ye', 'Ґ': 'G'
    };

    function transliterate(text) {
        return text.split('').map(char => transliterationMap[char] || char).join('');
    }

    function generateSlug(text) {
        return transliterate(text)
            .toLowerCase()
            .trim()
            // Replace spaces and special characters with hyphens
            .replace(/[\s_]+/g, '-')
            // Remove accents and diacritics
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            // Keep only alphanumeric characters and hyphens
            .replace(/[^a-z0-9-]/g, '')
            // Remove multiple consecutive hyphens
            .replace(/-+/g, '-')
            // Remove leading/trailing hyphens
            .replace(/^-|-$/g, '');
    }

    companyNameInput.addEventListener('input', function() {
        const slug = generateSlug(this.value);
        companySlugInput.value = slug;
    });
});
</script>
@endsection
