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
        Schema::table('kelass', function (Blueprint $table) {
            $table->integer('thn_ajaran_id')->after('id');
            $table->integer('guru_id')->after('nama_kelas');

            $table->foreign('thn_ajaran_id')->references('id')->on('thn_ajarans')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelass', function (Blueprint $table) {
            $table->dropForeign(['thn_ajaran_id']);
            $table->dropForeign(['guru_id']);

            // Hapus kolom
            $table->dropColumn(['thn_ajaran_id', 'guru_id']);
        });
    }
};
