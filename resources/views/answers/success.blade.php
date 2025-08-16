<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Thank you — Submission received</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Thank you for your submission. We have received your form successfully." />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#0EA5E9', soft: '#38BDF8' },
                    }
                }
            }
        }
    </script>

    <style>
        .bg-animated {
            background:
                radial-gradient(circle at top left, rgba(14,165,233,.2), transparent 60%),
                radial-gradient(circle at top right, rgba(56,189,248,.2), transparent 60%),
                linear-gradient(to bottom, #0f172a, #1e293b);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-animated text-slate-100">

<main class="mx-auto max-w-lg px-6 py-16 text-center">
    <div class="rounded-3xl bg-white/10 backdrop-blur-xl ring-1 ring-white/10 p-10 shadow-lg">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-brand/20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-brand">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Thank you!</h1>
        <p class="mt-3 text-slate-300">
            {!! $text !!}
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a href="{{$redirect}}" class="inline-flex items-center justify-center rounded-xl bg-brand px-5 py-3 text-sm font-semibold text-white shadow transition hover:bg-brand/90">
                Return back
            </a>
        </div>
    </div>
    <p class="mt-6 text-center text-xs text-slate-400">© {{now()->year}} FormPost.org — All rights reserved.</p>
</main>

</body>
</html>
