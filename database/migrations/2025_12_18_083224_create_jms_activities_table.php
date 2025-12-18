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
            $table->string('nama_sekolah'); // Tempat kegiatan
            $table->date('tanggal_kegiatan');
            $table->string('materi'); // Misal: Bahaya Narkoba / Bullying
            $table->integer('jumlah_siswa')->default(0); // Audiens
            $table->string('nama_jaksa'); // Siapa pematerinya
            $table->text('keterangan')->nullable(); // Catatan tambahan
            $table->string('foto_kegiatan')->nullable(); // Bukti dukung
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jms_activities');
    }
};
