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
        Schema::table('siswas', function (Blueprint $table) {
            // Ubah panjang no_nik & no_kk
            $table->string('no_nik', 16)->change();
            $table->string('no_kk', 16)->change();

            $table->integer('kelas_id')->nullable()->after('id'); // FK ke tabel kelas

            // Relasi ke tabel kelas
            $table->foreign('kelas_id')->references('id')->on('kelass')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('siswas', function (Blueprint $table) {
            // Kembalikan panjang seperti semula (25)
            $table->string('no_nik', 25)->change();
            $table->string('no_kk', 25)->change();

            // Hapus relasi & field kelas_id
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
