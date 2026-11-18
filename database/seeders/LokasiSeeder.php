<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan sesuai daftar ruangan sekolah (id 1 - 17).
        $lokasis = [
            'Aula Sekolah',
            'Perpustakaan',
            'Ruang Guru',
            'Ruang Kepala Sekolah',
            'Ruang Tata Usaha',
            'Ruang BK',
            'Ruang UKS',
            'Ruang OSIS',
            'Ruang Rapat',
            'Masjid Sekolah',
            'Kantin Sekolah',
            'Koperasi Sekolah',
            'Laboratorium Komputer',
            'Laboratorium RPL/PPLG',
            'Laboratorium Elektronika',
            'Bengkel Teknik Mesin',
            'Bengkel Otomotif',
        ];

        foreach ($lokasis as $nama) {
            Lokasi::create(['nama' => $nama, 'gedung' => null]);
        }
    }
}
