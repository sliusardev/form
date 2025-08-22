@extends('layouts.site')

@push('meta')
    @php($title = 'About Us')
    @section('og_description', 'About our company and team.')
@endpush

@section('content')
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50 pointer-events-none"></div>
        <div class="relative max-w-5xl mx-auto px-6 py-16">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Про нас</h1>
            <p class="mt-4 text-base md:text-lg text-gray-600">
                FormPost.org — онлайн‑сервіс для прийому та обробки форм.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-10" aria-labelledby="company-details">
        <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm ring-1 ring-gray-200 p-6 md:p-8">
            <h2 id="company-details" class="text-xl font-semibold text-gray-900">Реквізити компанії</h2>

            <dl class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <dt class="text-sm text-gray-500">ФОП</dt>
                    <dd class="text-gray-900 font-medium">Слюсар Віталій Павлович</dd>
                </div>

                <div class="flex flex-col">
                    <dt class="text-sm text-gray-500">ІПН</dt>
                    <dd class="text-gray-900 font-medium">3245203517</dd>
                </div>

                <div class="flex flex-col">
                    <dt class="text-sm text-gray-500">Фактична адреса</dt>
                    <dd class="text-gray-900 font-medium">Україна, м. Кременчук</dd>
                </div>

                <div class="flex flex-col">
                    <dt class="text-sm text-gray-500">Телефон</dt>
                    <dd class="text-gray-900 font-medium">
                        <a href="tel:+380663758700" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5A2.25 2.25 0 0021 19.5v-1.05c0-.52-.355-.97-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a.75.75 0 01-1.21.038 12.035 12.035 0 01-3.51-3.51.75.75 0 01.038-1.21l1.293-.97c.37-.277.54-.748.417-1.173L6.141 3.102A1.125 1.125 0 005.05 2.25H4A2.25 2.25 0 001.75 4.5v2.25z" />
                            </svg>
                            +380 66 375 87 00
                        </a>
                    </dd>
                </div>

                <div class="flex flex-col sm:col-span-2">
                    <dt class="text-sm text-gray-500">Email</dt>
                    <dd class="text-gray-900 font-medium">
                        <a href="mailto:formpostorg@gmail.com" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5H4.5A2.25 2.25 0 012.25 17.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75m19.5 0l-8.954 5.596a2.25 2.25 0 01-2.292 0L2.25 6.75" />
                            </svg>
                            formpostorg@gmail.com
                        </a>
                    </dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 pb-24">
        <div class="rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-6 md:p-8">
            <h3 class="text-lg font-semibold">Підтримка</h3>
            <p class="mt-2 text-white/90">Маєте питання? Напишіть нам — відповімо протягом 24 годин.</p>
            <div class="mt-4">
                <a href="mailto:formpostorg@gmail.com" class="inline-flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2 hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5H4.5A2.25 2.25 0 012.25 17.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75m19.5 0l-8.954 5.596a2.25 2.25 0 01-2.292 0L2.25 6.75" />
                    </svg>
                    formpostorg@gmail.com
                </a>
            </div>
        </div>
    </section>
@endsection
