<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | {{ config('app.name', 'Laravel') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-stone-100 text-stone-950 antialiased">
        <main class="grid min-h-screen lg:grid-cols-[1.05fr_0.95fr]">
            <section class="relative hidden overflow-hidden bg-stone-950 p-12 text-stone-50 lg:flex lg:flex-col lg:justify-between">
                <div class="absolute -right-24 -top-24 h-80 w-80 rotate-12 border-[32px] border-amber-400/80"></div>
                <div class="relative flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.2em]">
                    <span class="flex h-9 w-9 items-center justify-center bg-amber-400 text-stone-950">L</span>
                    {{ config('app.name', 'Laravel') }}
                </div>
                <div class="relative max-w-xl">
                    <p class="mb-5 text-sm font-semibold uppercase tracking-[0.22em] text-amber-300">Welcome back</p>
                    <h1 class="text-5xl font-semibold leading-tight tracking-tight xl:text-6xl">Your work is waiting on the other side.</h1>
                </div>
                <p class="relative text-sm text-stone-400">Secure access to your workspace.</p>
            </section>

            <section class="flex items-center justify-center px-6 py-12 sm:px-10">
                <div class="w-full max-w-md">
                    <div class="mb-10 lg:hidden">
                        <div class="mb-8 flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.2em]">
                            <span class="flex h-9 w-9 items-center justify-center bg-amber-400 text-stone-950">L</span>
                            {{ config('app.name', 'Laravel') }}
                        </div>
                    </div>

                    <div class="mb-8">
                        <p class="mb-3 text-sm font-semibold uppercase tracking-[0.18em] text-rose-600">Account access</p>
                        <h2 class="text-4xl font-semibold tracking-tight text-stone-950">Sign in</h2>
                        <p class="mt-3 text-stone-600">Enter your details to continue.</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 border-l-4 border-rose-500 bg-rose-50 px-4 py-3 text-sm text-rose-800" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
                        @csrf

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-semibold text-stone-800">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="h-12 border border-stone-300 bg-white px-4 text-stone-950 outline-none transition focus:border-stone-950 focus:ring-2 focus:ring-amber-300">
                            @error('email')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="password" class="text-sm font-semibold text-stone-800">Password</label>
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="h-12 border border-stone-300 bg-white px-4 text-stone-950 outline-none transition focus:border-stone-950 focus:ring-2 focus:ring-amber-300">
                            @error('password')
                                <p class="text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="h-12 bg-stone-950 px-5 text-sm font-semibold text-white transition hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2">Sign in</button>
                    </form>
                </div>
            </section>
        </main>
    </body>
</html>