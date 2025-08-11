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
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->integer('id')->length(11)->autoIncrement()->primary();
            $table->integer('user_id'); // FK ke tabel users
            $table->integer('thn_ajaran_id'); // FK ke tabel tahun ajaran
            $table->integer('siswa_id'); // FK ke tabel siswa
            $table->date('tgl_daftar');
            $table->enum('status', ['Diproses', 'Diterima', 'Ditolak'])->default('Diproses');
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('thn_ajaran_id')->references('id')->on('thn_ajarans')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
