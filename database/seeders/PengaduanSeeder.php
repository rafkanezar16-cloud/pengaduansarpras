<?php

namespace Database\Seeders;

use App\Models\KategoriKerusakan;
use App\Models\Lokasi;
use App\Models\Pengaduan;
use App\Models\Perbaikan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $siswas = User::where('role', 'siswa')->get();
        $kategoris = KategoriKerusakan::all()->keyBy('nama');
        $lokasis = Lokasi::all();
        $admin = User::where('role', 'admin')->first();
        $teknisis = User::where('role', 'teknisi')->get();

        $deskripsis = [
            'Laptop tidak bisa menyala saat digunakan praktik.',
            'Kursi patah bagian kaki, berbahaya jika diduduki.',
            'AC ruangan tidak dingin meski sudah dinyalakan lama.',
            'Lampu kelas mati, ruangan jadi gelap saat mendung.',
            'Proyektor tidak menampilkan gambar ke layar.',
            'Keran air di toilet bocor terus-menerus.',
            'Meja permukaannya rusak dan menimbulkan serpihan.',
            'Stop kontak di ruang lab tidak berfungsi.',
            'Atap ruangan bocor saat hujan deras.',
            'Kabel jaringan LAN putus di ruang lab.',
            'Pintu kelas sulit dikunci, engsel longgar.',
            'Papan tulis retak dan sulit ditulisi spidol.',
        ];

        // [kategori, jumlah, status distribusi]
        $plan = [
            ['kategori' => 'Elektronik', 'jumlah' => 6],
            ['kategori' => 'Meja & Kursi', 'jumlah' => 4],
            ['kategori' => 'Bangunan', 'jumlah' => 7],
            ['kategori' => 'ATK', 'jumlah' => 3],
            ['kategori' => 'Lainnya', 'jumlah' => 4],
        ];

        // total 24 -> 5 diajukan, 9 diproses, 10 selesai
        $statusPool = array_merge(
            array_fill(0, 5, 'diajukan'),
            array_fill(0, 9, 'diproses'),
            array_fill(0, 10, 'selesai'),
        );
        shuffle($statusPool);

        // foto/video contoh (ada di public/uploads/contoh) supaya unsur multimedia langsung terlihat
        $fotoContoh = [
            'Elektronik' => 'uploads/contoh/laptop.svg',
            'Meja & Kursi' => 'uploads/contoh/kursi.svg',
            'Bangunan' => 'uploads/contoh/atap.svg',
            'ATK' => 'uploads/contoh/kursi.svg',
            'Lainnya' => 'uploads/contoh/lampu.svg',
        ];

        $counter = 0;

        foreach ($plan as $item) {
            $kategori = $kategoris[$item['kategori']];

            for ($i = 0; $i < $item['jumlah']; $i++) {
                $status = $statusPool[$counter] ?? 'diajukan';
                $counter++;

                $tanggal = now()->subDays(rand(0, 25));

                // beberapa pengaduan memakai lokasi "Lainnya" (diketik sendiri oleh siswa)
                $lainnya = in_array($counter, [4, 13, 19], true)
                    ? ['Taman Sekolah', 'Area Parkir Motor', 'Pos Satpam'][array_search($counter, [4, 13, 19], true)]
                    : null;

                // sebagian besar yang diproses/selesai ditugaskan ke teknisi (1 pengaduan diproses sengaja belum ada teknisi)
                $teknisiTugas = in_array($status, ['diproses', 'selesai'], true) && ! ($status === 'diproses' && $counter % 5 === 0)
                    ? $teknisis->random() : null;

                $pengaduan = Pengaduan::create([
                    'kode' => 'ADN-'.$tanggal->format('ymd').'-'.strtoupper(Str::random(4)),
                    'user_id' => $siswas->random()->id,
                    'kategori_kerusakan_id' => $kategori->id,
                    'lokasi_id' => $lainnya ? null : $lokasis->random()->id,
                    'lokasi_lainnya' => $lainnya,
                    'tanggal_kejadian' => $tanggal->format('Y-m-d'),
                    'deskripsi' => $deskripsis[array_rand($deskripsis)],
                    'foto' => $fotoContoh[$item['kategori']],
                    'video' => $counter === 2 ? 'uploads/contoh/contoh-video.mp4' : null,
                    'status' => $status,
                    'catatan_admin' => $status === 'selesai' ? 'Sudah diperbaiki oleh petugas sarpras.' : null,
                    'ditangani_oleh' => in_array($status, ['diproses', 'selesai']) ? $admin->id : null,
                    'teknisi_id' => $teknisiTugas?->id,
                    'target_selesai' => $teknisiTugas && $status === 'diproses' ? $tanggal->copy()->addDays(rand(3, 9))->format('Y-m-d') : null,
                    'selesai_at' => $status === 'selesai' ? $tanggal->copy()->addDays(rand(1, 3)) : null,
                    'created_at' => $tanggal,
                    'updated_at' => $tanggal,
                ]);

                if ($teknisiTugas) {
                    $this->riwayat($pengaduan, $admin, $teknisiTugas, $status, $tanggal);
                }
            }
        }
    }

    /** Isi riwayat perbaikan contoh supaya timeline langsung terlihat. */
    private function riwayat(Pengaduan $p, User $admin, User $teknisi, string $status, $tanggal): void
    {
        $t = $tanggal->copy()->addHours(3);
        $catat = function (User $u, string $jenis, ?string $catatan, $waktu, ?string $bahan = null) use ($p) {
            Perbaikan::create([
                'pengaduan_id' => $p->id, 'user_id' => $u->id, 'jenis' => $jenis,
                'catatan' => $catatan, 'bahan' => $bahan, 'created_at' => $waktu, 'updated_at' => $waktu,
            ]);
        };

        $catat($admin, 'ditugaskan', 'Ditugaskan kepada '.$teknisi->name.'. Mohon dicek dan diperbaiki.', $t);

        if ($status === 'diproses' && $p->id % 2 === 0) {
            return; // baru ditugaskan, belum dikerjakan
        }

        $catat($teknisi, 'mulai', 'Sudah sampai di lokasi dan mulai memeriksa kerusakan.', $t->copy()->addDay());
        $catat($teknisi, 'progres', 'Kerusakan sudah ditemukan, sedang menunggu suku cadang pengganti.', $t->copy()->addDay()->addHours(2), 'Suku cadang pengganti');

        if ($status === 'selesai') {
            $catat($teknisi, 'selesai', 'Perbaikan selesai dan sudah diuji, berfungsi normal kembali.', $t->copy()->addDays(2), 'Suku cadang pengganti, baut, lem');
        }
    }
}
