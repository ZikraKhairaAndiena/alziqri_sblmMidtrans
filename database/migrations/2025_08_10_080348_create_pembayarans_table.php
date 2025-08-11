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
            $table->string('order_id')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->decimal('nominal_bayar', 15);
            $table->enum('status_bayar', ['pending', 'paid', 'expired', 'cancelled', 'denied'])->default('pending');
            $table->text('link_pembayaran')->nullable();
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
