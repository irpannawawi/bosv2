<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';

    protected $fillable = [
        'kd_prov',
        'kd_kab',
        'nama',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kd_prov', 'kd_prov');
    }

    public function kecamatanans()
    {
        return $this->hasMany(Kecamatan::class, 'kd_kab', 'kd_kab');
    }
}
