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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->integer('id')->length(11)->autoIncrement()->primary();
            $table->integer('siswa_id'); // FK ke tabel kelas
            $table->string('order_id', 255)->nullable();
            $table->datetime('tgl_bayar')->nullable();
            $table->bigInteger('nominal_bayar');
            $table->enum('status_bayar', ['pending', 'paid', 'expired', 'denied', 'cancelled'])->default('pending');
            $table->string('link_pembayaran', 255)->nullable();
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
        Schema::dropIfExists('pembayarans');
    }
};
