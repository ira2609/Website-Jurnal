<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Memoa') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f8fafc] dark:bg-[#0f172a] text-[#0f172a] dark:text-slate-100">
        @auth
            <div class="min-h-screen md:flex">
                <aside data-side-menu class="fixed inset-y-0 left-0 z-40 w-72 -translate-x-full overflow-y-auto border-r border-[#e2e8f0] bg-white p-6 shadow-xl transition duration-300 ease-in-out dark:border-slate-800 dark:bg-slate-950">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Memoa</p>
                            <p class="mt-3 text-2xl font-semibold text-slate-900 dark:text-slate-100">Write what stays.</p>
                        </div>
                        <button data-menu-toggle class="inline-flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-200">
                            <span class="text-lg">×</span>
                        </button>
                    </div>

                    <div class="mt-6 space-y-4">
                        <a href="{{ route('dashboard') }}" class="block rounded-3xl border border-transparent bg-[#fffbeb] px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:border-[#e2e8f0] hover:bg-[#fff7cc]">🏠 All Notes</a>
                        <a href="{{ route('favorites.index') }}" class="block rounded-3xl border border-transparent bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition hover:border-[#e2e8f0] hover:bg-[#f8fafc]">⭐ Favorites</a>
                        <a href="{{ route('calendar.index') }}" class="block rounded-3xl border border-transparent bg-white px-4 py-3 text-sm text-slate-700 shadow-sm transition hover:border-[#e2e8f0] hover:bg-[#f8fafc]">📅 Calendar</a>
                    </div>

                    <div class="mt-6 border-t border-slate-200 pt-6 text-sm text-slate-500 dark:border-slate-800 dark:text-slate-400">
                        <div class="space-y-1">
                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ auth()->user()->name }}</p>
                            <p>{{ auth()->user()->username ? '@' . auth()->user()->username : auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="mt-4 inline-flex w-full items-center justify-center rounded-3xl bg-[#facc15] px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">🚪 Logout</button>
                        </form>
                    </div>
                </aside>

                <div class="flex-1">
                    <header class="sticky top-0 z-20 border-b border-[#e2e8f0] bg-white/95 px-4 py-3 backdrop-blur-sm dark:border-slate-800 dark:bg-slate-950/95 md:px-6">
                        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">
                            <div class="flex w-24 items-center justify-start">
                                <button data-menu-toggle class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-200">
                                    ☰
                                </button>
                            </div>
                            <div class="flex-1 text-center">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-lg font-semibold text-slate-900 dark:text-slate-100">
                                    <span>Memoa</span>
                                    <span class="text-sm font-normal text-slate-500 dark:text-slate-400">Write what stays.</span>
                                </a>
                            </div>
                            <div class="flex w-24 items-center justify-end gap-3">
                                <a href="{{ route('search.index') }}" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:border-slate-800 dark:bg-slate-950 dark:text-slate-200">
                                    🔎
                                </a>
                                <a href="{{ route('notes.create') }}" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-[#facc15] text-slate-900 shadow-lg transition hover:bg-[#f8cc41]">
                                    +
                                </a>
                            </div>
                        </div>
                    </header>

                    <main class="min-h-[calc(100vh-80px)] px-4 pt-4 pb-6 sm:px-6 lg:px-8">
                        <div class="mx-auto max-w-7xl">
                            @if(session('status'))
                                <div class="mb-6 rounded-3xl border border-[#facc15] bg-[#fffbeb] p-4 text-sm text-slate-700 shadow-sm">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>
        @endauth

        @guest
            <main class="flex min-h-screen items-center justify-center px-4 py-8">
                @yield('content')
            </main>
        @endguest
    </body>
</html>
