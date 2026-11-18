# AduinAja!! — Sistem Pengaduan Sarana Sekolah

Project Kelulusan RPL — SMK Negeri 5 Surakarta
Rafka Nezar Azriel Ghibran — XII RPL A / No. 27

Aplikasi web Laravel + MySQL untuk pengaduan kerusakan sarana & prasarana sekolah


## Fitur

**Siswa**
- Login / logout, ubah profil & kata sandi
- **Panduan Mengadu** (menu *Panduan*): 4 langkah mengadu, contoh deskripsi yang baik, tips foto, arti setiap status, daftar kategori & lokasi, dan FAQ. Ada juga banner panduan di Dashboard untuk siswa baru dan tautan bantuan di form pengaduan
- Ajukan pengaduan: kategori, lokasi (pilih dari 17 ruangan atau **Lainnya** lalu ketik sendiri), tanggal, deskripsi, **foto bukti (wajib)** dan **video (opsional)**
- Profil: data diri (nama, email, NIS, kelas) terkunci; siswa hanya dapat mengubah **No. HP** dan **kata sandi**
- Riwayat & status pengaduan (Diajukan → Diproses → Selesai / Ditolak) beserta catatan admin

**Teknisi** (role baru)
- Dashboard tugas: jumlah tugas aktif, terlambat, dan selesai
- Tugas Perbaikan: mulai mengerjakan, **catatan progres** (+ bahan/suku cadang + foto), tandai **selesai** (status pengaduan menjadi Selesai), atau **kembalikan ke admin** dengan alasan
- **Riwayat Perbaikan** tersimpan di tabel `perbaikans` (ditugaskan, mulai, progres, selesai, dikembalikan) dan tampil sebagai linimasa untuk admin, siswa, dan teknisi
- Teknisi hanya bisa membuka tugas miliknya sendiri

**Admin**
- Dashboard statistik + grafik kerusakan per kategori (filter 7 hari / 30 hari / semua)
- Verifikasi pengaduan: terima (bisa sekaligus **menugaskan teknisi** + target selesai), tolak lewat **dialog dengan pilihan alasan cepat**, selesaikan, cari & filter status. Urutan bawaan: yang **Diproses** paling atas, lalu Diajukan, lalu Selesai/Ditolak
- **Pengaturan Website**: ubah nama website, slogan, nama sekolah, teks login, logo, dan warna utama (6 pilihan + warna sendiri) dengan pratinjau langsung; tombol "Kembalikan ke Bawaan"
- Master Data: Kategori, Lokasi, Pengguna (CRUD; role Admin / Siswa / **Teknisi**)
- Laporan: filter tanggal/status/kategori, export Excel (.xlsx rapi), cetak/simpan PDF

## Responsif

Tampilan menyesuaikan HP, tablet, dan desktop:
- Sidebar menjadi **menu geser** (tombol ☰) di layar kecil
- Daftar pengaduan tampil sebagai **kartu** di HP dan **tabel** di layar lebar
- Form, grafik, dan kartu statistik menyesuaikan lebar layar
- Sudah dicek di lebar 360 px, 390 px, 768 px, dan 1440 px tanpa scroll ke samping

## 6. Unsur multimedia

- **Gambar:** upload foto bukti dengan pratinjau langsung, drag & drop, dan validasi ukuran
- **Video:** upload video bukti singkat (MP4/WebM/MOV, maks 10 MB) dengan pemutar bawaan dan pratinjau sebelum kirim
- **Lightbox:** klik foto/ikon video di daftar untuk memperbesar / memutar tanpa pindah halaman (tutup dengan tombol X, klik area gelap, atau tombol Esc)
- **Animasi ringan:** kartu muncul berurutan, angka statistik berhitung naik, grafik beranimasi, latar login bergerak (otomatis nonaktif jika perangkat memilih "kurangi animasi")

## Struktur singkat

```
app/Http/Controllers/   Auth, Profile, Siswa/*, Admin/*
app/Http/Middleware/EnsureRole.php   proteksi role admin / siswa
app/Models/             User, KategoriKerusakan, Lokasi, Pengaduan
database/migrations/    struktur tabel (termasuk kolom video)
database/seeders/       data awal
lang/id/                terjemahan validasi bahasa Indonesia
resources/views/        tampilan Blade (layouts, components, siswa, admin)
routes/web.php          seluruh route
```
