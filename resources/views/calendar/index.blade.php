@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-[#e2e8f0] bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Calendar</p>
                <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Notes by day</h1>
                <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Review your journal flow and jump into notes for any day.</p>
            </div>
            <div class="rounded-3xl bg-[#fef3c7] px-5 py-4 text-sm font-semibold text-slate-900">{{ $selected->translatedFormat('F Y') }}</div>
        </div>
    </div>

    <div class="rounded-3xl border border-[#e2e8f0] bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Month view</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">{{ $selected->translatedFormat('F Y') }}</h2>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('calendar.index', ['date' => $selected->copy()->subMonth()->startOfMonth()->toDateString()]) }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:bg-slate-900">Prev</a>
                <a href="{{ route('calendar.index', ['date' => $selected->copy()->addMonth()->startOfMonth()->toDateString()]) }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-200 dark:hover:bg-slate-900">Next</a>
            </div>
        </div>
        <div class="mt-6 grid grid-cols-12 gap-2">
            @foreach(range(1, 12) as $month)
                @php
                    $monthDate = $selected->copy()->month($month)->startOfMonth();
                    $isActiveMonth = $monthDate->month === $selected->month;
                @endphp
                <a href="{{ route('calendar.index', ['date' => $monthDate->toDateString()]) }}" class="rounded-2xl border px-3 py-2 text-center text-xs font-semibold transition {{ $isActiveMonth ? 'border-sky-500 bg-sky-500 text-white shadow-sm' : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-slate-300 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-300 dark:hover:border-slate-600 dark:hover:bg-slate-900' }}">
                    {{ $monthDate->translatedFormat('M') }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-[#e2e8f0] bg-white shadow-sm dark:border-slate-800 dark:bg-slate-950">
        <div class="grid grid-cols-7 gap-1 bg-slate-100 p-4 text-center text-[10px] uppercase tracking-[0.25em] text-slate-500 dark:bg-slate-900 dark:text-slate-400">
            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                <span class="py-3 font-semibold">{{ $day }}</span>
            @endforeach
        </div>
        <div class="grid grid-cols-7 gap-2 p-4">
            @foreach($calendar as $week)
                @foreach($week as $day)
                    @php
                        $key = $day->format('Y-m-d');
                        $dayNotes = $notesByDate->get($key, collect());
                        $hasNotes = $dayNotes->isNotEmpty();
                        $isSelectedDay = $key === $selected->format('Y-m-d');
                    @endphp
                    <a href="{{ route('calendar.index', ['date' => $key]) }}" class="group rounded-3xl border border-transparent bg-white p-4 text-left transition hover:border-slate-300 hover:bg-[#f8fafc] dark:bg-slate-950 dark:hover:border-slate-700 dark:hover:bg-slate-900 {{ $day->month !== $selected->month ? 'opacity-40' : '' }} {{ $isSelectedDay ? 'border-sky-500 bg-sky-50 dark:border-sky-500 dark:bg-slate-900' : '' }}">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ $day->day }}</span>
                            @if($hasNotes)
                                <span class="h-2.5 w-2.5 rounded-full bg-[#facc15]"></span>
                            @endif
                        </div>
                        <p class="mt-1 text-[11px] text-slate-500 dark:text-slate-400">{{ $day->translatedFormat('D') }}</p>
                        @if($hasNotes)
                            <p class="mt-3 text-xs font-medium text-slate-600 dark:text-slate-300">{{ $dayNotes->count() }} note{{ $dayNotes->count() === 1 ? '' : 's' }}</p>
                        @endif
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>

    <div class="rounded-3xl border border-[#e2e8f0] bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-950">
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">Entries for {{ $selected->format('F j, Y') }}</p>
        @php
            $selectedNotes = $notesByDate->get($selected->format('Y-m-d'), collect());
        @endphp
        @if($selectedNotes->isEmpty())
            <div class="mt-5 rounded-3xl border border-dashed border-[#e2e8f0] bg-[#f8fafc] p-8 text-center text-slate-500 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-400">No notes were created on this date.</div>
        @else
            <div class="mt-5 grid gap-5 masonry masonry-sm">
                @foreach($selectedNotes as $note)
                    @include('components.note-card', ['note' => $note])
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
