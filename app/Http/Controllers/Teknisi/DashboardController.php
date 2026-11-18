<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $aktif = $user->tugas()->where('status', 'diproses');

        $stats = [
            'baru' => (clone $aktif)->whereDoesntHave('perbaikans', fn ($q) => $q->whereIn('jenis', ['mulai', 'progres']))->count(),
            'dikerjakan' => (clone $aktif)->whereHas('perbaikans', fn ($q) => $q->whereIn('jenis', ['mulai', 'progres']))->count(),
            'selesai' => $user->tugas()->where('status', 'selesai')->count(),
            'terlambat' => (clone $aktif)->whereNotNull('target_selesai')->whereDate('target_selesai', '<', today())->count(),
        ];

        // tugas aktif: yang paling mendesak (target paling dekat) dulu
        $tugas = $user->tugas()
            ->where('status', 'diproses')
            ->with(['kategori', 'lokasi', 'user', 'perbaikans'])
            ->orderByRaw('target_selesai IS NULL')
            ->orderBy('target_selesai')
            ->latest()
            ->take(6)
            ->get();

        $aktivitas = Perbaikan::with('pengaduan')
            ->where('user_id', $user->id)
            ->latest()->latest('id')
            ->take(5)->get();

        return view('teknisi.dashboard', compact('stats', 'tugas', 'aktivitas'));
    }
}
