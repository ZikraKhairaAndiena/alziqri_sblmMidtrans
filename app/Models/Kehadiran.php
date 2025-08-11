<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    /** @use HasFactory<\Database\Factories\KehadiranFactory> */
    use HasFactory;

    protected $table = 'kehadirans';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
