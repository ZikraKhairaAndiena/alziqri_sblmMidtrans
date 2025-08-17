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
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->integer('id')->length(11)->autoIncrement()->primary();
            $table->integer('siswa_id'); // FK ke tabel siswa
            $table->integer('kelas_id'); // FK ke tabel kelas
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha'])->default('hadir');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade'); // Jika siswa dihapus, kehadiran ikut terhapus
            $table->foreign('kelas_id')->references('id')->on('kelass')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadirans');
    }
};
