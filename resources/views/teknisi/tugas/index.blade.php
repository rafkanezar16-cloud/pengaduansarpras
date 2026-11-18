@php($title = 'Tugas Perbaikan')
@php($subtitle = 'Daftar pengaduan yang ditugaskan kepada Anda')
@extends('layouts.app')

@section('content')
<div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="inline-flex rounded-xl bg-slate-100 p-1 text-sm font-semibold self-start">
            @foreach (['aktif' => 'Aktif', 'selesai' => 'Selesai', 'semua' => 'Semua'] as $k => $label)
                <a href="{{ route('teknisi.tugas.index', ['tampil' => $k]) }}"
                   class="px-4 py-1.5 rounded-lg {{ $filter === $k ? 'bg-white text-brand-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">{{ $label }}</a>
            @endforeach
        </div>
        <form method="GET" class="flex-1 sm:max-w-xs sm:ml-auto relative">
            <input type="hidden" name="tampil" value="{{ $filter }}">
            <x-icon name="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" />
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari kode / deskripsi..."
                   class="w-full pl-9 pr-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
        </form>
    </div>

    @if ($tugas->isEmpty())
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Tidak ada tugas pada tampilan ini.</div>
    @else
        <div class="divide-y divide-slate-100">
            @foreach ($tugas as $item)
                <a href="{{ route('teknisi.tugas.show', $item) }}" class="flex items-start gap-4 px-4 sm:px-6 py-4 hover:bg-slate-50">
                    @if ($item->foto)
                        <img src="{{ asset($item->foto) }}" alt="" loading="lazy" class="w-14 h-14 rounded-xl object-cover border border-slate-200 shrink-0">
                    @endif
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-3">
                            <p class="font-semibold text-slate-800">{{ $item->kategori->nama }} &middot; {{ $item->lokasi_nama }}</p>
                            <x-status-badge :status="$item->status" :label="$item->statusLabel()" />
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $item->kode }} &middot; pelapor {{ $item->user->name }}</p>
                        <p class="text-sm text-slate-600 mt-1 line-clamp-1">{{ $item->deskripsi }}</p>
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            @if ($item->tahapPerbaikan())
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">{{ $item->tahapPerbaikan() }}</span>
                            @endif
                            @if ($item->target_selesai && $item->status === 'diproses')
                                <span class="text-xs {{ $item->terlambat() ? 'text-red-600 font-semibold' : 'text-slate-500' }}">Target {{ $item->target_selesai->translatedFormat('d M Y') }}@if ($item->terlambat()) (terlambat)@endif</span>
                            @endif
                            @if ($item->status === 'selesai' && $item->selesai_at)
                                <span class="text-xs text-slate-500">Selesai {{ $item->selesai_at->translatedFormat('d M Y') }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100">{{ $tugas->links() }}</div>
    @endif
</div>
@endsection
