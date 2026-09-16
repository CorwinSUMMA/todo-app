<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow">Werkruimte</p>
                <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-[#182321]">Alle taken</h1>
            </div>
            <p class="text-sm text-[#66716c]">{{ $tasks->where('completed', false)->count() }} openstaand</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-5 py-8 sm:px-8 sm:py-10">
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" role="status">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">{{ $errors->first() }}</div>
        @endif

        <div class="soft-panel overflow-hidden">
            <form class="flex flex-col gap-3 border-b border-black/5 bg-[#fbfcf8] p-5 sm:flex-row sm:p-7" method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <input class="focus-ring min-w-0 flex-1 rounded-xl border-black/10 bg-white px-4 py-3 text-sm shadow-sm placeholder:text-[#a2aaa4]" name="title" required maxlength="255" placeholder="Wat wil je onthouden?" type="text">
                    <button class="focus-ring rounded-xl bg-[#e86f51] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#d95e42]" type="submit">Taak toevoegen <span class="ml-1">＋</span></button>
            </form>

            <div class="divide-y divide-black/5">
                @forelse ($tasks as $task)
                    <div class="group flex items-center gap-4 px-5 py-5 transition hover:bg-[#fbfcf8] sm:px-7">
                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                            @csrf
                            @method('PATCH')
                            <input name="completed" type="hidden" value="{{ $task->completed ? 0 : 1 }}">
                            <button aria-label="{{ $task->completed ? 'Taak heropenen' : 'Taak afronden' }}" class="focus-ring flex h-7 w-7 items-center justify-center rounded-full border-2 {{ $task->completed ? 'border-emerald-600 bg-emerald-600 text-white' : 'border-[#b7c1bb] hover:border-[#e86f51]' }}" type="submit">@if ($task->completed)✓@endif</button>
                        </form>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-semibold {{ $task->completed ? 'text-[#9aa39e] line-through' : 'text-[#26332f]' }}">{{ $task->title }}</p>
                            <p class="mt-1 text-xs text-[#8b9690]">{{ $task->completed ? 'Afgerond' : 'Openstaand' }} · {{ $task->created_at->diffForHumans() }}</p>
                        </div>
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                            @csrf
                            @method('DELETE')
                            <button aria-label="Taak verwijderen" class="focus-ring rounded-lg p-2 text-[#a1aaa4] opacity-60 transition hover:bg-red-50 hover:text-red-600 group-hover:opacity-100" type="submit">×</button>
                        </form>
                    </div>
                @empty
                    <div class="px-6 py-16 text-center sm:px-8">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#dcefe6] text-2xl text-emerald-800">✓</div>
                        <h2 class="mt-5 font-display text-xl font-semibold">Je lijst is leeg.</h2>
                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-[#7c8781]">Dat is een goed moment om iets nieuws op te pakken. Voeg hierboven je eerste taak toe.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>