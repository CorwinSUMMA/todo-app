<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Daymark · {{ config('app.name', 'Todo') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|space-grotesk:500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <main class="min-h-screen overflow-hidden bg-[#f4f5ef]">
            <nav class="mx-auto flex max-w-6xl items-center justify-between px-5 py-6 sm:px-8">
                <a class="font-display text-2xl font-bold tracking-tight text-[#182321]" href="{{ url('/') }}">day<span class="text-[#e86f51]">mark</span><span class="ml-1 text-emerald-600">.</span></a>
                <div class="flex items-center gap-3 text-sm font-semibold">
                    @auth
                        <a class="rounded-xl px-4 py-2 text-[#66716c] transition hover:bg-white hover:text-[#182321]" href="{{ route('dashboard') }}">Overzicht</a>
                    @else
                        <a class="rounded-xl px-4 py-2 text-[#66716c] transition hover:bg-white hover:text-[#182321]" href="{{ route('login') }}">Inloggen</a>
                        @if (Route::has('register'))
                            <a class="primary-button px-4 py-2" href="{{ route('register') }}">Registreren</a>
                        @endif
                    @endauth
                </div>
            </nav>

            <section class="mx-auto grid max-w-6xl items-center gap-12 px-5 pb-16 pt-12 sm:px-8 sm:pb-24 sm:pt-20 lg:grid-cols-[1.05fr_0.95fr] lg:gap-20">
                <div>
                    <p class="eyebrow">Takenlijst</p>
                    <h1 class="mt-5 max-w-2xl font-display text-5xl font-semibold leading-[1.02] tracking-tight text-[#182321] sm:text-7xl">Houd je taken <span class="text-[#e86f51]">bij.</span></h1>
                    <p class="mt-7 max-w-lg text-base leading-8 text-[#66716c]">Voeg taken toe, vink ze af en verwijder ze wanneer je klaar bent.</p>
                    <div class="mt-9 flex flex-wrap items-center gap-4">
                        @auth
                            <a class="primary-button" href="{{ route('tasks.index') }}">Naar mijn taken <span class="ml-2 text-lg leading-none">→</span></a>
                        @else
                            <a class="primary-button" href="{{ route('register') }}">Account maken</a>
                            <a class="text-sm font-bold text-emerald-700 underline-offset-4 hover:underline" href="{{ route('login') }}">Al geregistreerd?</a>
                        @endauth
                    </div>
                </div>

                <div class="relative">
                    <div class="relative rounded-[2rem] bg-[#182321] p-6 text-white shadow-[0_30px_80px_-35px_rgba(24,35,33,0.75)] sm:p-8">
                        <div class="flex items-center justify-between border-b border-white/10 pb-6">
                            <div>
                                <p class="eyebrow !text-[#8ed0b2]">Voorbeeld</p>
                                <h2 class="mt-2 font-display text-2xl font-semibold">Mijn taken</h2>
                            </div>
                            <span class="rounded-full bg-[#dcefe6] px-3 py-1 text-xs font-bold text-emerald-900">3 open</span>
                        </div>
                        <div class="space-y-3 pt-5">
                            <div class="flex items-center gap-3 rounded-xl bg-white/10 p-4"><span class="h-5 w-5 rounded-full border-2 border-[#8ed0b2]"></span><span class="text-sm font-semibold">Verslag afmaken</span></div>
                            <div class="flex items-center gap-3 rounded-xl bg-white/10 p-4"><span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#8ed0b2] text-xs font-bold text-[#182321]">✓</span><span class="text-sm text-white/45 line-through">Boodschappen doen</span></div>
                            <div class="flex items-center gap-3 rounded-xl bg-white/10 p-4"><span class="h-5 w-5 rounded-full border-2 border-[#f29a78]"></span><span class="text-sm font-semibold">Mail beantwoorden</span></div>
                        </div>
                        <div class="mt-8 border-t border-white/10 pt-5"><div class="flex justify-between text-xs text-white/45"><span>Voortgang</span><span class="font-bold text-[#f29a78]">33%</span></div><div class="mt-3 h-2 rounded-full bg-white/10"><div class="h-2 w-1/3 rounded-full bg-[#f29a78]"></div></div></div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
