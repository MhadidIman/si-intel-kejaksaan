<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wnas', function (Blueprint $table) {
            $table->id();

            // TAMBAHAN: Kolom User ID
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->string('nama_lengkap');
            $table->string('nomor_paspor');
            $table->string('kebangsaan');
            $table->date('tanggal_tiba')->nullable();
            $table->date('masa_berlaku_izin_tinggal');
            $table->string('tujuan_kunjungan');
            $table->string('sponsor')->nullable();
            $table->text('alamat_menginap');
            $table->string('foto_dokumen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnas');
    }
};
