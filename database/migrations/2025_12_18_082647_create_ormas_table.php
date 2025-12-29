<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ormas', function (Blueprint $table) {
            $table->id();

            // TAMBAHAN: Kolom User ID
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->string('nama_organisasi');
            $table->string('ketua');
            $table->text('alamat_sekretariat')->nullable();
            $table->string('bentuk_organisasi');
            $table->string('nomor_legalitas')->nullable();
            $table->integer('jumlah_anggota')->default(0);
            $table->text('kegiatan_terakhir')->nullable();
            $table->enum('status', ['aktif', 'vakum', 'diawasi', 'dilarang'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ormas');
    }
};
