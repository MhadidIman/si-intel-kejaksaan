<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dpos', function (Blueprint $table) {
            $table->id();
            // Opsional: Mencatat penginput
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('nama_lengkap');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kasus');
            $table->string('status_hukum');
            $table->string('ciri_fisik')->nullable();
            $table->string('foto')->nullable();

            // Status Operasional (Buron/Tertangkap)
            $table->enum('status_pencarian', ['buron', 'tertangkap'])->default('buron');

            // KOLOM BARU: Status Verifikasi Admin
            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dpos');
    }
};
