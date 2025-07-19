@extends('layouts.app')

@section('content')

    <!-- name of each tab group should be unique -->
    <div class="tabs tabs-lift">
        <label class="tab">
            <input type="radio" name="my_tabs_4" checked="checked"/>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" /></svg>
            {{__('dashboard.billing')}}
        </label>
        <div class="tab-content bg-base-100 border-base-300 p-6">
            <div class="gap-4 grid grid-cols-1">
                <div class="billing-item flex items-center gap-3 border-b border-gray-100 pb-4">
                    <a href="" type="button" class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 transition mt-6">
                        {{__('dashboard.increase')}}
                    </a>
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.submission_limit')}}</label>
                        <input type="text" name="submission_limit" id="submission_limit" value="{{ old('hash', $company->submission_limit ?? '') }}" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled/>
                    </div>

                </div>
                <div class="billing-item flex items-center gap-3 border-b border-gray-100 pb-4">
                    <a type="button" class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 transition mt-6">
                        {{__('dashboard.increase')}}
                    </a>
                    <div class="flex-grow">
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{__('dashboard.form_limit')}}</label>
                        <input type="text" name="form_limit" id="form_limit" value="{{ old('hash', $company->form_limit ?? '') }}" class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled/>
                    </div>

                </div>
            </div>

        </div>

        <label class="tab">
            <input type="radio" name="my_tabs_4" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 me-2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 0 1 0-.255c.007-.378-.138-.75-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281Z" /></svg>
            {{__('dashboard.company_settings')}}
        </label>
        <div class="tab-content bg-base-100 border-base-300 p-6">
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
                    <input type="text" name="hash" id="hash" value="{{ old('hash', $company->hash ?? '') }}" required class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" disabled/>
                </div>
                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">{{__('dashboard.save')}}</button>
                </div>
            </form>
        </div>
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
