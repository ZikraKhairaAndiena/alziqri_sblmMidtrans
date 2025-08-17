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
        Schema::create('rapors', function (Blueprint $table) {
            $table->integer('id')->length(11)->autoIncrement()->primary();
            $table->integer('siswa_id'); // FK ke tabel kelas
            $table->integer('thn_ajaran_id'); // FK ke tabel tahun ajaran
            $table->enum('semester', [1, 2]);
            $table->text('agama');
            $table->string('foto_agama', 255);
            $table->text('jati_diri');
            $table->string('foto_jati_diri', 255);
            $table->text('literasi');
            $table->string('foto_literasi', 255);
            $table->text('steam');
            $table->string('foto_steam', 255);
            $table->timestamps();

            // Relasi
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('thn_ajaran_id')->references('id')->on('thn_ajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapors');
    }
};
