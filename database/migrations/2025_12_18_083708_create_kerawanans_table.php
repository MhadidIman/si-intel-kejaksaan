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
            $table->string('kecamatan'); // Nama Kecamatan
            $table->string('desa'); // Nama Desa/Kelurahan
            $table->string('jenis_ancaman'); // Misal: Sengketa Lahan, Konflik Agama
            $table->string('tokoh_kunci')->nullable(); // Provokator / Tokoh Masyarakat
            $table->text('deskripsi_singkat');
            $table->enum('tingkat_rawan', ['rendah', 'sedang', 'tinggi']);
            // Tinggi = Merah, Sedang = Kuning, Rendah = Hijau
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kerawanans');
    }
};
