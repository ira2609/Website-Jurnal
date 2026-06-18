@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <section class="rounded-3xl border border-[#e2e8f0] bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Memoa dashboard</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">All your notes in one quiet space</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Capture thoughts, drafts, class notes, and ideas with a calm layout designed for flow and focus.</p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-3xl bg-[#fef3c7] px-5 py-4 text-sm font-semibold text-slate-900 shadow-sm">Notes<span class="block text-3xl">{{ $notes->count() }}</span></div>
                <div class="rounded-3xl bg-white px-5 py-4 text-sm text-slate-700 shadow-sm dark:bg-slate-900 dark:text-slate-200">Favorites<span class="block text-3xl">{{ $favorites }}</span></div>
            </div>
        </div>
    </section>

    <section>
        <div class="mb-4 flex items-center justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Your archive</p>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Recent notes</h2>
            </div>
            <a href="{{ route('notes.create') }}" class="inline-flex items-center rounded-full bg-[#facc15] px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">+ New note</a>
        </div>

        @if($notes->isEmpty())
            <div class="rounded-3xl border border-dashed border-[#e2e8f0] bg-white p-12 text-center text-slate-500 shadow-sm dark:border-slate-800 dark:bg-slate-950">No notes yet. Start by creating your first Memoa note.</div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($notes as $note)
                    @include('components.note-card', ['note' => $note])
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
