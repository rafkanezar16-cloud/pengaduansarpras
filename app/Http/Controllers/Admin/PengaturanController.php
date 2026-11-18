<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    public function edit(): View
    {
        return view('admin.pengaturan.edit', [
            'presets' => Pengaturan::PRESETS,
            'setting' => Pengaturan::semua(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_aplikasi' => ['required', 'string', 'max:40'],
            'slogan' => ['nullable', 'string', 'max:80'],
            'nama_sekolah' => ['required', 'string', 'max:80'],
            'teks_login' => ['nullable', 'string', 'max:120'],
            'warna' => ['required', Rule::in([...array_keys(Pengaturan::PRESETS), 'custom'])],
            'warna_custom' => ['nullable', 'required_if:warna,custom', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:1024'],
        ], [
            'warna_custom.regex' => 'Warna kustom harus berformat hex, contoh #2563eb.',
            'logo.max' => 'Ukuran logo maksimal 1 MB.',
        ]);

        foreach (['nama_aplikasi', 'slogan', 'nama_sekolah', 'teks_login', 'warna'] as $key) {
            Pengaturan::simpan($key, $validated[$key] ?? null);
        }

        if (! empty($validated['warna_custom'])) {
            Pengaturan::simpan('warna_custom', strtolower($validated['warna_custom']));
        }

        // Logo: unggah baru / hapus kembali ke logo bawaan
        if ($request->hasFile('logo')) {
            $this->hapusLogoLama();
            $file = $request->file('logo');
            $name = 'logo_'.time().'_'.Str::random(6).'.'.strtolower($file->getClientOriginalExtension());
            $file->move(public_path('uploads/pengaturan'), $name);
            Pengaturan::simpan('logo', 'uploads/pengaturan/'.$name);
        } elseif ($request->boolean('hapus_logo')) {
            $this->hapusLogoLama();
            Pengaturan::simpan('logo', null);
        }

        return redirect()->route('admin.pengaturan.edit')->with('status', 'pengaturan-updated');
    }

    public function reset(): RedirectResponse
    {
        $this->hapusLogoLama();
        Pengaturan::reset();

        return redirect()->route('admin.pengaturan.edit')->with('status', 'pengaturan-reset');
    }

    private function hapusLogoLama(): void
    {
        $logo = Pengaturan::ambil('logo');

        if ($logo && str_starts_with($logo, 'uploads/pengaturan/') && is_file(public_path($logo))) {
            @unlink(public_path($logo));
        }
    }
}
