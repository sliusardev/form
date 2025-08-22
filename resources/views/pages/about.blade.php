@extends('layouts.site')

@push('meta')
    @php($title = 'About Us')
    @section('og_description', 'About our company and team.')
@endpush

@section('content')
    @if(app()->getLocale() === 'uk')
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50 pointer-events-none"></div>
            <div class="relative max-w-5xl mx-auto px-6 py-16">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">Про нас</h1>
                <p class="mt-4 text-base md:text-lg text-gray-600">
                    FormPost.org — онлайн‑сервіс для прийому та обробки форм.
                </p>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-6 py-10">
            <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm ring-1 ring-gray-200 p-6 md:p-8">
                <h2 class="text-xl font-semibold text-gray-900">Що таке FormPost.org</h2>
                <p class="mt-4 text-gray-600">
                    FormPost.org допомагає додати прийом HTML‑форм без розгортання власного бекенду. Ви отримуєте надійний endpoint для відправки даних, сповіщення на email та можливість переспрямовувати заявки на ваш сервер через webhook.
                </p>

                <h3 class="mt-8 text-lg font-medium text-gray-900">Як це працює</h3>
                <ol class="mt-4 list-decimal pl-6 space-y-2 text-gray-600">
                    <li>Створюєте форму у сервісі та отримуєте унікальний endpoint.</li>
                    <li>Вказуєте цей endpoint в атрибуті <code class="px-1 py-0.5 bg-gray-100 rounded text-gray-800">action</code> вашої HTML‑форми.</li>
                    <li>Користувач надсилає форму — ми приймаємо дані, надсилаємо сповіщення на email та, за потреби, викликаємо ваш webhook.</li>
                </ol>

                <h3 class="mt-8 text-lg font-medium text-gray-900">Переваги</h3>
                <ul class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Швидкий старт.</span> Готові приклади інтеграції (cURL, JS, PHP) та простий endpoint.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Гнучка інтеграція.</span> Webhookи, власні заголовки та формати JSON або URL‑encoded.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Антиспам.</span> Техніки honeypot, перевірка часу відправки та ліміти запитів.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Сповіщення.</span> Миттєві листи на вказані адреси з даними заявки.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Валідація.</span> Перевірка обовʼязкових полів і форматів перед доставкою.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Приватність.</span> Мінімізація зібраних даних і контроль над їх зберіганням.
                    </li>
                </ul>

                <h3 class="mt-8 text-lg font-medium text-gray-900">Кому підходить</h3>
                <p class="mt-4 text-gray-600">
                    Фрилансерам і студіям, які роблять лендинги, невеликим бізнесам, маркетинговим командам, продуктам на стадії MVP та освітнім проєктам.
                </p>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-6 pb-10" aria-labelledby="company-details">
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
    @else
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50 pointer-events-none"></div>
            <div class="relative max-w-5xl mx-auto px-6 py-16">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">About us</h1>
                <p class="mt-4 text-base md:text-lg text-gray-600">
                    FormPost.org is an online service for receiving and processing forms.
                </p>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-6 py-10">
            <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm ring-1 ring-gray-200 p-6 md:p-8">
                <h2 class="text-xl font-semibold text-gray-900">What is FormPost.org</h2>
                <p class="mt-4 text-gray-600">
                    FormPost.org helps you add HTML form handling without deploying your own backend. You get a reliable endpoint for sending data, email notifications, and the ability to forward submissions to your server via a webhook.
                </p>

                <h3 class="mt-8 text-lg font-medium text-gray-900">How it works</h3>
                <ol class="mt-4 list-decimal pl-6 space-y-2 text-gray-600">
                    <li>Create a form in the service and get a unique endpoint.</li>
                    <li>Specify this endpoint in the <code class="px-1 py-0.5 bg-gray-100 rounded text-gray-800">action</code> attribute of your HTML form.</li>
                    <li>A user submits the form — we receive the data, send an email notification, and, if needed, call your webhook.</li>
                </ol>

                <h3 class="mt-8 text-lg font-medium text-gray-900">Benefits</h3>
                <ul class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Quick start.</span> Ready integration examples (cURL, JS, PHP) and a simple endpoint.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Flexible integration.</span> Webhooks, custom headers, and JSON or URL‑encoded formats.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Antispam.</span> Honeypot techniques, submit‑time checks, and rate limits.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Notifications.</span> Instant emails to specified addresses with submission data.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Validation.</span> Checks required fields and formats before delivery.
                    </li>
                    <li class="text-gray-600">
                        <span class="font-medium text-gray-900">Privacy.</span> Minimal data collection and control over its storage.
                    </li>
                </ul>

                <h3 class="mt-8 text-lg font-medium text-gray-900">Who it is for</h3>
                <p class="mt-4 text-gray-600">
                    Freelancers and studios building landing pages, small businesses, marketing teams, MVP‑stage products, and educational projects.
                </p>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-6 pb-10" aria-labelledby="company-details">
            <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm ring-1 ring-gray-200 p-6 md:p-8">
                <h2 id="company-details" class="text-xl font-semibold text-gray-900">Company details</h2>

                <dl class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <dt class="text-sm text-gray-500">Sole proprietor</dt>
                        <dd class="text-gray-900 font-medium">Sliusar Vitalii Pavlovich</dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-sm text-gray-500">Tax ID</dt>
                        <dd class="text-gray-900 font-medium">3245203517</dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-sm text-gray-500">Physical address</dt>
                        <dd class="text-gray-900 font-medium">Ukraine, Kremenchuk</dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-sm text-gray-500">Phone</dt>
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
                <h3 class="text-lg font-semibold">Support</h3>
                <p class="mt-2 text-white/90">Have a question? Write to us — we will reply within 24 hours.</p>
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
    @endif
@endsection
