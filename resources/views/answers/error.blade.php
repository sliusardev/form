<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Oops — Something went wrong</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Oops, something went wrong or the form was not found." />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        danger: { DEFAULT: '#EF4444', soft: '#F87171' },
                    }
                }
            }
        }
    </script>

    <style>
        .bg-animated {
            background:
                radial-gradient(circle at top left, rgba(239,68,68,.2), transparent 60%),
                radial-gradient(circle at top right, rgba(248,113,113,.2), transparent 60%),
                linear-gradient(to bottom, #111827, #1f2937);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-animated text-slate-100">

<main class="mx-auto max-w-lg px-6 py-16 text-center">
    <div class="rounded-3xl bg-white/10 backdrop-blur-xl ring-1 ring-white/10 p-10 shadow-lg">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-danger/20">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-danger">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2.25m0 4.5h.008v.008H12v-.008Zm-9 0a9 9 0 1 0 18 0 9 9 0 0 0-18 0Z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">Oops!</h1>
        <p class="mt-3 text-slate-300">
            {!! $text !!}
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a href="{{$redirect}}" class="inline-flex items-center justify-center rounded-xl bg-danger px-5 py-3 text-sm font-semibold text-white shadow transition hover:bg-danger/90">
                Return back
            </a>
        </div>
    </div>
    <p class="mt-6 text-center text-xs text-slate-400">© {{now()->year}} FormPost.org — All rights reserved.</p>
</main>

</body>
</html>
