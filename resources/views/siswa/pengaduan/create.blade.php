@php($title = 'Ajukan Pengaduan')
@php($subtitle = 'Laporkan kerusakan sarana atau fasilitas sekolah')
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mb-4 flex items-start gap-3 rounded-xl bg-brand-50 border border-brand-100 px-4 py-3 text-sm text-brand-900">
    <x-icon name="help" class="w-5 h-5 shrink-0 mt-0.5 text-brand-600" />
    <p>Isi data dengan jelas dan sertakan <strong>foto</strong> agar laporan cepat diproses. Bingung? <a href="{{ route('siswa.panduan') }}" class="font-semibold underline">Buka panduan</a>.</p>
</div>
<div class="anim-up max-w-2xl bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8">
    <form method="POST" action="{{ route('siswa.pengaduan.store') }}" enctype="multipart/form-data" class="space-y-5" id="form-pengaduan">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Kerusakan</label>
                <select name="kategori_kerusakan_id" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
                    <option value="">-- Pilih kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @selected(old('kategori_kerusakan_id') == $kategori->id)>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi / Ruangan</label>
                <select name="lokasi_id" id="lokasi_id" required
                        class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
                    <option value="">-- Pilih lokasi --</option>
                    @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id }}" @selected((string) old('lokasi_id') === (string) $lokasi->id)>{{ $lokasi->nama }}@if($lokasi->gedung) ({{ $lokasi->gedung }})@endif</option>
                    @endforeach
                    <option value="lainnya" @selected(old('lokasi_id') === 'lainnya')>Lokasi lainnya (ketik sendiri)...</option>
                </select>
            </div>
        </div>

        {{-- Muncul hanya jika memilih "Lokasi lainnya" --}}
        <div id="wrap-lainnya" class="{{ old('lokasi_id') === 'lainnya' ? '' : 'hidden' }}">
            <label for="lokasi_lainnya" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lokasi Lainnya</label>
            <input type="text" name="lokasi_lainnya" id="lokasi_lainnya" value="{{ old('lokasi_lainnya') }}" maxlength="100"
                   placeholder="Contoh: Taman Sekolah, Area Parkir, Toilet Lantai 2"
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
            <p class="text-xs text-slate-400 mt-1">Ketik nama ruangan atau tempat yang tidak ada di daftar.</p>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Kejadian</label>
            <input type="date" name="tanggal_kejadian" value="{{ old('tanggal_kejadian', now()->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}" required
                   class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Masalah</label>
            <textarea name="deskripsi" rows="4" required minlength="10" placeholder="Contoh: Keran wastafel toilet putra lantai 1 bocor terus sejak Senin, air menggenang di lantai."
                      class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">{{ old('deskripsi') }}</textarea>
            <p class="text-xs text-slate-400 mt-1.5">Sebut apa yang rusak, di mana tepatnya, dan seberapa parah.</p>
        </div>

        {{-- ===== FOTO ===== --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Foto Bukti Kerusakan <span class="text-red-500">*</span> <span class="font-normal text-slate-400">(wajib, maks 2 MB)</span></label>
            <label id="drop-foto" class="relative flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-xl min-h-[130px] cursor-pointer hover:border-brand-400 hover:bg-brand-50/50 transition overflow-hidden">
                <img id="preview-foto" alt="Pratinjau foto" class="hidden absolute inset-0 w-full h-full object-cover">
                <div id="hint-foto" class="flex flex-col items-center gap-2 py-6 px-4 text-center">
                    <x-icon name="photo" class="w-8 h-8 text-slate-400" />
                    <span class="text-sm text-slate-500">Klik atau seret foto ke sini</span>
                </div>
                <input type="file" name="foto" id="input-foto" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 pointer-events-none" tabindex="-1">
            </label>
            <div id="info-foto" class="hidden mt-2 flex items-center justify-between text-xs text-slate-500">
                <span id="name-foto" class="truncate"></span>
                <button type="button" id="clear-foto" class="text-red-600 font-semibold hover:underline shrink-0 ml-3">Hapus</button>
            </div>
        </div>

        {{-- ===== VIDEO ===== --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Video Bukti Singkat <span class="font-normal text-slate-400">(opsional, MP4/WebM/MOV, maks 10 MB)</span></label>
            <label id="drop-video" class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-xl py-6 px-4 text-center cursor-pointer hover:border-brand-400 hover:bg-brand-50/50 transition">
                <x-icon name="video" class="w-8 h-8 text-slate-400" />
                <span id="hint-video" class="text-sm text-slate-500">Klik atau seret video ke sini</span>
                <input type="file" name="video" id="input-video" accept="video/mp4,video/webm,video/quicktime" class="hidden">
            </label>
            <div id="wrap-video" class="hidden mt-3">
                <video id="preview-video" controls playsinline class="w-full max-h-64 rounded-xl bg-black"></video>
                <button type="button" id="clear-video" class="mt-2 text-xs text-red-600 font-semibold hover:underline">Hapus video</button>
            </div>
        </div>

        <p id="file-error" class="hidden text-sm font-medium text-red-600"></p>

        <div class="flex flex-col-reverse sm:flex-row gap-3 pt-2">
            <a href="{{ route('siswa.dashboard') }}" class="flex-1 text-center border border-slate-200 text-slate-600 font-semibold py-2.5 rounded-xl hover:bg-slate-50 transition">Batal</a>
            <button type="submit" id="btn-submit"
                    class="flex-1 bg-brand-600 hover:bg-brand-700 transition text-white font-semibold py-2.5 rounded-xl shadow-lg shadow-brand-600/30 disabled:opacity-60">
                Kirim Pengaduan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var MAX_FOTO = 2 * 1024 * 1024, MAX_VIDEO = 10 * 1024 * 1024;
    var err = document.getElementById('file-error');
    function showErr(m) { err.textContent = m; err.classList.remove('hidden'); }
    function clearErr() { err.classList.add('hidden'); }

    function setup(kind, max, label, onFile, onClear) {
        var input = document.getElementById('input-' + kind);
        var drop = document.getElementById('drop-' + kind);

        function handle(file) {
            clearErr();
            if (!file) return;
            if (file.size > max) { input.value = ''; onClear(); showErr(label + ' terlalu besar (maks ' + (max / 1048576) + ' MB).'); return; }
            onFile(file);
        }
        input.addEventListener('change', function () { handle(input.files[0]); });

        ['dragenter', 'dragover'].forEach(function (ev) {
            drop.addEventListener(ev, function (e) { e.preventDefault(); drop.classList.add('border-brand-500', 'bg-brand-50'); });
        });
        ['dragleave', 'drop'].forEach(function (ev) {
            drop.addEventListener(ev, function (e) { e.preventDefault(); drop.classList.remove('border-brand-500', 'bg-brand-50'); });
        });
        drop.addEventListener('drop', function (e) {
            if (e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                handle(input.files[0]);
            }
        });
        return input;
    }

    // ---- Foto ----
    var pf = document.getElementById('preview-foto'), hf = document.getElementById('hint-foto'),
        inf = document.getElementById('info-foto'), nf = document.getElementById('name-foto');
    function clearFoto() {
        document.getElementById('input-foto').value = '';
        pf.classList.add('hidden'); pf.removeAttribute('src'); hf.classList.remove('hidden'); inf.classList.add('hidden');
    }
    setup('foto', MAX_FOTO, 'Foto', function (file) {
        if (!file.type.startsWith('image/')) { clearFoto(); showErr('Berkas harus berupa gambar.'); return; }
        var r = new FileReader();
        r.onload = function (e) { pf.src = e.target.result; pf.classList.remove('hidden'); hf.classList.add('hidden'); };
        r.readAsDataURL(file);
        nf.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
        inf.classList.remove('hidden');
    }, clearFoto);
    document.getElementById('clear-foto').addEventListener('click', function (e) { e.preventDefault(); clearFoto(); });

    // ---- Video ----
    var pv = document.getElementById('preview-video'), wv = document.getElementById('wrap-video'),
        hv = document.getElementById('hint-video'), urlVideo = null;
    function clearVideo() {
        document.getElementById('input-video').value = '';
        if (urlVideo) { URL.revokeObjectURL(urlVideo); urlVideo = null; }
        pv.removeAttribute('src'); pv.load(); wv.classList.add('hidden');
        hv.textContent = 'Klik atau seret video ke sini';
    }
    setup('video', MAX_VIDEO, 'Video', function (file) {
        if (!file.type.startsWith('video/')) { clearVideo(); showErr('Berkas harus berupa video.'); return; }
        if (urlVideo) URL.revokeObjectURL(urlVideo);
        urlVideo = URL.createObjectURL(file);
        pv.src = urlVideo; wv.classList.remove('hidden');
        hv.textContent = file.name + ' (' + (file.size / 1048576).toFixed(1) + ' MB) - klik untuk ganti';
    }, clearVideo);
    document.getElementById('clear-video').addEventListener('click', clearVideo);

    // ---- Lokasi lainnya: tampilkan kolom ketik sendiri ----
    var selLokasi = document.getElementById('lokasi_id'), wrapLain = document.getElementById('wrap-lainnya'),
        inLain = document.getElementById('lokasi_lainnya');
    function toggleLain() {
        var on = selLokasi.value === 'lainnya';
        wrapLain.classList.toggle('hidden', !on);
        inLain.required = on;
        if (on) { inLain.focus(); }
    }
    selLokasi.addEventListener('change', toggleLain);
    inLain.required = selLokasi.value === 'lainnya';

    // ---- Cegah kirim ganda ----
    document.getElementById('form-pengaduan').addEventListener('submit', function () {
        var b = document.getElementById('btn-submit');
        b.disabled = true; b.textContent = 'Mengirim...';
    });
})();
</script>
@endpush
