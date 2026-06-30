<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lapdus', function (Blueprint $table) {
            // Kita tambahkan KEDUA kolomnya sekaligus secara berurutan setelah kolom 'nik'
            $table->string('email_pelapor')->nullable()->after('nik');
            $table->string('foto_ktp')->nullable()->after('email_pelapor');
        });
    }

    public function down(): void
    {
        Schema::table('lapdus', function (Blueprint $table) {
            $table->dropColumn(['email_pelapor', 'foto_ktp']);
        });
    }
};
