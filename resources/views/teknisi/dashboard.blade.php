@php($title = 'Dashboard Teknisi')
@php($subtitle = 'Halo, ' . auth()->user()->name . '. Ini ringkasan tugas perbaikan Anda.')
@extends('layouts.app')

@section('content')
<div class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-5 mb-6 sm:mb-8">
    @foreach ([
        ['label' => 'Tugas Baru', 'key' => 'baru', 'icon' => 'bell', 'box' => 'bg-blue-50 text-blue-600'],
        ['label' => 'Sedang Dikerjakan', 'key' => 'dikerjakan', 'icon' => 'wrench', 'box' => 'bg-amber-50 text-amber-600'],
        ['label' => 'Selesai Diperbaiki', 'key' => 'selesai', 'icon' => 'check', 'box' => 'bg-green-50 text-green-600'],
        ['label' => 'Lewat Target', 'key' => 'terlambat', 'icon' => 'alert', 'box' => 'bg-red-50 text-red-600'],
    ] as $i => $card)
        <div class="anim-up d{{ $i + 1 }} lift bg-white rounded-2xl shadow-sm border border-slate-100 p-4 sm:p-6">
            <div class="w-11 h-11 rounded-xl {{ $card['box'] }} flex items-center justify-center mb-3 sm:mb-4">
                <x-icon :name="$card['icon']" class="w-6 h-6" />
            </div>
            <p class="text-xs sm:text-sm text-slate-500">{{ $card['label'] }}</p>
            <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1"><span data-count="{{ $stats[$card['key']] }}">{{ $stats[$card['key']] }}</span></p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 xl:grid-cols-5 gap-5 sm:gap-6">
    <div class="anim-up d5 xl:col-span-3 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-2">
            <h3 class="font-bold text-slate-800">Tugas Perbaikan Aktif</h3>
            <a href="{{ route('teknisi.tugas.index') }}" class="text-sm font-semibold text-brand-600 hover:underline whitespace-nowrap">Lihat semua &rarr;</a>
        </div>
        @if ($tugas->isEmpty())
            <div class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada tugas aktif. Tugas baru akan muncul setelah admin menugaskan Anda.</div>
        @else
            <div class="divide-y divide-slate-100">
                @foreach ($tugas as $item)
                    <a href="{{ route('teknisi.tugas.show', $item) }}" class="flex items-start gap-3 px-4 sm:px-6 py-4 hover:bg-slate-50">
                        @if ($item->foto)
                            <img src="{{ asset($item->foto) }}" alt="" loading="lazy" class="w-12 h-12 rounded-lg object-cover border border-slate-200 shrink-0">
                        @endif
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-800 truncate">{{ $item->kategori->nama }} &middot; {{ $item->lokasi_nama }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $item->kode }} &middot; pelapor {{ $item->user->name }}</p>
                            <div class="flex flex-wrap items-center gap-2 mt-2">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700">{{ $item->tahapPerbaikan() }}</span>
                                @if ($item->target_selesai)
                                    <span class="text-xs {{ $item->terlambat() ? 'text-red-600 font-semibold' : 'text-slate-500' }}">
                                        Target {{ $item->target_selesai->translatedFormat('d M Y') }}@if ($item->terlambat()) (terlambat)@endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <div class="anim-up d5 xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6">
        <h3 class="font-bold text-slate-800 mb-4">Aktivitas Terakhir Anda</h3>
        @forelse ($aktivitas as $log)
            <div class="flex gap-3 py-3 {{ ! $loop->last ? 'border-b border-slate-100' : '' }}">
                <span class="mt-1.5 w-2.5 h-2.5 rounded-full shrink-0 {{ $log->dotClass() }}"></span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-800">{{ $log->label() }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ $log->pengaduan->kode }}</p>
                    <p class="text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p class="text-sm text-slate-400">Belum ada aktivitas perbaikan yang tercatat.</p>
        @endforelse
        <a href="{{ route('teknisi.riwayat') }}" class="inline-block mt-3 text-sm font-semibold text-brand-600 hover:underline">Buka riwayat perbaikan &rarr;</a>
    </div>
</div>
@endsection
