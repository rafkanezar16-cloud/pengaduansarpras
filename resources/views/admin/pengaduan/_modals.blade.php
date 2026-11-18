{{-- Dua dialog: Tolak (alasan penolakan) dan Terima & Tugaskan teknisi. Dipakai bersama oleh daftar pengaduan. --}}
@php($inp = 'w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none')

{{-- ============ MODAL: TOLAK ============ --}}
<div id="modal-tolak" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true" aria-labelledby="tolak-judul">
    <div data-modal-close class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
    <form method="POST" action="#" id="form-tolak"
          class="anim-pop relative w-full sm:max-w-lg bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[92vh] overflow-y-auto">
        @csrf @method('PATCH')
        <input type="hidden" name="status" value="ditolak">

        <div class="px-6 pt-6 pb-4 flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                <x-icon name="alert" class="w-6 h-6" />
            </div>
            <div class="min-w-0 flex-1">
                <h3 id="tolak-judul" class="text-lg font-extrabold text-slate-900">Tolak pengaduan ini?</h3>
                <p class="text-sm text-slate-500 mt-0.5">Pengaduan <span id="tolak-nama" class="font-semibold text-slate-700"></span> akan ditandai <strong>Ditolak</strong>. Alasan Anda akan terlihat oleh siswa.</p>
            </div>
            <button type="button" data-modal-close class="p-1.5 -mr-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600" aria-label="Tutup">
                <x-icon name="x" class="w-5 h-5" />
            </button>
        </div>

        <div class="px-6 pb-2">
            <p class="text-xs font-semibold text-slate-500 mb-2">Pilih alasan cepat</p>
            <div class="flex flex-wrap gap-2" id="tolak-chips">
                @foreach (['Laporan duplikat', 'Foto bukti kurang jelas', 'Bukan kerusakan sarana sekolah', 'Informasi lokasi tidak sesuai', 'Kerusakan sudah ditangani'] as $alasan)
                    <button type="button" data-alasan="{{ $alasan }}"
                            class="px-3 py-1.5 rounded-full border border-slate-200 text-xs font-medium text-slate-600 hover:border-red-300 hover:bg-red-50 hover:text-red-700 transition">{{ $alasan }}</button>
                @endforeach
            </div>

            <label for="tolak-catatan" class="block text-sm font-semibold text-slate-700 mt-4 mb-1.5">Alasan penolakan <span class="font-normal text-slate-400">(opsional)</span></label>
            <textarea id="tolak-catatan" name="catatan_admin" rows="4" maxlength="1000" placeholder="Tulis alasan agar siswa paham mengapa pengaduannya ditolak..." class="{{ $inp }}"></textarea>
            <p class="text-right text-xs text-slate-400 mt-1"><span id="tolak-hitung">0</span>/1000</p>
        </div>

        <div class="px-6 py-4 bg-slate-50 flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
            <button type="button" data-modal-close class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-sm font-semibold text-white shadow-lg shadow-red-600/25">Ya, Tolak Pengaduan</button>
        </div>
    </form>
</div>

{{-- ============ MODAL: TERIMA & TUGASKAN ============ --}}
<div id="modal-terima" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true" aria-labelledby="terima-judul">
    <div data-modal-close class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
    <form method="POST" action="#" id="form-terima"
          class="anim-pop relative w-full sm:max-w-lg bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[92vh] overflow-y-auto">
        @csrf @method('PATCH')
        <input type="hidden" name="status" value="diproses">

        <div class="px-6 pt-6 pb-4 flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                <x-icon name="wrench" class="w-6 h-6" />
            </div>
            <div class="min-w-0 flex-1">
                <h3 id="terima-judul" class="text-lg font-extrabold text-slate-900">Terima &amp; tugaskan teknisi</h3>
                <p class="text-sm text-slate-500 mt-0.5">Pengaduan <span id="terima-nama" class="font-semibold text-slate-700"></span> akan berstatus <strong>Diproses</strong>.</p>
            </div>
            <button type="button" data-modal-close class="p-1.5 -mr-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600" aria-label="Tutup">
                <x-icon name="x" class="w-5 h-5" />
            </button>
        </div>

        <div class="px-6 pb-4 space-y-4">
            <div>
                <label for="terima-teknisi" class="block text-sm font-semibold text-slate-700 mb-1.5">Teknisi <span class="font-normal text-slate-400">(opsional)</span></label>
                <select id="terima-teknisi" name="teknisi_id" class="{{ $inp }}">
                    <option value="">Belum ditugaskan (tentukan nanti)</option>
                    @foreach ($teknisis as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
                @if ($teknisis->isEmpty())
                    <p class="text-xs text-amber-600 mt-1">Belum ada akun teknisi. Tambahkan lewat Master Data &rarr; Pengguna.</p>
                @endif
            </div>
            <div>
                <label for="terima-target" class="block text-sm font-semibold text-slate-700 mb-1.5">Target selesai <span class="font-normal text-slate-400">(opsional)</span></label>
                <input id="terima-target" type="date" name="target_selesai" min="{{ now()->format('Y-m-d') }}" class="{{ $inp }}">
            </div>
            <div>
                <label for="terima-catatan" class="block text-sm font-semibold text-slate-700 mb-1.5">Catatan <span class="font-normal text-slate-400">(opsional)</span></label>
                <textarea id="terima-catatan" name="catatan_admin" rows="3" maxlength="1000" placeholder="Arahan untuk teknisi atau informasi untuk siswa..." class="{{ $inp }}"></textarea>
            </div>
        </div>

        <div class="px-6 py-4 bg-slate-50 flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
            <button type="button" data-modal-close class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-600 hover:bg-slate-100">Batal</button>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-sm font-semibold text-white shadow-lg shadow-brand-600/25">Terima Pengaduan</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
(function () {
    var lastFocus = null;
    function open(id, url, nama) {
        var m = document.getElementById(id);
        if (!m) return;
        lastFocus = document.activeElement;
        var form = m.querySelector('form'); form.action = url;
        m.querySelector('[id$="-nama"]').textContent = nama;
        m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow = 'hidden';
        var first = m.querySelector('textarea, select'); if (first) setTimeout(function () { first.focus(); }, 60);
    }
    function close() {
        document.querySelectorAll('#modal-tolak, #modal-terima').forEach(function (m) { m.classList.add('hidden'); m.classList.remove('flex'); });
        document.body.style.overflow = '';
        if (lastFocus) lastFocus.focus();
    }
    document.addEventListener('click', function (e) {
        var t = e.target.closest('[data-modal]');
        if (t) { e.preventDefault(); open(t.getAttribute('data-modal'), t.getAttribute('data-action'), t.getAttribute('data-nama')); return; }
        if (e.target.closest('[data-modal-close]')) { close(); return; }
        var chip = e.target.closest('[data-alasan]');
        if (chip) {
            var ta = document.getElementById('tolak-catatan');
            ta.value = chip.getAttribute('data-alasan'); ta.dispatchEvent(new Event('input')); ta.focus();
        }
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
    var ta = document.getElementById('tolak-catatan'), n = document.getElementById('tolak-hitung');
    ta.addEventListener('input', function () { n.textContent = ta.value.length; });
})();
</script>
@endpush
