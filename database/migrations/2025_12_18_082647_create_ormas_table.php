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
            $table->string('nama_organisasi');
            $table->string('ketua'); // Nama pimpinan
            $table->text('alamat_sekretariat')->nullable();
            $table->string('bentuk_organisasi'); // Ormas / LSM / Yayasan / Aliran Kepercayaan
            $table->string('nomor_legalitas')->nullable(); // SKT / AHU / Akta Notaris
            $table->integer('jumlah_anggota')->default(0);
            $table->text('kegiatan_terakhir')->nullable(); // Fokus kegiatannya apa
            // Status pemantauan
            $table->enum('status', ['aktif', 'vakum', 'diawasi', 'dilarang'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ormas');
    }
};
