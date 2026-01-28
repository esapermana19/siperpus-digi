@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white p-8 rounded-3xl shadow-lg">
        <h2 class="text-2xl font-bold text-primary mb-2">Selamat Datang, Admin! 👋</h2>
        <p class="text-slate-600 mb-8">Ini adalah ringkasan aktivitas Perpustakaan LP3I hari ini.</p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100">
                <h3 class="text-emerald-800 font-bold text-sm uppercase tracking-wider">Total Kategori</h3>
                <p class="text-3xl font-black text-emerald-900 mt-2">{{ $totalKategori }}</p>
            </div>

            <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                <h3 class="text-blue-800 font-bold text-sm uppercase tracking-wider">Total Buku</h3>
                <p class="text-3xl font-black text-blue-900 mt-2">{{ $totalBuku }}</p>
            </div>

            <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100">
                <h3 class="text-purple-800 font-bold text-sm uppercase tracking-wider">Anggota</h3>
                <p class="text-3xl font-black text-purple-900 mt-2">{{ $totalAnggota }}</p>
            </div>

            <div class="bg-amber-50 p-6 rounded-2xl border border-amber-100">
                <h3 class="text-amber-800 font-bold text-sm uppercase tracking-wider">Peminjaman</h3>
                <p class="text-3xl font-black text-amber-900 mt-2">{{ $totalPinjam }}</p>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-2">
                <span class="w-1.5 h-6 bg-accent2 rounded-full"></span>
                Aktivitas Terbaru
            </h3>

            <div class="space-y-3">
                @forelse($recentLogs as $log)
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-slate-100 transition duration-200">
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-2 rounded-full {{ $log->method == 'DELETE' ? 'bg-red-500' : ($log->method == 'POST' ? 'bg-green-500' : 'bg-blue-500') }}"></div>

                            <div>
                                <p class="font-semibold text-slate-700">{{ $log->subject }}</p>
                                <p class="text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <span class="text-[10px] bg-white border border-slate-200 px-3 py-1 rounded-lg text-slate-500 uppercase font-bold tracking-widest">
                            {{ $log->method }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-10 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 text-sm italic">Belum ada aktivitas yang tercatat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
