@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-[#e2e8f0] bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950">
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Search</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Find the note you need</h1>
        <form method="GET" action="{{ route('search.index') }}" class="mt-6 flex flex-col gap-4 sm:flex-row">
            <label class="flex-1">
                <span class="sr-only">Search notes</span>
                <input type="search" name="q" value="{{ $query }}" placeholder="Search notes..." class="w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-5 py-4 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
            </label>
            <button type="submit" class="inline-flex min-w-[140px] items-center justify-center rounded-3xl bg-[#facc15] px-5 py-4 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">Search</button>
        </form>
    </div>

    <div>
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Results</p>
        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $notes->count() }} notes found</h2>
    </div>

    @if($notes->isEmpty())
        <div class="rounded-3xl border border-dashed border-[#e2e8f0] bg-white p-12 text-center text-slate-500 shadow-sm dark:border-slate-800 dark:bg-slate-950">Try searching by title or content phrase.</div>
    @else
        <div class="masonry masonry-sm">
            @foreach($notes as $note)
                @include('components.note-card', ['note' => $note])
            @endforeach
        </div>
    @endif
</div>
@endsection
