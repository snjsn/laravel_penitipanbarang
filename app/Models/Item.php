<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'jenis',
        'kondisi',
        'status',
        'foto',
        'tanggal_masuk'
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
    ];
}