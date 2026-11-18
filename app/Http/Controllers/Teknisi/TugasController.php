<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Perbaikan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TugasController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('tampil', 'aktif'); // aktif | selesai | semua

        $query = $request->user()->tugas()->with(['kategori', 'lokasi', 'user', 'perbaikans']);

        match ($filter) {
            'selesai' => $query->where('status', 'selesai')->latest('selesai_at'),
            'semua' => $query->latest(),
            default => $query->where('status', 'diproses')->orderByRaw('target_selesai IS NULL')->orderBy('target_selesai')->latest(),
        };

        if ($request->filled('q')) {
            $kw = $request->string('q');
            $query->where(function ($sub) use ($kw) {
                $sub->where('kode', 'like', "%{$kw}%")
                    ->orWhere('deskripsi', 'like', "%{$kw}%");
            });
        }

        $tugas = $query->paginate(10)->withQueryString();

        return view('teknisi.tugas.index', compact('tugas', 'filter'));
    }

    public function show(Pengaduan $pengaduan): View
    {
        $this->otorisasi($pengaduan);

        $pengaduan->load(['user', 'kategori', 'lokasi', 'teknisi', 'perbaikans.pencatat']);

        $aktif = $pengaduan->status === 'diproses' && (int) $pengaduan->teknisi_id === (int) auth()->id();
        $sudahMulai = $pengaduan->perbaikans->whereIn('jenis', ['mulai', 'progres'])->isNotEmpty();

        return view('teknisi.tugas.show', compact('pengaduan', 'aktif', 'sudahMulai'));
    }

    /** Mulai mengerjakan. */
    public function mulai(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $this->bolehDikerjakan($pengaduan);

        if ($pengaduan->perbaikans()->whereIn('jenis', ['mulai', 'progres'])->exists()) {
            return back()->with('error', 'Perbaikan ini sudah ditandai mulai dikerjakan.');
        }

        $this->catat($pengaduan, 'mulai', 'Mulai memeriksa dan memperbaiki.');

        return back()->with('status', 'tugas-mulai');
    }

    /** Tambah catatan progres (boleh dengan foto dan bahan yang dipakai). */
    public function catatan(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $this->bolehDikerjakan($pengaduan);

        $data = $request->validate([
            'catatan' => ['required', 'string', 'min:5', 'max:1000'],
            'bahan' => ['nullable', 'string', 'max:150'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ], $this->pesan());

        $this->catat($pengaduan, 'progres', $data['catatan'], $data['bahan'] ?? null, $request);

        return back()->with('status', 'catatan-added');
    }

    /** Tandai selesai diperbaiki: status pengaduan menjadi Selesai. */
    public function selesai(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $this->bolehDikerjakan($pengaduan);

        $data = $request->validate([
            'catatan' => ['required', 'string', 'min:5', 'max:1000'],
            'bahan' => ['nullable', 'string', 'max:150'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ], $this->pesan());

        $this->catat($pengaduan, 'selesai', $data['catatan'], $data['bahan'] ?? null, $request);

        $pengaduan->update(['status' => 'selesai', 'selesai_at' => now()]);

        return redirect()->route('teknisi.tugas.show', $pengaduan)->with('status', 'tugas-selesai');
    }

    /** Kembalikan ke admin bila tidak sanggup / butuh keputusan (mis. perlu vendor). */
    public function kembalikan(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $this->bolehDikerjakan($pengaduan);

        $data = $request->validate([
            'catatan' => ['required', 'string', 'min:5', 'max:1000'],
        ], $this->pesan());

        $this->catat($pengaduan, 'dikembalikan', $data['catatan']);

        $pengaduan->update(['teknisi_id' => null, 'target_selesai' => null]);

        return redirect()->route('teknisi.tugas.index')->with('status', 'tugas-dikembalikan');
    }

    public function riwayat(Request $request): View
    {
        $query = Perbaikan::with(['pengaduan.kategori', 'pengaduan.lokasi'])
            ->where('user_id', $request->user()->id);

        if ($request->filled('jenis') && isset(Perbaikan::JENIS[$request->query('jenis')])) {
            $query->where('jenis', $request->query('jenis'));
        }

        $riwayat = $query->latest()->latest('id')->paginate(12)->withQueryString();

        return view('teknisi.riwayat', compact('riwayat'));
    }

    private function otorisasi(Pengaduan $pengaduan): void
    {
        abort_unless($pengaduan->teknisi_id === auth()->id(), 403, 'Tugas ini bukan milik Anda.');
    }

    private function bolehDikerjakan(Pengaduan $pengaduan): void
    {
        $this->otorisasi($pengaduan);
        abort_unless($pengaduan->status === 'diproses', 422, 'Tugas ini tidak lagi berstatus Diproses.');
    }

    private function catat(Pengaduan $pengaduan, string $jenis, ?string $catatan, ?string $bahan = null, ?Request $request = null): void
    {
        $foto = null;
        if ($request && $request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/perbaikan'), $nama);
            $foto = 'uploads/perbaikan/'.$nama;
        }

        Perbaikan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => auth()->id(),
            'jenis' => $jenis,
            'catatan' => $catatan,
            'bahan' => $bahan,
            'foto' => $foto,
        ]);
    }

    private function pesan(): array
    {
        return [
            'catatan.required' => 'Catatan wajib diisi.',
            'catatan.min' => 'Catatan minimal 5 karakter.',
            'foto.image' => 'Berkas harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ];
    }
}
