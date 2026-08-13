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
        Schema::table('dpos', function (Blueprint $table) {
            $table->text('kasus')->change();
            $table->text('ciri_fisik')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dpos', function (Blueprint $table) {
            $table->string('kasus')->change();
            $table->string('ciri_fisik')->nullable()->change();
        });
    }
};
