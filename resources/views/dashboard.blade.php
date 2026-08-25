<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard | {{ config('app.name', 'Laravel') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-stone-100 text-stone-950 antialiased">
        <main class="mx-auto flex min-h-screen w-full max-w-5xl flex-col gap-10 px-6 py-8 sm:px-10">
            <header class="flex items-center justify-between gap-4 border-b border-stone-300 pb-5">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-700">{{ config('app.name', 'Laravel') }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="border border-stone-950 bg-stone-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2">Logout</button>
                </form>
            </header>

            <section class="flex flex-1 flex-col justify-center gap-4 pb-24">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-rose-600">Workspace</p>
                <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">Dashboard</h1>
                <p class="text-lg text-stone-600">Selamat datang!</p>
            </section>
        </main>
    </body>
</html>
