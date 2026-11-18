<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'user_id',
        'kategori_kerusakan_id',
        'lokasi_id',
        'lokasi_lainnya',
        'tanggal_kejadian',
        'deskripsi',
        'foto',
        'video',
        'status',
        'catatan_admin',
        'ditangani_oleh',
        'teknisi_id',
        'target_selesai',
        'selesai_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kejadian' => 'date',
            'target_selesai' => 'date',
            'selesai_at' => 'datetime',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<KategoriKerusakan, $this> */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriKerusakan::class, 'kategori_kerusakan_id');
    }

    /** @return BelongsTo<Lokasi, $this> */
    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class);
    }

    /** @return BelongsTo<User, $this> */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ditangani_oleh');
    }

    /** Teknisi yang ditugaskan memperbaiki. @return BelongsTo<User, $this> */
    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    /** Riwayat perbaikan (terlama -> terbaru). */
    public function perbaikans(): HasMany
    {
        return $this->hasMany(Perbaikan::class)->oldest()->oldest('id');
    }

    /** Tahap perbaikan untuk ditampilkan: dihitung dari teknisi dan catatan terakhir. */
    public function tahapPerbaikan(): ?string
    {
        if ($this->status !== 'diproses' && $this->status !== 'selesai') {
            return null;
        }

        $terakhir = $this->relationLoaded('perbaikans') ? $this->perbaikans->last() : $this->perbaikans()->latest()->latest('id')->first();

        if ($this->status === 'selesai') {
            return $terakhir && $terakhir->jenis === 'selesai' ? 'Diperbaiki teknisi' : null;
        }

        if (! $this->teknisi_id) {
            return $terakhir && $terakhir->jenis === 'dikembalikan' ? 'Dikembalikan teknisi' : 'Belum ada teknisi';
        }

        return match ($terakhir?->jenis) {
            'mulai', 'progres' => 'Sedang dikerjakan',
            default => 'Menunggu dikerjakan',
        };
    }

    /** Target perbaikan sudah lewat dan pengaduan belum selesai. */
    public function terlambat(): bool
    {
        return $this->status === 'diproses' && $this->target_selesai !== null && $this->target_selesai->isBefore(today());
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'diajukan' => 'Diajukan',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => ucfirst($this->status),
        };
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            'diajukan' => 'bg-blue-50 text-blue-700 ring-blue-200',
            'diproses' => 'bg-amber-50 text-amber-700 ring-amber-200',
            'selesai' => 'bg-green-50 text-green-700 ring-green-200',
            'ditolak' => 'bg-red-50 text-red-700 ring-red-200',
            default => 'bg-gray-50 text-gray-700 ring-gray-200',
        };
    }

    /** Nama lokasi: dari daftar lokasi, atau teks yang diketik siswa jika memilih "Lainnya". */
    public function getLokasiNamaAttribute(): string
    {
        return $this->lokasi?->nama ?? ($this->lokasi_lainnya ?: '-');
    }

    /** Urutkan penanganan: Diproses -> Diajukan -> Selesai -> Ditolak. */
    public function scopeUrutStatus($query)
    {
        return $query->orderByRaw("CASE status WHEN 'diproses' THEN 1 WHEN 'diajukan' THEN 2 WHEN 'selesai' THEN 3 ELSE 4 END");
    }
}
