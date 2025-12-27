<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kerawanans', function (Blueprint $table) {
            $table->id();
            // Kolom Verifikasi Admin
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            // Data Pemetaan
            $table->string('kecamatan'); // Lokasi / Wilayah
            $table->string('bidang'); // IPOLEKSOSBUDHANKAM
            $table->text('potensi_ancaman'); // Isu strategis
            $table->string('sumber_informasi')->nullable();

            // Tingkat Kerawanan (Skala Prioritas)
            $table->enum('tingkat_rawan', ['tinggi', 'sedang', 'rendah'])->default('rendah');

            $table->text('upaya_pencegahan')->nullable(); // Rekomendasi/Tindak Lanjut

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerawanans');
    }
};
