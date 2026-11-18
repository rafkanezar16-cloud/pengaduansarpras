@php($title = 'Dashboard')
@php($subtitle = 'Selamat datang, ' . auth()->user()->name . '!')
@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5 mb-6 sm:mb-8">
    @foreach ([
        ['label' => 'Diajukan', 'key' => 'diajukan', 'icon' => 'clock', 'box' => 'bg-blue-50 text-blue-600'],
        ['label' => 'Diproses', 'key' => 'diproses', 'icon' => 'cog', 'box' => 'bg-amber-50 text-amber-600'],
        ['label' => 'Selesai', 'key' => 'selesai', 'icon' => 'check', 'box' => 'bg-green-50 text-green-600'],
    ] as $i => $card)
        <div class="anim-up d{{ $i + 1 }} lift bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 flex sm:block items-center gap-4">
            <div class="w-12 h-12 rounded-xl {{ $card['box'] }} flex items-center justify-center sm:mb-4 shrink-0">
                <x-icon :name="$card['icon']" class="w-6 h-6" />
            </div>
            <div>
                <p class="text-sm text-slate-500">{{ $card['label'] }}</p>
                <p class="text-3xl font-extrabold text-slate-900 sm:mt-1"><span data-count="{{ $stats[$card['key']] }}">{{ $stats[$card['key']] }}</span></p>
            </div>
        </div>
    @endforeach
</div>

@if ($recent->isEmpty())
    <a href="{{ route('siswa.panduan') }}" class="anim-up block mb-6 sm:mb-8 rounded-2xl bg-gradient-to-r from-brand-600 to-brand-800 text-white p-5 sm:p-6 hover:shadow-lg transition">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center shrink-0"><x-icon name="book" class="w-6 h-6" /></div>
            <div class="min-w-0">
                <p class="font-bold">Baru pertama kali mengadu?</p>
                <p class="text-sm text-brand-100">Baca panduan singkat 4 langkah agar laporanmu cepat ditangani.</p>
            </div>
            <x-icon name="arrow-right" class="w-5 h-5 ml-auto shrink-0" />
        </div>
    </a>
@endif

<a href="{{ route('siswa.pengaduan.create') }}"
   class="anim-up d4 inline-flex w-full sm:w-auto justify-center items-center gap-2 bg-brand-600 hover:bg-brand-700 transition text-white font-semibold px-5 py-3 rounded-xl shadow-lg shadow-brand-600/30 mb-6 sm:mb-8">
    <x-icon name="plus" class="w-5 h-5" />
    Ajukan Pengaduan Baru
</a>
<a href="{{ route('siswa.panduan') }}" class="anim-up d4 inline-flex w-full sm:w-auto justify-center items-center gap-2 text-brand-700 hover:bg-brand-50 transition font-semibold px-5 py-3 rounded-xl mb-6 sm:mb-8 sm:ml-2">
    <x-icon name="help" class="w-5 h-5" /> Lihat Panduan
</a>

<div class="anim-up d5 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between gap-2">
        <h3 class="font-bold text-slate-800">Pengaduan Terbaru Anda</h3>
        <a href="{{ route('siswa.pengaduan.index') }}" class="text-sm font-semibold text-brand-600 hover:underline whitespace-nowrap">Lihat semua &rarr;</a>
    </div>

    @if ($recent->isEmpty())
        <div class="px-6 py-10 text-center text-slate-400 text-sm">Belum ada pengaduan yang diajukan. <a href="{{ route('siswa.panduan') }}" class="text-brand-600 font-semibold hover:underline">Lihat panduan &rarr;</a></div>
    @else
        {{-- Mobile: kartu --}}
        <div class="md:hidden divide-y divide-slate-100">
            @foreach ($recent as $item)
                <a href="{{ route('siswa.pengaduan.show', $item) }}" class="block px-4 py-4 hover:bg-slate-50">
                    <div class="flex items-start justify-between gap-3">
                        <p class="font-semibold text-slate-800">{{ $item->kategori->nama }}</p>
                        <x-status-badge :status="$item->status" :label="$item->statusLabel()" />
                    </div>
                    <p class="text-sm text-slate-500 mt-1">{{ $item->lokasi_nama }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ $item->tanggal_kejadian->translatedFormat('d M Y') }}</p>
                </a>
            @endforeach
        </div>

        {{-- Desktop: tabel --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left font-medium px-6 py-3">Tanggal</th>
                        <th class="text-left font-medium px-6 py-3">Kategori / Lokasi</th>
                        <th class="text-right font-medium px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($recent as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-600">
                                <a href="{{ route('siswa.pengaduan.show', $item) }}" class="hover:text-brand-600">{{ $item->tanggal_kejadian->translatedFormat('d M Y') }}</a>
                            </td>
                            <td class="px-6 py-4 text-slate-800 font-medium">
                                {{ $item->kategori->nama }} <span class="text-slate-400 font-normal">&middot; {{ $item->lokasi_nama }}</span>
                            </td>
                            <td class="px-6 py-4 text-right"><x-status-badge :status="$item->status" :label="$item->statusLabel()" /></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
