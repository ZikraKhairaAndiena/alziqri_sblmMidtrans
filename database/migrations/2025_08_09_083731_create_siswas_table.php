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
        Schema::create('siswas', function (Blueprint $table) {
            $table->integer('id')->length(11)->autoIncrement()->primary();
            $table->integer('user_id'); // FK ke tabel users
            $table->string('nisn', 20)->nullable()->unique();
            $table->string('nama_siswa', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tmp_lahir', 20);
            $table->date('tgl_lahir');
            $table->enum('agama', ['islam', 'kristen', 'budha', 'hindu', 'kong_hu_cu']);
            $table->string('suku_bangsa', 20);
            $table->integer('anak_ke');
            $table->integer('jmlh_saudara_kandung');
            $table->text('alamat');
            $table->enum('tmp_tinggal', ['orang_tua', 'wali', 'nenek', 'saudara']);
            $table->string('no_nik', 25);
            $table->string('no_kk', 25);
            $table->string('no_akte', 25);
            $table->string('nama_wali', 100);
            $table->string('no_telp', 15);
            $table->string('foto', 255)->nullable();
            $table->string('foto_kk', 255);
            $table->string('foto_akte', 255);
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('tidak_aktif');
            $table->timestamps();

            // Relasi ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
