<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'user_id',
        'nip',
        'nama_guru',
        'jenis_kelamin',
        'tgl_lahir',
        'alamat',
        'no_telp',
        'foto',
        'tgl_mulai_ngajar',
        'pend_terakhir',
        'jabatan',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'guru_id');
    }
}
