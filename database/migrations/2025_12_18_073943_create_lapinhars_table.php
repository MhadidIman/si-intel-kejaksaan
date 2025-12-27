<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapinhars', function (Blueprint $table) {
            $table->id();

            // Kolom Data Utama
            $table->string('nomor_surat'); // Contoh: R-01/...
            $table->date('tanggal_surat');
            $table->string('sumber_informasi'); // Contoh: Masyarakat/Cepu
            $table->string('bidang'); // Contoh: Ipoleksosbudhankam
            $table->text('peristiwa'); // Uraian kejadian
            $table->text('pendapat'); // Analisa Intelijen

            // Kolom Status & Kemananan
            $table->enum('status', ['rahasia', 'biasa'])->default('rahasia');

            // Kolom Baru: Status Verifikasi untuk Alur Kerja
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            // Opsional: Mencatat siapa yang menginput (jika ada relasi ke user)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapinhars');
    }
};
