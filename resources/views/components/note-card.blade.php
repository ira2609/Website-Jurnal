<article class="mb-5 inline-block w-full break-inside-avoid rounded-3xl border border-[#e2e8f0] bg-white p-5 shadow-md transition hover:-translate-y-0.5 hover:shadow-xl dark:border-slate-800 dark:bg-slate-950">
    @if($note->imageUrl())
        <img src="{{ $note->imageUrl() }}" alt="{{ $note->title }}" class="mb-4 h-44 w-full rounded-3xl object-cover object-center" loading="lazy" />
    @endif

    <div class="flex items-start justify-between gap-3">
        <span class="rounded-2xl bg-[#fffbeb] px-3 py-1 text-xs font-semibold text-slate-900">{{ $note->mood }}</span>
        @if($note->is_favorite)
            <span class="inline-flex items-center gap-1 rounded-full bg-[#facc15] px-3 py-1 text-xs font-semibold text-slate-900">⭐ Favorite</span>
        @endif
    </div>

    <h3 class="mt-4 text-xl font-semibold text-slate-900 dark:text-white">{{ $note->title }}</h3>
    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300 overflow-hidden" style="max-height: 7.5rem;">{{ $note->content }}</p>

    <div class="mt-5 flex items-center justify-between text-xs uppercase tracking-[0.18em] text-slate-500 dark:text-slate-400">
        <span>{{ $note->created_at->format('M d, Y') }}</span>
    </div>

    <a href="{{ route('notes.show', $note) }}" class="mt-5 inline-flex items-center text-sm font-semibold text-slate-900 transition hover:text-slate-700 dark:text-slate-100">Open note →</a>
</article>
