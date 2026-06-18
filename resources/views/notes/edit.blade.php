@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-[#e2e8f0] dark:border-slate-800 dark:bg-slate-950">
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Edit note</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Refine your entry</h1>
        <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Update the content, change the mood, or attach a new image as your draft evolves.</p>
    </div>

    <form method="POST" action="{{ route('notes.update', $note) }}" enctype="multipart/form-data" class="space-y-6 rounded-3xl bg-white p-6 shadow-sm border border-[#e2e8f0] dark:border-slate-800 dark:bg-slate-950">
        @csrf
        @method('PUT')

        <label class="block">
            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Title</span>
            <input type="text" name="title" value="{{ old('title', $note->title) }}" required class="mt-2 w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
            @error('title')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </label>

        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block">
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Mood</span>
                <select name="mood" class="mt-2 w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40">
                    @foreach($moodOptions as $mood)
                        <option value="{{ $mood }}" {{ old('mood', $note->mood) == $mood ? 'selected' : '' }}>{{ $mood }}</option>
                    @endforeach
                </select>
                @error('mood')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </label>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Image</span>
                <input type="file" name="image" accept="image/*" class="mt-2 w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
                @if($note->imageUrl())
                    <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Current image is shown on the note detail page.</p>
                @endif
                @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </label>
        </div>

        <label class="block">
            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Content</span>
            <textarea name="content" rows="10" class="mt-2 w-full rounded-[2rem] border border-[#e2e8f0] bg-[#f8fafc] px-5 py-4 text-sm leading-6 text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40">{{ old('content', $note->content) }}</textarea>
            @error('content')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </label>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('notes.show', $note) }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-800 dark:text-slate-200 dark:hover:bg-slate-900">Back</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-[#facc15] px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">Save changes</button>
        </div>
    </form>
</div>
@endsection
