<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppdb extends Model
{
    /** @use HasFactory<\Database\Factories\PpdbFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'siswa_id',
        'thn_ajaran_id',
        'tgl_daftar',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function thn_ajaran()
    {
        return $this->belongsTo(ThnAjaran::class, 'thn_ajaran_id');
    }
}
