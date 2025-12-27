<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pam_sdos', function (Blueprint $table) {
            $table->id();
            // Kolom Verifikasi Baru
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            // Data Personil
            $table->string('nama_pegawai');
            $table->string('nip_nrp')->nullable();
            $table->string('pangkat_jabatan');
            $table->string('satuan_kerja'); // Kejari/Kejati mana

            // Data Masalah/Pengamanan
            $table->text('permasalahan'); // Uraian singkat masalah
            $table->text('keterangan')->nullable(); // Tindak lanjut

            // Status Pengamanan (Clear / Dalam Pengawasan)
            $table->enum('status_pam', ['clear', 'diawasi', 'ditindak'])->default('diawasi');

            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pam_sdos');
    }
};
