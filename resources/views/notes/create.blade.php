@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm border border-[#e2e8f0] dark:border-slate-800 dark:bg-slate-950">
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">New note</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Capture the idea</h1>
        <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Write with a clean editor that feels like a dedicated notebook page.</p>
    </div>

    <form method="POST" action="{{ route('notes.store') }}" enctype="multipart/form-data" class="space-y-6 rounded-3xl bg-white p-6 shadow-sm border border-[#e2e8f0] dark:border-slate-800 dark:bg-slate-950">
        @csrf

        <label class="block">
            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Title</span>
            <input type="text" name="title" value="{{ old('title') }}" required class="mt-2 w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
            @error('title')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </label>

        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block">
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Mood</span>
                <select name="mood" class="mt-2 w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40">
                    @foreach($moodOptions as $mood)
                        <option value="{{ $mood }}" {{ old('mood') == $mood ? 'selected' : '' }}>{{ $mood }}</option>
                    @endforeach
                </select>
                @error('mood')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </label>

            <label class="block">
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Image</span>
                <input type="file" name="image" accept="image/*" class="mt-2 w-full rounded-3xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
                @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </label>
        </div>

        <label class="block">
            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200">Content</span>
            <textarea name="content" rows="10" class="mt-2 w-full rounded-[2rem] border border-[#e2e8f0] bg-[#f8fafc] px-5 py-4 text-sm leading-6 text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40">{{ old('content') }}</textarea>
            @error('content')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </label>

        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('notes.index') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-800 dark:text-slate-200 dark:hover:bg-slate-900">Cancel</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-[#facc15] px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">Save note</button>
        </div>
    </form>
</div>
@endsection
