<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FonnteLog extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'fonnte_logs';

    // Field yang boleh diisi mass assignment
    protected $fillable = [
        'nomor',
        'pesan',
        'response',
    ];

    // Supaya field response otomatis jadi array setelah diambil dari DB
    protected $casts = [
        'response' => 'array',
    ];
}
