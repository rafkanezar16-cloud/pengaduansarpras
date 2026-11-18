<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\KategoriKerusakan;
use App\Models\Lokasi;
use Illuminate\View\View;

class PanduanController extends Controller
{
    public function index(): View
    {
        return view('siswa.panduan', [
            'kategoris' => KategoriKerusakan::orderBy('nama')->get(),
            'lokasis' => Lokasi::orderBy('nama')->get(),
            'sudahPernah' => auth()->user()->pengaduans()->exists(),
        ]);
    }
}
