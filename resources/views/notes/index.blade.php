@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Notes</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">All notes</h1>
        </div>
        <a href="{{ route('notes.create') }}" class="inline-flex items-center rounded-full bg-[#facc15] px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">Create note</a>
    </div>

    @if($notes->isEmpty())
        <div class="rounded-3xl border border-dashed border-[#e2e8f0] bg-white p-12 text-center text-slate-500 shadow-sm dark:border-slate-800 dark:bg-slate-950">Your notes list is empty. Add a note to begin.</div>
    @else
        <div class="masonry masonry-sm">
            @foreach($notes as $note)
                @include('components.note-card', ['note' => $note])
            @endforeach
        </div>
    @endif
</div>
@endsection
