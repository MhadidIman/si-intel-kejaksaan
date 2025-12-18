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
            $table->string('nomor_surat')->nullable(); // Jika ada surat fisik
            $table->date('tanggal_terima');
            $table->string('nama_pelapor')->nullable(); // Bisa Anonim
            $table->string('no_hp_pelapor')->nullable();
            $table->string('terlapor'); // Siapa yang diadukan (Pejabat/Dinas/Swasta)
            $table->text('uraian_pengaduan');
            $table->string('bukti_pendukung')->nullable(); // Foto/PDF
            $table->text('disposisi_pimpinan')->nullable(); // Perintah atasan
            $table->enum('status', ['masuk', 'telaah', 'lid', 'arsipkan'])->default('masuk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapdus');
    }
};
