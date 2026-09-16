<nav x-data="{ open: false }" class="border-b border-black/5 bg-[#182321] text-white">
    <div class="mx-auto max-w-6xl px-5 sm:px-8">
        <div class="flex h-[76px] items-center justify-between">
            <div class="flex items-center gap-10">
                <a class="font-display text-xl font-bold tracking-tight" href="{{ route('dashboard') }}">
                    day<span class="text-[#f29a78]">mark</span><span class="ml-1 text-[#8ed0b2]">.</span>
                </a>

                <div class="hidden items-center gap-2 sm:flex">
                    <x-nav-link class="!border-transparent !text-white/60 hover:!text-white" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Overzicht
                    </x-nav-link>
                    <x-nav-link class="!border-transparent !text-white/60 hover:!text-white" :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                        Taken
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden items-center sm:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 rounded-full border border-white/15 px-3 py-2 text-sm font-medium text-white/80 transition hover:border-white/35 hover:text-white focus-ring">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-[#f29a78] font-display text-sm font-bold text-[#182321]">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span>{{ Auth::user()->name }}</span>
                            <span class="text-white/40">⌄</span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Account
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="rounded-lg p-2 text-white/70 hover:bg-white/10 hover:text-white focus-ring">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-white/10 pb-4 sm:hidden">
        <div class="space-y-1 pt-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Overzicht
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
                Taken
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-white/10 pb-1 pt-4">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white/50">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
