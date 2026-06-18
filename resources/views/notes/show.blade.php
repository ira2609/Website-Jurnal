@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-[#e2e8f0] dark:border-slate-800 dark:bg-slate-950">
        <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Note details</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">{{ $note->title }}</h1>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $note->mood }}</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <form method="POST" action="{{ route('notes.toggleFavorite', $note) }}" class="inline-block">
                    @csrf
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-3xl {{ $note->is_favorite ? 'bg-[#facc15] text-slate-900 hover:bg-[#f8cc41]' : 'border border-slate-200 bg-white text-slate-900 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100 dark:hover:bg-slate-900' }} px-5 py-3 text-sm font-semibold transition">⭐ {{ $note->is_favorite ? 'Unfavorite' : 'Favorite' }}</button>
                </form>
                <a href="{{ route('notes.edit', $note) }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">Edit</a>
                <form method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Delete this note?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-[#fee2e2] px-5 py-3 text-sm font-semibold text-[#991b1b] transition hover:bg-[#fecaca]">Delete</button>
                </form>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-6">
                @if($note->imageUrl())
                    <img src="{{ $note->imageUrl() }}" alt="{{ $note->title }}" class="w-full rounded-3xl object-cover object-center" />
                @endif
                <div class="rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] p-6 dark:border-slate-800 dark:bg-slate-900">
                    <p class="whitespace-pre-line text-sm leading-7 text-slate-700 dark:text-slate-200">{{ $note->content ?? 'No text content was added.' }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="rounded-3xl border border-[#e2e8f0] bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950">
                    <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Meta</p>
                    <div class="mt-5 space-y-3 text-sm text-slate-700 dark:text-slate-300">
                        <div class="flex items-center justify-between"><span>Created</span><span>{{ $note->created_at->format('M d, Y') }}</span></div>
                        <div class="flex items-center justify-between"><span>Updated</span><span>{{ $note->updated_at->format('M d, Y') }}</span></div>
                        <div class="flex items-center justify-between"><span>Mood</span><span>{{ $note->mood }}</span></div>
                        <div class="flex items-center justify-between"><span>Favorite</span><span>{{ $note->is_favorite ? 'Yes' : 'No' }}</span></div>
                    </div>
                </div>

                <a href="{{ route('notes.index') }}" class="block rounded-3xl border border-slate-200 bg-white px-5 py-4 text-center text-sm font-semibold text-slate-900 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-100">Back to notes</a>
            </div>
        </div>
    </div>
</div>
@endsection
