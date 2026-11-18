<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Lokasi "Lainnya": siswa mengetik sendiri nama ruangannya
            $table->string('lokasi_lainnya', 100)->nullable()->after('lokasi_id');
        });

        // lokasi_id boleh kosong jika siswa memilih "Lainnya"
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->foreignId('lokasi_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn('lokasi_lainnya');
        });
    }
};
