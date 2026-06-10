<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lapsus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Relasi ke user pembuat
            $table->date('tanggal_laporan');
            $table->enum('tingkat_kerahasiaan', ['Penting', 'Rahasia', 'Sangat Rahasia']);
            $table->string('siapa');
            $table->text('apa');
            $table->string('kapan');
            $table->string('dimana');
            $table->text('mengapa');
            $table->text('bagaimana');
            $table->text('analisa')->nullable();
            $table->text('saran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapsus');
    }
};
