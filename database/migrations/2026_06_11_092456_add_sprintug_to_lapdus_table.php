<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lapdus', function (Blueprint $table) {
            $table->string('nomor_sprintug')->nullable()->after('status_laporan');
            $table->date('tanggal_sprintug')->nullable()->after('nomor_sprintug');
        });
    }

    public function down(): void
    {
        Schema::table('lapdus', function (Blueprint $table) {
            $table->dropColumn(['nomor_sprintug', 'tanggal_sprintug']);
        });
    }
};
