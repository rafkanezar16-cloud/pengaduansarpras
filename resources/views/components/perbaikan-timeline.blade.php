@props(['pengaduan', 'kosong' => 'Belum ada riwayat perbaikan.'])

@php $logs = $pengaduan->perbaikans; @endphp

@if ($logs->isEmpty())
    <p class="text-sm text-slate-400">{{ $kosong }}</p>
@else
    <ol class="relative ml-2.5 border-l-2 border-slate-100 space-y-6">
        @foreach ($logs as $log)
            <li class="pl-6 relative">
                <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full ring-4 ring-white {{ $log->dotClass() }}"></span>
                <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $log->chipClass() }}">{{ $log->label() }}</span>
                    <span class="text-xs text-slate-400">{{ $log->created_at->translatedFormat('d M Y, H:i') }}@if ($log->pencatat) &middot; {{ $log->pencatat->name }}@endif</span>
                </div>
                @if ($log->catatan)
                    <p class="text-sm text-slate-700 mt-1.5 whitespace-pre-line">{{ $log->catatan }}</p>
                @endif
                @if ($log->bahan)
                    <p class="text-xs text-slate-500 mt-1"><span class="font-semibold">Bahan / suku cadang:</span> {{ $log->bahan }}</p>
                @endif
                @if ($log->foto)
                    <button type="button" data-lightbox="{{ asset($log->foto) }}" data-type="image" class="mt-2 block" aria-label="Perbesar foto perbaikan">
                        <img src="{{ asset($log->foto) }}" alt="Foto perbaikan" loading="lazy" class="w-28 h-20 object-cover rounded-lg border border-slate-200">
                    </button>
                @endif
            </li>
        @endforeach
    </ol>
@endif
