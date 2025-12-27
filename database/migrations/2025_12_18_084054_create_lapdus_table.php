<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapdus', function (Blueprint $table) {
            $table->id();
            // Kolom Verifikasi Admin
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            // Data Pelapor
            $table->string('nama_pelapor');
            $table->string('nik')->nullable();
            $table->string('no_hp')->nullable();

            // Data Pengaduan
            $table->string('nama_terlapor')->nullable(); // Siapa yang dilaporkan
            $table->string('kategori_laporan'); // Korupsi / Umum / Pegawai
            $table->text('uraian_pengaduan'); // Kronologi singkat
            $table->string('bukti_dukung')->nullable(); // File Upload

            // Status Tindak Lanjut (Operasional)
            $table->enum('status_laporan', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->text('keterangan_tindak_lanjut')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapdus');
    }
};
