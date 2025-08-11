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
            $table->integer('siswa_id'); // FK ke tabel kelas
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade'); // Jika siswa dihapus, kehadiran ikut terhapus
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
