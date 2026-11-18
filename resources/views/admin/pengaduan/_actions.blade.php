@if ($item->status === 'diajukan')
    <button type="button" data-modal="modal-terima" data-action="{{ route('admin.pengaduan.status', $item) }}" data-nama="{{ $item->kode }}"
            class="px-3 py-1.5 rounded-lg border border-brand-200 text-brand-600 text-xs font-semibold hover:bg-brand-50">Terima</button>
    <button type="button" data-modal="modal-tolak" data-action="{{ route('admin.pengaduan.status', $item) }}" data-nama="{{ $item->kode }}"
            class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 text-xs font-semibold hover:bg-red-50">Tolak</button>
@elseif ($item->status === 'diproses')
    @if (! $item->teknisi_id)
        <a href="{{ route('admin.pengaduan.show', $item) }}#penugasan" class="px-3 py-1.5 rounded-lg border border-amber-200 text-amber-700 text-xs font-semibold hover:bg-amber-50">Tugaskan</a>
    @endif
    <form method="POST" action="{{ route('admin.pengaduan.status', $item) }}">
        @csrf @method('PATCH')
        <input type="hidden" name="status" value="selesai">
        <button class="px-3 py-1.5 rounded-lg border border-green-200 text-green-600 text-xs font-semibold hover:bg-green-50">Selesaikan</button>
    </form>
@endif
<a href="{{ route('admin.pengaduan.show', $item) }}" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 text-xs font-semibold hover:bg-slate-50">Lihat</a>
