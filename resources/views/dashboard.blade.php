<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow">{{ now()->format('l, d F Y') }}</p>
                <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-[#182321] sm:text-4xl"><span data-greeting>Goedemorgen</span>, {{ Str::before(auth()->user()->name, ' ') }}.</h1>
                <script>
                    const greetingElement = document.querySelector('[data-greeting]');

                    function updateGreeting() {
                        const hour = new Date().getHours();
                        const greeting = hour < 12 ? 'Goedemorgen' : hour < 18 ? 'Goedemiddag' : 'Goedenavond';

                        greetingElement.textContent = greeting;
                    }

                    updateGreeting();
                    setInterval(updateGreeting, 60000);
                </script>
                <p class="mt-2 max-w-xl text-sm text-[#66716c]">Een overzicht van je openstaande taken.</p>
            </div>
            <a class="focus-ring inline-flex items-center justify-center rounded-xl bg-[#e86f51] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#d95e42]" href="{{ route('tasks.index') }}">
                Open takenlijst <span class="ml-2 text-lg leading-none">→</span>
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-6xl px-5 py-8 sm:px-8 sm:py-10">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">{{ session('status') }}</div>
        @endif

        <div class="grid gap-5 md:grid-cols-[1.25fr_0.75fr]">
            <section class="soft-panel overflow-hidden">
                <div class="flex items-center justify-between border-b border-black/5 px-6 py-5 sm:px-8">
                    <div>
                        <p class="eyebrow">Overzicht</p>
                        <h2 class="mt-1 font-display text-xl font-semibold">Openstaande taken</h2>
                    </div>
                    <span class="rounded-full bg-[#dcefe6] px-3 py-1 text-xs font-bold text-emerald-800">{{ auth()->user()->tasks()->where('completed', false)->count() }} open</span>
                </div>

                <div class="divide-y divide-black/5">
                    @forelse (auth()->user()->tasks()->latest()->take(4)->get() as $task)
                        <div class="flex items-center gap-4 px-6 py-4 transition hover:bg-[#fafaf6] sm:px-8">
                            <form method="POST" action="{{ route('tasks.update', $task) }}">
                                @csrf
                                @method('PATCH')
                                <input name="completed" type="hidden" value="{{ $task->completed ? 0 : 1 }}">
                                <button aria-label="{{ $task->completed ? 'Taak heropenen' : 'Taak afronden' }}" class="focus-ring flex h-6 w-6 items-center justify-center rounded-full border-2 {{ $task->completed ? 'border-emerald-600 bg-emerald-600 text-white' : 'border-[#b7c1bb] hover:border-[#e86f51]' }}" type="submit">@if ($task->completed)✓@endif</button>
                            </form>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold {{ $task->completed ? 'text-[#9aa39e] line-through' : 'text-[#26332f]' }}">{{ $task->title }}</p>
                                <p class="mt-1 text-xs text-[#8b9690]">{{ $task->completed ? 'Afgerond' : 'Openstaand' }}</p>
                            </div>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                @csrf
                                @method('DELETE')
                                <button aria-label="Taak verwijderen" class="focus-ring rounded-lg p-2 text-[#a1aaa4] transition hover:bg-red-50 hover:text-red-600" type="submit">×</button>
                            </form>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center sm:px-8">
                            <p class="font-display text-lg font-semibold">Nog geen taken</p>
                            <p class="mt-1 text-sm text-[#7c8781]">Voeg hierboven je eerste taak toe.</p>
                        </div>
                    @endforelse
                </div>
                <div class="border-t border-black/5 px-6 py-4 sm:px-8">
                    <a class="text-sm font-bold text-emerald-700 hover:text-emerald-900" href="{{ route('tasks.index') }}">Bekijk alle taken <span aria-hidden="true">→</span></a>
                </div>
            </section>

            <aside class="rounded-2xl bg-[#182321] p-6 text-white shadow-[0_20px_60px_-35px_rgba(24,35,33,0.8)] sm:p-8">
                <p class="eyebrow !text-[#8ed0b2]">Voortgang</p>
                <h2 class="mt-3 font-display text-2xl font-semibold leading-tight">Je taken in beeld.</h2>
                <p class="mt-3 text-sm leading-6 text-white/60">Hier zie je hoeveel van je taken je hebt afgerond.</p>
                <div class="mt-10 border-t border-white/10 pt-5">
                    <div class="flex items-end justify-between">
                        <span class="text-sm text-white/60">Voortgang</span>
                        @php
                            $totalTasks = auth()->user()->tasks()->count();
                            $completedTasks = auth()->user()->tasks()->where('completed', true)->count();
                            $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
                        @endphp
                        <span class="font-display text-3xl font-semibold text-[#f29a78]">{{ $progress }}%</span>
                    </div>
                    <div class="mt-3 h-2 overflow-hidden rounded-full bg-white/10"><div class="h-full rounded-full bg-[#f29a78] transition-all" x-bind:style="'width: ' + {{ $progress }} + '%;'" aria-hidden="true"></div></div>
                    <p class="mt-3 text-xs text-white/40">{{ $completedTasks }} van {{ $totalTasks }} {{ $totalTasks === 1 ? 'taak' : 'taken' }} afgerond</p>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
