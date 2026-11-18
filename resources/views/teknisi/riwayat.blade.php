@php($title = 'Riwayat Perbaikan')
@php($subtitle = 'Seluruh catatan perbaikan yang pernah Anda simpan')
@extends('layouts.app')

@section('content')
<div class="anim-up bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-4 sm:px-6 py-4 border-b border-slate-100">
        <form method="GET" class="flex flex-col sm:flex-row gap-2">
            <select name="jenis" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-slate-200 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                <option value="">Semua jenis catatan</option>
                @foreach (\App\Models\Perbaikan::JENIS as $k => $j)
                    <option value="{{ $k }}" @selected(request('jenis') === $k)>{{ $j['label'] }}</option>
                @endforeach
            </select>
        </form>
    </div>

    @if ($riwayat->isEmpty())
        <div class="px-6 py-14 text-center text-slate-400 text-sm">Belum ada riwayat perbaikan.</div>
    @else
        <div class="divide-y divide-slate-100">
            @foreach ($riwayat as $log)
                <div class="px-4 sm:px-6 py-4 flex gap-4">
                    <span class="mt-1.5 w-3 h-3 rounded-full shrink-0 {{ $log->dotClass() }}"></span>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $log->chipClass() }}">{{ $log->label() }}</span>
                            <a href="{{ route('teknisi.tugas.show', $log->pengaduan) }}" class="text-sm font-semibold text-slate-800 hover:text-brand-600">{{ $log->pengaduan->kategori->nama }} &middot; {{ $log->pengaduan->lokasi_nama }}</a>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $log->pengaduan->kode }} &middot; {{ $log->created_at->translatedFormat('d M Y, H:i') }}</p>
                        @if ($log->catatan) <p class="text-sm text-slate-600 mt-1.5 whitespace-pre-line">{{ $log->catatan }}</p> @endif
                        @if ($log->bahan) <p class="text-xs text-slate-500 mt-1"><span class="font-semibold">Bahan:</span> {{ $log->bahan }}</p> @endif
                    </div>
                    @if ($log->foto)
                        <button type="button" data-lightbox="{{ asset($log->foto) }}" data-type="image" class="shrink-0" aria-label="Perbesar foto">
                            <img src="{{ asset($log->foto) }}" alt="" loading="lazy" class="w-16 h-16 rounded-lg object-cover border border-slate-200">
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="px-4 sm:px-6 py-4 border-t border-slate-100">{{ $riwayat->links() }}</div>
    @endif
</div>
@endsection
