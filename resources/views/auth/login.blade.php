@extends('layouts.app')

@section('content')
<div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl border border-[#e2e8f0]">
    <div class="space-y-3 text-center">
        <p class="text-sm uppercase tracking-[0.25em] text-slate-500">Memoa</p>
        <h1 class="text-3xl font-semibold text-slate-900">Welcome back</h1>
        <p class="text-sm text-slate-500">Your private notes, beautifully organized for writing and reading.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
            @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-slate-700">Password</label>
            <input type="password" name="password" required class="w-full rounded-2xl border border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-[#facc15] focus:ring-2 focus:ring-[#facc15]/40" />
            @error('password')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="w-full rounded-3xl bg-[#facc15] px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-[#f8cc41]">Continue</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">New to Memoa? <a href="{{ route('register') }}" class="font-semibold text-slate-900 hover:underline">Create an account</a></p>
</div>
@endsection
