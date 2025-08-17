<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThnAjaran extends Model
{
    /** @use HasFactory<\Database\Factories\ThnAjaranFactory> */
    use HasFactory;

    protected $table = 'thn_ajarans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }

    public function ppdbs()
    {
        return $this->hasMany(Ppdb::class, 'thn_ajaran_id');
    }

    public function rapors()
    {
        return $this->hasMany(Rapor::class, 'thn_ajaran_id');
    }

    public function kelass()
    {
        return $this->hasMany(Kelas::class, 'thn_ajaran_id');
    }
}
