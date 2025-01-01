<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;
    protected $table = 'dusun';

    protected $fillable = [
        'kd_prov',
        'kd_kab',
        'kd_kec',
        'kd_desa',
        'nama',
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class)->where('kd_desa', $this->kd_desa)->where('kd_kec', $this->kd_kec)->where('kd_kab', $this->kd_kab)->where('kd_prov', $this->kd_prov);
    }

}
