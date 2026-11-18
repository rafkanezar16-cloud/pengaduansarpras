<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\KategoriKerusakan;
use App\Models\Lokasi;
use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function index(Request $request): View
    {
        $pengaduans = $request->user()
            ->pengaduans()
            ->with(['kategori', 'lokasi'])
            ->latest()
            ->paginate(10);

        return view('siswa.pengaduan.index', compact('pengaduans'));
    }

    public function create(): View
    {
        $kategoris = KategoriKerusakan::orderBy('nama')->get();
        $lokasis = Lokasi::orderBy('id')->get(); // urutan sesuai daftar ruangan

        return view('siswa.pengaduan.create', compact('kategoris', 'lokasis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $lokasiValid = Lokasi::pluck('id')->map(fn ($id) => (string) $id)->push('lainnya')->all();

        $validated = $request->validate([
            'kategori_kerusakan_id' => ['required', 'exists:kategori_kerusakans,id'],
            'lokasi_id' => ['required', Rule::in($lokasiValid)],
            'lokasi_lainnya' => ['nullable', 'required_if:lokasi_id,lainnya', 'string', 'min:3', 'max:100'],
            'tanggal_kejadian' => ['required', 'date', 'before_or_equal:today'],
            'deskripsi' => ['required', 'string', 'min:10'],
            'foto' => ['required', 'image', 'max:2048'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:10240'],
        ], [
            'foto.required' => 'Foto bukti kerusakan wajib diunggah.',
            'foto.image' => 'Foto bukti harus berupa gambar.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Lokasi "Lainnya": simpan teks yang diketik siswa, lokasi_id dikosongkan
        if ($validated['lokasi_id'] === 'lainnya') {
            $validated['lokasi_id'] = null;
            $validated['lokasi_lainnya'] = trim($validated['lokasi_lainnya']);
        } else {
            $validated['lokasi_lainnya'] = null;
        }

        $validated['user_id'] = $request->user()->id;
        $validated['kode'] = 'ADN-'.now()->format('ymd').'-'.strtoupper(Str::random(4));
        $validated['status'] = 'diajukan';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/bukti'), $name);
            $validated['foto'] = 'uploads/bukti/'.$name;
        }

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $ext = strtolower($file->getClientOriginalExtension() ?: 'mp4');
            $name = time().'_'.Str::random(8).'.'.$ext;
            $file->move(public_path('uploads/video'), $name);
            $validated['video'] = 'uploads/video/'.$name;
        }

        Pengaduan::create($validated);

        return redirect()->route('siswa.pengaduan.index')->with('status', 'pengaduan-created');
    }

    public function show(Pengaduan $pengaduan): View
    {
        abort_unless($pengaduan->user_id === auth()->id(), 403);

        $pengaduan->load(['kategori', 'lokasi', 'petugas', 'teknisi', 'perbaikans.pencatat']);

        return view('siswa.pengaduan.show', compact('pengaduan'));
    }
}
