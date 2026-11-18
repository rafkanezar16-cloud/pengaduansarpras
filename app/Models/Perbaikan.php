<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perbaikan extends Model
{
    protected $fillable = ['pengaduan_id', 'user_id', 'jenis', 'catatan', 'bahan', 'foto'];

    public const JENIS = [
        'ditugaskan' => ['label' => 'Ditugaskan', 'warna' => 'bg-blue-500', 'teks' => 'text-blue-700 bg-blue-50'],
        'mulai' => ['label' => 'Mulai dikerjakan', 'warna' => 'bg-amber-500', 'teks' => 'text-amber-700 bg-amber-50'],
        'progres' => ['label' => 'Catatan progres', 'warna' => 'bg-slate-400', 'teks' => 'text-slate-700 bg-slate-100'],
        'selesai' => ['label' => 'Selesai diperbaiki', 'warna' => 'bg-green-500', 'teks' => 'text-green-700 bg-green-50'],
        'dikembalikan' => ['label' => 'Dikembalikan ke admin', 'warna' => 'bg-red-500', 'teks' => 'text-red-700 bg-red-50'],
    ];

    /** @return BelongsTo<Pengaduan, $this> */
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }

    /** @return BelongsTo<User, $this> */
    public function pencatat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function label(): string
    {
        return self::JENIS[$this->jenis]['label'] ?? ucfirst($this->jenis);
    }

    public function dotClass(): string
    {
        return self::JENIS[$this->jenis]['warna'] ?? 'bg-slate-400';
    }

    public function chipClass(): string
    {
        return self::JENIS[$this->jenis]['teks'] ?? 'text-slate-700 bg-slate-100';
    }
}
