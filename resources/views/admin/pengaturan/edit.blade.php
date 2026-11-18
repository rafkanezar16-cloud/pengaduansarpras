@php($title = 'Pengaturan Website')
@php($subtitle = 'Ubah nama, logo, dan warna tampilan website')
@extends('layouts.app')

@section('content')
@php($warnaAktif = old('warna', $setting['warna']))
@php($customAktif = old('warna_custom', $setting['warna_custom']))

<div class="grid grid-cols-1 xl:grid-cols-3 gap-5 anim-up">

    {{-- ================= FORM ================= --}}
    <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data"
          class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-8 space-y-7">
        @csrf
        @method('PUT')

        {{-- Identitas --}}
        <section class="space-y-4">
            <h3 class="font-bold text-slate-800">Identitas Website</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nama_aplikasi" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Website</label>
                    <input id="nama_aplikasi" type="text" name="nama_aplikasi" maxlength="40" required
                           value="{{ old('nama_aplikasi', $setting['nama_aplikasi']) }}"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
                </div>
                <div>
                    <label for="nama_sekolah" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Sekolah</label>
                    <input id="nama_sekolah" type="text" name="nama_sekolah" maxlength="80" required
                           value="{{ old('nama_sekolah', $setting['nama_sekolah']) }}"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
                </div>
            </div>
            <div>
                <label for="slogan" class="block text-sm font-semibold text-slate-700 mb-1.5">Slogan <span class="font-normal text-slate-400">(di bawah nama website)</span></label>
                <input id="slogan" type="text" name="slogan" maxlength="80"
                       value="{{ old('slogan', $setting['slogan']) }}"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
            </div>
            <div>
                <label for="teks_login" class="block text-sm font-semibold text-slate-700 mb-1.5">Teks di Halaman Login</label>
                <input id="teks_login" type="text" name="teks_login" maxlength="120"
                       value="{{ old('teks_login', $setting['teks_login']) }}"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
            </div>
        </section>

        {{-- Logo --}}
        <section class="space-y-3">
            <h3 class="font-bold text-slate-800">Logo</h3>
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden shrink-0">
                    <img id="logo-preview" src="{{ \App\Models\Pengaturan::logoUrl() }}" alt="Logo saat ini" class="w-16 h-16 object-contain">
                </div>
                <div class="min-w-0">
                    <input type="file" name="logo" id="logo" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                           class="block w-full text-sm text-slate-500 file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-brand-700 hover:file:bg-brand-100">
                    <p class="text-xs text-slate-400 mt-1.5">PNG, JPG, WEBP, atau SVG. Maksimal 1 MB. Disarankan persegi.</p>
                    @if ($setting['logo'])
                        <label class="mt-2 inline-flex items-center gap-2 text-xs text-slate-600">
                            <input type="checkbox" name="hapus_logo" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            Hapus logo ini dan pakai logo bawaan
                        </label>
                    @endif
                </div>
            </div>
        </section>

        {{-- Warna --}}
        <section class="space-y-3">
            <h3 class="font-bold text-slate-800">Warna Utama</h3>
            <p class="text-xs text-slate-500 -mt-1">Dipakai pada sidebar, tombol, menu aktif, dan tautan. Warna status (hijau, kuning, merah) tidak ikut berubah.</p>

            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                @foreach ($presets as $key => $preset)
                    <label class="cursor-pointer">
                        <input type="radio" name="warna" value="{{ $key }}" class="peer sr-only warna-radio" data-hex="{{ $preset['shades'][600] }}" data-dark="{{ $preset['shades'][900] }}" @checked($warnaAktif === $key)>
                        <div class="rounded-xl border-2 border-slate-200 p-2.5 text-center transition peer-checked:border-slate-800 peer-checked:shadow-md peer-focus-visible:ring-2 peer-focus-visible:ring-slate-400">
                            <div class="h-9 rounded-lg" style="background: linear-gradient(135deg, {{ $preset['shades'][600] }}, {{ $preset['shades'][900] }})"></div>
                            <p class="text-xs font-semibold text-slate-700 mt-2">{{ $preset['label'] }}</p>
                        </div>
                    </label>
                @endforeach

                <label class="cursor-pointer">
                    <input type="radio" name="warna" value="custom" class="peer sr-only warna-radio" id="warna-custom-radio" @checked($warnaAktif === 'custom')>
                    <div class="rounded-xl border-2 border-slate-200 p-2.5 text-center transition peer-checked:border-slate-800 peer-checked:shadow-md peer-focus-visible:ring-2 peer-focus-visible:ring-slate-400">
                        <div class="h-9 rounded-lg flex items-center justify-center" id="custom-swatch" style="background: {{ $customAktif }}">
                            <input type="color" id="custom-picker" value="{{ $customAktif }}" class="w-full h-full opacity-0 cursor-pointer" aria-label="Pilih warna sendiri">
                        </div>
                        <p class="text-xs font-semibold text-slate-700 mt-2">Pilih sendiri</p>
                    </div>
                </label>
            </div>
            <input type="hidden" name="warna_custom" id="warna_custom" value="{{ $customAktif }}">
        </section>

        <div class="flex flex-col-reverse sm:flex-row gap-3 pt-2 border-t border-slate-100">
            <button type="submit" form="form-reset" class="sm:flex-none px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50"
                    onclick="return confirm('Kembalikan semua pengaturan ke bawaan?')">Kembalikan ke Bawaan</button>
            <button type="submit" class="flex-1 bg-brand-600 hover:bg-brand-700 transition text-white font-semibold py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                Simpan Pengaturan
            </button>
        </div>
    </form>
    <form id="form-reset" method="POST" action="{{ route('admin.pengaturan.reset') }}" class="hidden">@csrf</form>

    {{-- ================= PRATINJAU ================= --}}
    <aside class="xl:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 xl:sticky xl:top-24">
            <h3 class="font-bold text-slate-800 mb-1">Pratinjau</h3>
            <p class="text-xs text-slate-500 mb-4">Contoh tampilan sebelum disimpan.</p>

            <div class="rounded-2xl overflow-hidden border border-slate-200">
                <div id="pv-side" class="p-4 text-white" style="background: linear-gradient(160deg, {{ $presets[$warnaAktif]['shades'][950] ?? '#111827' }}, {{ $presets[$warnaAktif]['shades'][900] ?? '#111827' }})">
                    <div class="flex items-center gap-3">
                        <img id="pv-logo" src="{{ \App\Models\Pengaturan::logoUrl() }}" alt="" class="w-10 h-10 object-contain">
                        <div class="min-w-0">
                            <p id="pv-nama" class="font-extrabold leading-tight truncate">{{ old('nama_aplikasi', $setting['nama_aplikasi']) }}</p>
                            <p id="pv-slogan" class="text-[11px] opacity-70 leading-tight truncate">{{ old('slogan', $setting['slogan']) }}</p>
                        </div>
                    </div>
                    <div id="pv-menu" class="mt-4 rounded-lg px-3 py-2 text-sm font-medium" style="background: {{ $presets[$warnaAktif]['shades'][600] ?? $customAktif }}">Dashboard</div>
                    <div class="mt-1 rounded-lg px-3 py-2 text-sm opacity-70">Ajukan Pengaduan</div>
                </div>
                <div class="p-4 bg-slate-50">
                    <span id="pv-btn" class="inline-block rounded-lg px-4 py-2 text-sm font-semibold text-white" style="background: {{ $presets[$warnaAktif]['shades'][600] ?? $customAktif }}">Kirim Pengaduan</span>
                </div>
            </div>
            <p id="pv-sekolah" class="text-[11px] text-slate-400 mt-3">{{ old('nama_sekolah', $setting['nama_sekolah']) }}</p>
        </div>
    </aside>
