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
            $table->string('nomor_tiket')->unique();

            // Data Pelapor
            $table->string('nama_pelapor');
            $table->boolean('is_anonim')->default(false);
            $table->string('nik', 16);
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('alamat_pelapor');
            $table->string('no_hp_pelapor');

            // Data Terlapor
            $table->string('nama_terlapor');
            $table->string('jabatan_terlapor');
            $table->text('alamat_terlapor')->nullable();
            $table->string('kontak_terlapor')->nullable();

            // Substansi Laporan Case
            $table->string('kategori_laporan');
            $table->string('judul_laporan');
            $table->date('waktu_kejadian'); // Tempus Delicti
            $table->string('tempat_kejadian'); // Locus Delicti
            $table->longText('uraian_pengaduan');

            // Evidence & Status Tracking
            $table->string('bukti_dukung');
            $table->string('status_laporan')->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapdus');
    }
};
