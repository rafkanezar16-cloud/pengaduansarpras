@if ($item->status === 'diproses' || ($item->status === 'selesai' && $item->teknisi))
    <p class="text-xs mt-1.5 {{ $item->status === 'diproses' && ! $item->teknisi_id ? 'text-amber-600 font-semibold' : 'text-slate-500' }}">
        @if ($item->teknisi)
            <span class="inline-flex items-center gap-1"><x-icon name="wrench" class="w-3.5 h-3.5" /> {{ $item->teknisi->name }}</span>
            @if ($item->status === 'diproses' && $item->tahapPerbaikan()) &middot; {{ $item->tahapPerbaikan() }} @endif
            @if ($item->terlambat()) <span class="text-red-600 font-semibold">&middot; terlambat</span> @endif
        @else
            {{ $item->tahapPerbaikan() }}
        @endif
    </p>
@endif
