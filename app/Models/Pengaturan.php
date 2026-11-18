<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * Pengaturan website yang bisa diubah admin (nama, logo, warna, teks).
 * Disimpan sebagai pasangan key => value di tabel `pengaturans`.
 */
class Pengaturan extends Model
{
    protected $table = 'pengaturans';

    protected $fillable = ['key', 'value'];

    public const DEFAULTS = [
        'nama_aplikasi' => 'AduinAja!!',
        'slogan' => 'Sistem Pengaduan Sarana Sekolah',
        'nama_sekolah' => 'SMK Negeri 5 Surakarta',
        'teks_login' => 'Gunakan email dan kata sandi yang terdaftar.',
        'warna' => 'biru',
        'warna_custom' => '#2563eb',
        'logo' => null,
    ];

    /** Pilihan warna utama siap pakai (palet Tailwind). */
    public const PRESETS = [
        'biru' => ['label' => 'Biru', 'shades' => [50 => '#eff6ff', 100 => '#dbeafe', 200 => '#bfdbfe', 300 => '#93c5fd', 400 => '#60a5fa', 500 => '#3b82f6', 600 => '#2563eb', 700 => '#1d4ed8', 800 => '#1e40af', 900 => '#1e3a8a', 950 => '#172554']],
        'hijau' => ['label' => 'Hijau', 'shades' => [50 => '#ecfdf5', 100 => '#d1fae5', 200 => '#a7f3d0', 300 => '#6ee7b7', 400 => '#34d399', 500 => '#10b981', 600 => '#059669', 700 => '#047857', 800 => '#065f46', 900 => '#064e3b', 950 => '#022c22']],
        'toska' => ['label' => 'Toska', 'shades' => [50 => '#f0fdfa', 100 => '#ccfbf1', 200 => '#99f6e4', 300 => '#5eead4', 400 => '#2dd4bf', 500 => '#14b8a6', 600 => '#0d9488', 700 => '#0f766e', 800 => '#115e59', 900 => '#134e4a', 950 => '#042f2e']],
        'ungu' => ['label' => 'Ungu', 'shades' => [50 => '#f5f3ff', 100 => '#ede9fe', 200 => '#ddd6fe', 300 => '#c4b5fd', 400 => '#a78bfa', 500 => '#8b5cf6', 600 => '#7c3aed', 700 => '#6d28d9', 800 => '#5b21b6', 900 => '#4c1d95', 950 => '#2e1065']],
        'merah' => ['label' => 'Merah', 'shades' => [50 => '#fff1f2', 100 => '#ffe4e6', 200 => '#fecdd3', 300 => '#fda4af', 400 => '#fb7185', 500 => '#f43f5e', 600 => '#e11d48', 700 => '#be123c', 800 => '#9f1239', 900 => '#881337', 950 => '#4c0519']],
        'oranye' => ['label' => 'Oranye', 'shades' => [50 => '#fff7ed', 100 => '#ffedd5', 200 => '#fed7aa', 300 => '#fdba74', 400 => '#fb923c', 500 => '#f97316', 600 => '#ea580c', 700 => '#c2410c', 800 => '#9a3412', 900 => '#7c2d12', 950 => '#431407']],
    ];

    private static ?array $cache = null;

    /** Semua pengaturan (nilai default + yang tersimpan). Aman dipanggil sebelum migrasi. */
    public static function semua(): array
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $data = self::DEFAULTS;

        try {
            if (Schema::hasTable('pengaturans')) {
                foreach (self::query()->pluck('value', 'key') as $key => $value) {
                    if (array_key_exists($key, self::DEFAULTS) && $value !== null && $value !== '') {
                        $data[$key] = $value;
                    }
                }
            }
        } catch (\Throwable $e) {
            // database belum siap: pakai default
        }

        return self::$cache = $data;
    }

    public static function ambil(string $key, mixed $default = null): mixed
    {
        return self::semua()[$key] ?? $default;
    }

    public static function simpan(string $key, ?string $value): void
    {
        self::updateOrCreate(['key' => $key], ['value' => $value]);
        self::$cache = null;
    }

    public static function reset(): void
    {
        self::query()->delete();
        self::$cache = null;
    }

    /** Palet warna utama (shade 50-950) sesuai pilihan admin. */
    public static function palet(): array
    {
        $pilihan = self::ambil('warna');

        if ($pilihan === 'custom') {
            return self::buatPalet((string) self::ambil('warna_custom'));
        }

        return (self::PRESETS[$pilihan] ?? self::PRESETS['biru'])['shades'];
    }

    /** Membuat 11 tingkat warna dari satu warna dasar (dianggap shade 600). */
    public static function buatPalet(string $hex): array
    {
        $hex = ltrim($hex, '#');
        if (! preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
            return self::PRESETS['biru']['shades'];
        }

        $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
        $mix = function (array $to, float $t) use ($rgb) {
            return sprintf('#%02x%02x%02x',
                round($rgb[0] + ($to[0] - $rgb[0]) * $t),
                round($rgb[1] + ($to[1] - $rgb[1]) * $t),
                round($rgb[2] + ($to[2] - $rgb[2]) * $t));
        };
        $putih = [255, 255, 255];
        $hitam = [0, 0, 0];

        return [
            50 => $mix($putih, .93), 100 => $mix($putih, .85), 200 => $mix($putih, .70),
            300 => $mix($putih, .52), 400 => $mix($putih, .30), 500 => $mix($putih, .12),
            600 => '#'.strtolower($hex),
            700 => $mix($hitam, .15), 800 => $mix($hitam, .30), 900 => $mix($hitam, .45), 950 => $mix($hitam, .62),
        ];
    }

    public static function logoUrl(): string
    {
        $logo = self::ambil('logo');

        return asset($logo ?: 'images/logo.svg');
    }

    /** Nama aplikasi sebagai [bagian putih, bagian aksen kuning]. */
    public static function namaTerpisah(): array
    {
        $nama = trim((string) self::ambil('nama_aplikasi'));

        if (str_contains($nama, ' ')) {
            $pos = strrpos($nama, ' ');

            return [substr($nama, 0, $pos + 1), substr($nama, $pos + 1)];
        }

        if (preg_match('/^(.+?)(Aja.*)$/u', $nama, $m)) {
            return [$m[1], $m[2]];
        }

        return [$nama, ''];
    }
}