</div>
@endsection

@push('scripts')
<script>
(function () {
    function $(id) { return document.getElementById(id); }
    function mix(hex, to, t) {
        var n = parseInt(hex.slice(1), 16), r = n >> 16, g = (n >> 8) & 255, b = n & 255;
        function m(c) { return Math.round(c + (to - c) * t); }
        return '#' + [m(r), m(g), m(b)].map(function (v) { return v.toString(16).padStart(2, '0'); }).join('');
    }
    function paint(hex, dark, darkest) {
        $('pv-side').style.background = 'linear-gradient(160deg,' + darkest + ',' + dark + ')';
        $('pv-menu').style.background = hex;
        $('pv-btn').style.background = hex;
    }
    function applyRadio(r) {
        if (r.value === 'custom') {
            var c = $('custom-picker').value;
            paint(c, mix(c, 0, .45), mix(c, 0, .62));
        } else {
            var h = r.getAttribute('data-hex');
            paint(h, r.getAttribute('data-dark'), mix(h, 0, .62));
        }
    }
    document.querySelectorAll('.warna-radio').forEach(function (r) {
        r.addEventListener('change', function () { applyRadio(r); });
    });
    var picker = $('custom-picker');
    picker.addEventListener('input', function () {
        $('custom-swatch').style.background = picker.value;
        $('warna_custom').value = picker.value;
        $('warna-custom-radio').checked = true;
        applyRadio($('warna-custom-radio'));
    });
    var checked = document.querySelector('.warna-radio:checked');
    if (checked) applyRadio(checked);

    // teks langsung
    [['nama_aplikasi', 'pv-nama'], ['slogan', 'pv-slogan'], ['nama_sekolah', 'pv-sekolah']].forEach(function (p) {
        $(p[0]).addEventListener('input', function () { $(p[1]).textContent = this.value; });
    });

    // pratinjau logo
    $('logo').addEventListener('change', function () {
        var f = this.files[0];
        if (!f) return;
        var url = URL.createObjectURL(f);
        $('logo-preview').src = url; $('pv-logo').src = url;
    });
})();
</script>
@endpush
