<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Perbaikan;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pengaduan::with(['user', 'kategori', 'lokasi', 'teknisi', 'perbaikans']);

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $keyword = $request->string('q');
            $query->where(function ($sub) use ($keyword) {
                $sub->where('kode', 'like', "%{$keyword}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$keyword}%"));
            });
        }

        // Urutan daftar:
        //  - default : yang sedang Diproses paling atas, lalu Diajukan, lalu Selesai/Ditolak (terbaru dulu)
        //  - terbaru : murni berdasarkan waktu masuk
        match ($request->query('urut')) {
            'terbaru' => $query->latest(),
            default => $query->urutStatus()->latest(),
        };

        $pengaduans = $query->paginate(10)->withQueryString();
        $teknisis = User::where('role', 'teknisi')->orderBy('name')->get();

        return view('admin.pengaduan.index', compact('pengaduans', 'teknisis'));
    }

    public function show(Pengaduan $pengaduan): View
    {
        $pengaduan->load(['user', 'kategori', 'lokasi', 'petugas', 'teknisi', 'perbaikans.pencatat']);
        $teknisis = User::where('role', 'teknisi')->orderBy('name')->get();

        return view('admin.pengaduan.show', compact('pengaduan', 'teknisis'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:diproses,selesai,ditolak'],
            'catatan_admin' => ['nullable', 'string', 'max:1000'],
            'teknisi_id' => ['nullable', Rule::exists('users', 'id')->where('role', 'teknisi')],
            'target_selesai' => ['nullable', 'date', 'after_or_equal:today'],
        ], [
            'teknisi_id.exists' => 'Teknisi yang dipilih tidak valid.',
            'target_selesai.after_or_equal' => 'Target selesai tidak boleh sebelum hari ini.',
        ]);

        $pengaduan->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? $pengaduan->catatan_admin,
            'ditangani_oleh' => auth()->id(),
            'selesai_at' => $validated['status'] === 'selesai' ? now() : $pengaduan->selesai_at,
        ]);

        // Saat diterima (Diproses), admin boleh langsung menugaskan teknisi.
        if ($validated['status'] === 'diproses' && ! empty($validated['teknisi_id'])) {
            $this->tugaskan($pengaduan, (int) $validated['teknisi_id'], $validated['target_selesai'] ?? null, $validated['catatan_admin'] ?? null);
        }

        return back()->with('status', 'status-updated');
    }

    /** Tugaskan (atau ganti) teknisi untuk pengaduan yang sedang Diproses. */
    public function tugaskanTeknisi(Request $request, Pengaduan $pengaduan): RedirectResponse
    {
        abort_unless($pengaduan->status === 'diproses', 422, 'Teknisi hanya dapat ditugaskan pada pengaduan yang sedang diproses.');

        $validated = $request->validate([
            'teknisi_id' => ['required', Rule::exists('users', 'id')->where('role', 'teknisi')],
            'target_selesai' => ['nullable', 'date', 'after_or_equal:today'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ], [
            'teknisi_id.required' => 'Pilih teknisi terlebih dahulu.',
            'target_selesai.after_or_equal' => 'Target selesai tidak boleh sebelum hari ini.',
        ]);

        $this->tugaskan($pengaduan, (int) $validated['teknisi_id'], $validated['target_selesai'] ?? null, $validated['catatan'] ?? null);

        return back()->with('status', 'teknisi-assigned');
    }

    private function tugaskan(Pengaduan $pengaduan, int $teknisiId, ?string $target, ?string $catatan): void
    {
        $teknisi = User::findOrFail($teknisiId);

        $pengaduan->update(['teknisi_id' => $teknisi->id, 'target_selesai' => $target]);

        Perbaikan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => auth()->id(),
            'jenis' => 'ditugaskan',
            'catatan' => 'Ditugaskan kepada '.$teknisi->name.'.'.($catatan ? ' '.$catatan : ''),
        ]);
    }
}
