<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKerusakan;
use App\Models\Lokasi;
use App\Models\Pengaduan;
use App\Support\SimpleXlsx;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    private function filtered(Request $request)
    {
        $query = Pengaduan::with(['user', 'kategori', 'lokasi', 'teknisi']);

        if ($request->filled('dari')) {
            $query->whereDate('tanggal_kejadian', '>=', $request->date('dari'));
        }

        if ($request->filled('sampai')) {
            $query->whereDate('tanggal_kejadian', '<=', $request->date('sampai'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('kategori_kerusakan_id')) {
            $query->where('kategori_kerusakan_id', $request->integer('kategori_kerusakan_id'));
        }

        return $query->latest('tanggal_kejadian');
    }

    public function index(Request $request): View
    {
        $pengaduans = $this->filtered($request)->paginate(15)->withQueryString();
        $kategoris = KategoriKerusakan::orderBy('nama')->get();
        $lokasis = Lokasi::orderBy('id')->get();

        return view('admin.laporan.index', compact('pengaduans', 'kategoris', 'lokasis'));
    }

    public function exportExcel(Request $request)
    {
        $rows = $this->filtered($request)->get();

        $kolom = ['No', 'Kode', 'Tanggal Kejadian', 'Kategori', 'Lokasi', 'Pelapor', 'Kelas', 'Status', 'Teknisi', 'Catatan Admin'];
        $last = SimpleXlsx::col(count($kolom) - 1);

        $xlsx = new SimpleXlsx();
        $xlsx->setWidths([6, 20, 16, 22, 26, 24, 12, 14, 22, 45])
            ->addRow(1, [['LAPORAN PENGADUAN SARANA SEKOLAH - '.strtoupper(\App\Models\Pengaturan::ambil('nama_aplikasi')), SimpleXlsx::S_TITLE]], 28)
            ->addRow(2, [['Dibuat: '.now()->format('d-m-Y H:i').' WIB'.' | Total data: '.$rows->count(), SimpleXlsx::S_SUB]])
            ->merge('A1:'.$last.'1')
            ->merge('A2:'.$last.'2');

        $head = [];
        foreach ($kolom as $i => $k) {
            $head[$i] = [$k, SimpleXlsx::S_HEAD];
        }
        $xlsx->addRow(4, $head, 24);

        $statusStyle = [
            'diajukan' => SimpleXlsx::S_ST_DIAJUKAN,
            'diproses' => SimpleXlsx::S_ST_DIPROSES,
            'selesai' => SimpleXlsx::S_ST_SELESAI,
            'ditolak' => SimpleXlsx::S_ST_DITOLAK,
        ];

        $r = 5;
        foreach ($rows as $i => $row) {
            $xlsx->addRow($r++, [
                [$i + 1, SimpleXlsx::S_CENTER],
                [$row->kode, SimpleXlsx::S_CENTER],
                [$row->tanggal_kejadian, SimpleXlsx::S_DATE],
                [$row->kategori->nama, SimpleXlsx::S_TEXT],
                [$row->lokasi_nama, SimpleXlsx::S_TEXT],
                [$row->user->name, SimpleXlsx::S_TEXT],
                [$row->user->kelas ?? '-', SimpleXlsx::S_CENTER],
                [$row->statusLabel(), $statusStyle[$row->status] ?? SimpleXlsx::S_CENTER],
                [$row->teknisi->name ?? '-', SimpleXlsx::S_TEXT],
                [$row->catatan_admin ?: '-', SimpleXlsx::S_TEXT],
            ]);
        }

        $xlsx->addRow($r, [['Total pengaduan: '.$rows->count(), SimpleXlsx::S_TOTAL]]);
        for ($c = 1; $c < count($kolom); $c++) {
            $xlsx->addRow($r, array_pad([['Total pengaduan: '.$rows->count(), SimpleXlsx::S_TOTAL]], $c + 1, ['', SimpleXlsx::S_TOTAL]));
        }
        $xlsx->merge('A'.$r.':'.$last.$r);
        $xlsx->freeze(4)->autoFilter('A4:'.$last.max(5, $r - 1));

        $tmp = tempnam(sys_get_temp_dir(), 'xlsx');
        $xlsx->save($tmp, 'Laporan Pengaduan');

        return response()->download($tmp, 'laporan-pengaduan-'.now()->format('Ymd-His').'.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    public function print(Request $request): View
    {
        $rows = $this->filtered($request)->get();

        return view('admin.laporan.print', ['rows' => $rows, 'generatedAt' => now()]);
    }
}
