<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    /** @use HasFactory<\Database\Factories\TabunganFactory> */
    use HasFactory;

    protected $table = 'tabungans';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jenis_transaksi',
        'jumlah',
        'saldo',
        'ket',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
