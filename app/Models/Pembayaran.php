<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\PembayaranFactory> */
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'siswa_id',
        'order_id',
        'tgl_bayar',
        'nominal_bayar',
        'status_bayar',
        'link_pembayaran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
