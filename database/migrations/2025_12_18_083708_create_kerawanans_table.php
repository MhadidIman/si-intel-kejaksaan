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

            // Kolom User ID
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->enum('status_verifikasi', ['pending', 'disetujui', 'ditolak'])->default('pending');

            $table->string('kecamatan');
            $table->string('bidang');
            $table->text('potensi_ancaman');
            $table->string('sumber_informasi')->nullable();

            // --- TAMBAHAN UNTUK GIS & SPK SAW ---
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('kriteria_dampak')->nullable();       // C1
            $table->integer('kriteria_probabilitas')->nullable(); // C2
            $table->integer('kriteria_eskalasi')->nullable();     // C3
            $table->decimal('skor_spk', 8, 2)->nullable();
            // ------------------------------------

            $table->enum('tingkat_rawan', ['tinggi', 'sedang', 'rendah'])->default('rendah');
            $table->text('upaya_pencegahan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerawanans');
    }
};
