<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'nrp',
        'tanggal',
        'nama',
        'dusun',
        'rt',
        'rw',
        'desa',
        'keterangan',
    ];
}
