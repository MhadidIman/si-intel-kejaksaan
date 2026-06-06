<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lapdus', function (Blueprint $table) {
            // Menambahkan kolom nomor_tiket setelah kolom id
            $table->string('nomor_tiket')->unique()->nullable()->after('id');
            
            // Memastikan status_laporan defaultnya adalah 'menunggu' (jika sebelumnya belum diset)
            $table->string('status_laporan')->default('menunggu')->change();
        });
    }

    public function down(): void
    {
        Schema::table('lapdus', function (Blueprint $table) {
            $table->dropColumn('nomor_tiket');
        });
    }
};