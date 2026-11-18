@php($title = 'Profil Saya')
@php($subtitle = 'Kelola informasi akun dan kata sandi Anda')
@extends('layouts.app')

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
        <h3 class="font-bold text-slate-800 mb-1">Informasi Akun</h3>
        <p class="text-sm text-slate-500 mb-5">
            @if ($user->dataTerkunci())
                Data diri dikelola oleh admin sekolah. Anda hanya dapat mengubah nomor HP.
            @else
                Perbarui nama, email, dan data kontak Anda.
            @endif
        </p>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            @if ($user->dataTerkunci())
                {{-- Data diri: hanya tampil, tidak bisa diubah siswa --}}
                @php($kunci = 'w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-500 cursor-not-allowed')
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" value="{{ $user->name }}" readonly tabindex="-1" class="{{ $kunci }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" value="{{ $user->email }}" readonly tabindex="-1" class="{{ $kunci }}">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ $user->isSiswa() ? 'NIS' : 'NIP / ID Pegawai' }}</label>
                        <input type="text" value="{{ $user->nis_nip ?: '-' }}" readonly tabindex="-1" class="{{ $kunci }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">{{ $user->isSiswa() ? 'Kelas' : 'Peran' }}</label>
                        <input type="text" value="{{ $user->isSiswa() ? ($user->kelas ?: '-') : $user->roleLabel() }}" readonly tabindex="-1" class="{{ $kunci }}">
                    </div>
                </div>
                <p class="text-xs text-slate-400">Jika ada data yang salah, hubungi admin sekolah untuk memperbaikinya.</p>
            @else
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
                </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. HP @if ($user->dataTerkunci()) <span class="font-normal text-brand-600">(dapat diubah)</span> @endif</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" inputmode="tel" maxlength="20" placeholder="Contoh: 081234567890"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
        <h3 class="font-bold text-slate-800 mb-1">Ubah Kata Sandi</h3>
        <p class="text-sm text-slate-500 mb-5">Gunakan kata sandi yang kuat dan tidak dipakai di tempat lain.</p>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" required
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" required minlength="8"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 outline-none">
            </div>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-brand-600/30">
                Perbarui Kata Sandi
            </button>
        </form>
    </div>
</div>
@endsection
