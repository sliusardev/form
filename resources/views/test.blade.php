<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Фірма — Сучасний сайт</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-modal-open]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const target = btn.getAttribute('data-modal-open');
                    document.getElementById(target).classList.remove('hidden');
                });
            });
            document.querySelectorAll('[data-modal-close]').forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.closest('.modal').classList.add('hidden');
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 text-gray-900">
<!-- Header -->
<header class="bg-white shadow p-4 flex justify-between items-center">
    <div class="text-xl font-bold">Фірма</div>
    <nav class="space-x-4">
        <a href="#" class="hover:underline">Головна</a>
        <a href="#" class="hover:underline">Послуги</a>
        <a href="#" class="hover:underline">Контакти</a>
    </nav>
    <button data-modal-open="callbackModal" class="bg-blue-600 text-white px-4 py-2 rounded">Передзвоніть мені</button>
</header>

<!-- Main Content -->
<main class="p-6 space-y-10">
    <!-- Feedback Form -->
    <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Зворотній зв'язок</h2>
        <form class="space-y-4" onsubmit="event.preventDefault(); alert('Форма відправлена!');">
            <input type="text" placeholder="Ім’я" required class="w-full border p-2 rounded" />
            <input type="email" placeholder="Email" required class="w-full border p-2 rounded" />
            <textarea placeholder="Ваше повідомлення" required class="w-full border p-2 rounded"></textarea>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Надіслати</button>
        </form>
    </section>

    <!-- Subscribe Form -->
    <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Підписка на новини</h2>
        <form class="flex gap-4" onsubmit="event.preventDefault(); alert('Підписка оформлена!');">
            <input type="email" placeholder="Ваш Email" required class="flex-grow border p-2 rounded" />
            <button class="bg-green-600 text-white px-4 py-2 rounded">Підписатися</button>
        </form>
    </section>

    <!-- Trigger Buttons -->
    <div class="flex gap-4">
        <button data-modal-open="errorModal" class="underline text-sm text-red-600">Знайшли помилку?</button>
        <button data-modal-open="reviewModal" class="underline text-sm text-yellow-600">Залишити відгук</button>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white shadow mt-10 p-4 text-center text-sm text-gray-600">
    © 2025 Фірма. Усі права захищені.
</footer>

<!-- Modals -->
<div id="callbackModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Передзвоніть мені</h3>
        <form onsubmit="event.preventDefault(); alert('Запит на дзвінок надіслано!');">
            <input type="text" placeholder="Ваше ім’я" required class="w-full border p-2 rounded mb-3" />
            <input type="tel" placeholder="Номер телефону" required class="w-full border p-2 rounded mb-3" />
            <div class="flex justify-end gap-2">
                <button type="button" data-modal-close class="text-gray-600">Скасувати</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Надіслати</button>
            </div>
        </form>
    </div>
</div>

<div id="errorModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Знайшли помилку?</h3>
        <form onsubmit="event.preventDefault(); alert('Дякуємо за повідомлення!');">
            <textarea placeholder="Опишіть помилку" required class="w-full border p-2 rounded mb-3"></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" data-modal-close class="text-gray-600">Скасувати</button>
                <button class="bg-red-600 text-white px-4 py-2 rounded">Надіслати</button>
            </div>
        </form>
    </div>
</div>

<div id="reviewModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow w-full max-w-md">
        <h3 class="text-lg font-semibold mb-4">Залишити відгук</h3>
        <form onsubmit="event.preventDefault(); alert('Відгук надіслано!');">
            <textarea placeholder="Ваш відгук" required class="w-full border p-2 rounded mb-3"></textarea>
            <div class="flex items-center gap-1 mb-3">
                <span>Оцінка:</span>
                <div class="flex gap-1">
                    <input type="radio" name="rating" required value="1" /><span>★</span>
                    <input type="radio" name="rating" value="2" /><span>★</span>
                    <input type="radio" name="rating" value="3" /><span>★</span>
                    <input type="radio" name="rating" value="4" /><span>★</span>
                    <input type="radio" name="rating" value="5" /><span>★</span>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" data-modal-close class="text-gray-600">Скасувати</button>
                <button class="bg-yellow-600 text-white px-4 py-2 rounded">Надіслати</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
