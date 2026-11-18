<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Riwayat / log perbaikan: setiap langkah penugasan dan pengerjaan tersimpan di sini.
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // pencatat (admin / teknisi)
            $table->string('jenis', 20); // ditugaskan | mulai | progres | selesai | dikembalikan
            $table->text('catatan')->nullable();
            $table->string('bahan')->nullable(); // bahan / suku cadang yang dipakai
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->index(['pengaduan_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perbaikans');
    }
};
