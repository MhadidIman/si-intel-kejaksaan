<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jms_activities', function (Blueprint $table) {
            $table->id();
            // Opsional: Mencatat siapa yang input
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Kolom Verifikasi Baru
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->string('nama_sekolah');
            $table->date('tanggal_kegiatan');
            $table->string('materi');
            $table->integer('jumlah_siswa')->default(0);
            $table->string('nama_jaksa');
            $table->text('keterangan')->nullable();
            $table->string('foto_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jms_activities');
    }
};
