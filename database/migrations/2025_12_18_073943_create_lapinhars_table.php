<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapinhars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat'); // No: R-01/...
            $table->date('tanggal_surat');
            $table->string('sumber_informasi'); // Misal: Masyarakat/Cepu
            $table->string('bidang'); // Ipoleksosbudhankam
            $table->text('peristiwa'); // Apa yang terjadi
            $table->text('pendapat'); // Analisa Intelijen
            $table->enum('status', ['rahasia', 'biasa'])->default('rahasia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapinhars');
    }
};
