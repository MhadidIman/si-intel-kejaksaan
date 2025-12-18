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
            $table->string('nama_lengkap');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kasus'); // Misal: Korupsi / Narkoba
            $table->string('status_hukum'); // Tersangka / Terpidana
            $table->string('ciri_fisik')->nullable(); // Tinggi, kulit, dll
            $table->string('foto')->nullable(); // Path foto
            $table->enum('status_pencarian', ['buron', 'tertangkap'])->default('buron');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dpos');
    }
};
