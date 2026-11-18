<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nis_nip',
        'email',
        'password',
        'role',
        'kelas',
        'no_hp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeknisi(): bool
    {
        return $this->role === 'teknisi';
    }

    /** Siswa dan teknisi: data diri dikelola admin (hanya No. HP & kata sandi yang boleh diubah sendiri). */
    public function dataTerkunci(): bool
    {
        return $this->role === 'siswa' || $this->role === 'teknisi';
    }

    public function roleLabel(): string
    {
        return match ($this->role) {
            'admin' => 'Administrator',
            'teknisi' => 'Teknisi',
            default => 'Siswa',
        };
    }

    /** Nama rute halaman utama sesuai role. */
    public function homeRoute(): string
    {
        return match ($this->role) {
            'admin' => 'admin.dashboard',
            'teknisi' => 'teknisi.dashboard',
            default => 'siswa.dashboard',
        };
    }

    /** Tugas perbaikan yang ditugaskan ke teknisi ini. @return HasMany<Pengaduan, $this> */
    public function tugas(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'teknisi_id');
    }

    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    /** @return HasMany<Pengaduan, $this> */
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
