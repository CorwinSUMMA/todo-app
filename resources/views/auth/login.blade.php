<x-guest-layout>
    <div class="mb-8">
        <p class="eyebrow">Account</p>
        <h2 class="mt-3 font-display text-3xl font-semibold tracking-tight text-[#182321]">Inloggen</h2>
        <p class="mt-2 text-sm leading-6 text-[#7c8781]">Log in om je taken te bekijken.</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-5 flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-black/15 text-emerald-700 shadow-sm focus:ring-emerald-600" name="remember">
                <span class="ml-2 text-sm text-[#66716c]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-7 flex items-center justify-between gap-4">
            @if (Route::has('password.request'))
            <a class="text-sm font-semibold text-emerald-700 underline-offset-4 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="primary-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
