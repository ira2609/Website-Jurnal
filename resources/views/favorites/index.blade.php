@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Favorites</p>
        <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Saved mood notes</h1>
        <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">A calm collection of your favorite entries for quick access.</p>
    </div>

    @if($notes->isEmpty())
        <div class="rounded-3xl border border-dashed border-[#e2e8f0] bg-white p-12 text-center text-slate-500 shadow-sm dark:border-slate-800 dark:bg-slate-950">No favorite notes yet. Mark a note as favorite to keep it here.</div>
    @else
        <div class="masonry masonry-sm">
            @foreach($notes as $note)
                @include('components.note-card', ['note' => $note])
            @endforeach
        </div>
    @endif
</div>
@endsection
