<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <main class="min-h-screen bg-[#f4f5ef] px-5 py-6 sm:px-8 sm:py-10">
            <div class="mx-auto grid min-h-[calc(100vh-3rem)] max-w-5xl overflow-hidden rounded-[2rem] bg-white shadow-[0_24px_80px_-40px_rgba(24,35,33,0.55)] lg:grid-cols-[0.9fr_1.1fr]">
                <aside class="relative hidden overflow-hidden bg-[#182321] p-10 text-white lg:flex lg:flex-col lg:justify-between">
                    <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full border-[28px] border-[#8ed0b2]/20"></div>
                    <div class="absolute -bottom-28 -left-20 h-72 w-72 rounded-full border-[32px] border-[#e86f51]/20"></div>
                    <a class="relative font-display text-2xl font-bold tracking-tight" href="{{ url('/') }}">day<span class="text-[#f29a78]">mark</span><span class="ml-1 text-[#8ed0b2]">.</span></a>
                    <div class="relative max-w-xs">
                        <p class="eyebrow !text-[#8ed0b2]">Ruimte voor vandaag</p>
                        <h1 class="mt-4 font-display text-4xl font-semibold leading-tight">Maak plaats voor wat telt.</h1>
                        <p class="mt-5 text-sm leading-7 text-white/55">Een rustige plek voor kleine acties, heldere dagen en taken die niet uit je hoofd hoeven te blijven.</p>
                    </div>
                    <p class="relative text-xs text-white/35">Daymark task space</p>
                </aside>

                <section class="flex items-center justify-center px-6 py-10 sm:px-12 lg:px-16">
                    <div class="w-full max-w-md">
                        <div class="mb-8 lg:hidden">
                            <a class="font-display text-2xl font-bold tracking-tight text-[#182321]" href="{{ url('/') }}">day<span class="text-[#e86f51]">mark</span><span class="ml-1 text-emerald-600">.</span></a>
                        </div>
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </main>
        </div>
    </body>
</html>
