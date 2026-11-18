@php($title = 'Detail Pengaduan')
@php($subtitle = $pengaduan->kode)
@extends('layouts.app')

@section('content')
<div class="anim-up max-w-3xl space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
        <div class="flex items-start justify-between mb-6">
            <div>
                <p class="text-xs text-slate-400 mb-1">Kode Pengaduan</p>
                <p class="text-lg font-bold text-slate-800">{{ $pengaduan->kode }}</p>
            </div>
            <x-status-badge :status="$pengaduan->status" :label="$pengaduan->statusLabel()" />
        </div>

        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
            <div>
                <dt class="text-slate-400 mb-1">Pelapor</dt>
                <dd class="font-semibold text-slate-800">{{ $pengaduan->user->name }} @if($pengaduan->user->kelas) &middot; {{ $pengaduan->user->kelas }} @endif</dd>
            </div>
            <div>
                <dt class="text-slate-400 mb-1">Kategori Kerusakan</dt>
                <dd class="font-semibold text-slate-800">{{ $pengaduan->kategori->nama }}</dd>
            </div>
            <div>
                <dt class="text-slate-400 mb-1">Lokasi</dt>
                <dd class="font-semibold text-slate-800">{{ $pengaduan->lokasi_nama }}</dd>
            </div>
            <div>
                <dt class="text-slate-400 mb-1">Tanggal Kejadian</dt>
                <dd class="font-semibold text-slate-800">{{ $pengaduan->tanggal_kejadian->translatedFormat('d F Y') }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-slate-400 mb-1">Deskripsi</dt>
                <dd class="text-slate-700 whitespace-pre-line">{{ $pengaduan->deskripsi }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-slate-400 mb-2">Bukti Foto / Video</dt>
                <dd><x-media-evidence :pengaduan="$pengaduan" /></dd>
            </div>
        </dl>
    </div>

    {{-- Penanggung jawab perbaikan --}}
    @if (in_array($pengaduan->status, ['diproses', 'selesai']))
        <div id="penugasan" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <div class="flex items-start justify-between gap-3 mb-4">
                <h3 class="font-bold text-slate-800">Teknisi Penanggung Jawab</h3>
                @if ($pengaduan->tahapPerbaikan())
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">{{ $pengaduan->tahapPerbaikan() }}</span>
                @endif
            </div>

            @if ($pengaduan->teknisi)
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-11 h-11 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center"><x-icon name="wrench" class="w-5 h-5" /></div>
                    <div>
                        <p class="font-semibold text-slate-800">{{ $pengaduan->teknisi->name }}</p>
                        <p class="text-xs text-slate-500">
                            @if ($pengaduan->teknisi->no_hp) {{ $pengaduan->teknisi->no_hp }} &middot; @endif
                            Target selesai: {{ $pengaduan->target_selesai?->translatedFormat('d F Y') ?? 'belum ditentukan' }}
                            @if ($pengaduan->terlambat()) <span class="text-red-600 font-semibold">(terlambat)</span> @endif
                        </p>
                    </div>
                </div>
            @elseif ($pengaduan->status === 'diproses')
                <p class="text-sm text-amber-700 bg-amber-50 border border-amber-100 rounded-xl px-4 py-3">Belum ada teknisi yang ditugaskan untuk pengaduan ini.</p>
            @else
                <p class="text-sm text-slate-500">Pengaduan ini diselesaikan tanpa penugasan teknisi.</p>
            @endif

            @if ($pengaduan->status === 'diproses')
                <form method="POST" action="{{ route('admin.pengaduan.teknisi', $pengaduan) }}" class="mt-5 pt-5 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @csrf @method('PATCH')
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">{{ $pengaduan->teknisi ? 'Ganti teknisi' : 'Pilih teknisi' }}</label>
                        <select name="teknisi_id" required class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                            <option value="">-- Pilih teknisi --</option>
                            @foreach ($teknisis as $t)
                                <option value="{{ $t->id }}" @selected($pengaduan->teknisi_id === $t->id)>{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Target selesai</label>
                        <input type="date" name="target_selesai" min="{{ now()->format('Y-m-d') }}" value="{{ $pengaduan->target_selesai?->format('Y-m-d') }}"
                               class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                    </div>
                    <input type="text" name="catatan" maxlength="500" placeholder="Arahan untuk teknisi (opsional)"
                           class="sm:col-span-2 w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                    <div class="sm:col-span-2">
                        <button type="submit" class="bg-brand-600 hover:bg-brand-700 transition text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                            {{ $pengaduan->teknisi ? 'Simpan Penugasan' : 'Tugaskan Teknisi' }}
                        </button>
                    </div>
                </form>
            @endif
        </div>
    @endif

    {{-- Riwayat perbaikan --}}
    @if (in_array($pengaduan->status, ['diproses', 'selesai']))
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-5">Riwayat Perbaikan</h3>
            <x-perbaikan-timeline :pengaduan="$pengaduan" kosong="Belum ada riwayat perbaikan. Tugaskan teknisi agar progres tercatat di sini." />
        </div>
    @endif

    @if ($pengaduan->status === 'diajukan')
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-1">Tindak Lanjut</h3>
            <p class="text-sm text-slate-500 mb-5">Terima pengaduan (sekaligus tugaskan teknisi) atau tolak dengan alasan.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" data-modal="modal-terima" data-action="{{ route('admin.pengaduan.status', $pengaduan) }}" data-nama="{{ $pengaduan->kode }}"
                        class="bg-brand-600 hover:bg-brand-700 transition text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">Terima &amp; Tugaskan</button>
                <button type="button" data-modal="modal-tolak" data-action="{{ route('admin.pengaduan.status', $pengaduan) }}" data-nama="{{ $pengaduan->kode }}"
                        class="border border-red-200 text-red-600 hover:bg-red-50 transition font-semibold px-6 py-2.5 rounded-xl">Tolak Pengaduan</button>
            </div>
        </div>
    @elseif ($pengaduan->status === 'diproses')
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-1">Selesaikan Langsung</h3>
            <p class="text-sm text-slate-500 mb-4">Biasanya teknisi yang menandai selesai. Admin juga dapat menyelesaikan langsung bila perlu.</p>
            <form method="POST" action="{{ route('admin.pengaduan.status', $pengaduan) }}" class="space-y-3">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="selesai">
                <textarea name="catatan_admin" rows="2" placeholder="Catatan penyelesaian (opsional)..."
                          class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">{{ $pengaduan->catatan_admin }}</textarea>
                <button type="submit" class="bg-green-600 hover:bg-green-700 transition text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-green-600/30">Tandai Selesai</button>
            </form>
        </div>
    @endif

    @if ($pengaduan->catatan_admin && $pengaduan->status !== 'diproses')
        <div class="bg-white rounded-2xl shadow-sm border {{ $pengaduan->status === 'ditolak' ? 'border-red-100' : 'border-slate-100' }} p-5 sm:p-8">
            <h3 class="font-bold text-slate-800 mb-2">{{ $pengaduan->status === 'ditolak' ? 'Alasan Penolakan' : 'Catatan Admin' }}</h3>
            <p class="text-slate-700 text-sm whitespace-pre-line">{{ $pengaduan->catatan_admin }}</p>
        </div>
    @endif

    <a href="{{ route('admin.pengaduan.index') }}" class="text-sm font-semibold text-brand-600 hover:underline">&larr; Kembali ke daftar</a>
</div>
@include('admin.pengaduan._modals')
@endsection
