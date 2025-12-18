<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pam_sdos', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_laporan');
            $table->string('kategori'); // Personil / Materiil / Dokumen
            $table->string('target'); // Nama Pegawai atau Nama Aset
            $table->string('nip_atau_nomor')->nullable(); // NIP (jika orang) / No Aset
            $table->text('uraian_masalah'); // Masalah yang terjadi / Potensi Ancaman
            $table->text('tindakan_pam'); // Apa yang dilakukan Intel
            $table->string('keterangan')->nullable();
            $table->enum('status', ['lid', 'proses', 'selesai', 'aman'])->default('lid');
            // lid = Penyelidikan, proses = Tindak Lanjut
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pam_sdos');
    }
};
