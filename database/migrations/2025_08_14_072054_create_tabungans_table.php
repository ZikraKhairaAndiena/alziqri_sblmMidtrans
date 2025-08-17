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
        Schema::create('tabungans', function (Blueprint $table) {
            $table->integer('id')->length(11)->autoIncrement()->primary();
            $table->integer('siswa_id'); // FK ke tabel kelas
            $table->date('tanggal');
            $table->enum('jenis_transaksi', ['setor', 'tarik']);
            $table->decimal('jumlah', 15);
            $table->decimal('saldo', 15);
            $table->string('ket', 100);
            $table->timestamps();

            // Relasi ke tabel siswas
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabungans');
    }
};
