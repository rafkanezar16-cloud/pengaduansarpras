<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // teknisi yang ditugaskan memperbaiki + target selesai perbaikan
            $table->foreignId('teknisi_id')->nullable()->after('ditangani_oleh')->constrained('users')->nullOnDelete();
            $table->date('target_selesai')->nullable()->after('teknisi_id');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('teknisi_id');
            $table->dropColumn('target_selesai');
        });
    }
};
