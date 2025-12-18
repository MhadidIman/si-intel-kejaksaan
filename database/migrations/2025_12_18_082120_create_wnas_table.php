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
            $table->string('nama_lengkap');
            $table->string('nomor_paspor');
            $table->string('kebangsaan'); // Negara asal
            $table->date('tanggal_tiba')->nullable();
            $table->date('masa_berlaku_izin_tinggal'); // Expired Date Visa
            $table->string('tujuan_kunjungan'); // Wisata, Kerja, Sosial
            $table->string('sponsor')->nullable(); // Penjamin di Indonesia
            $table->text('alamat_menginap'); // Hotel / Rumah
            $table->string('foto_dokumen')->nullable(); // Foto Paspor
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wnas');
    }
};
