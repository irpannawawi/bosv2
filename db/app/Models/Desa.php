<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'desa';

    protected $fillable = [
        'nama',
        'kd_prov',
        'kd_kab',
        'kd_kec',
        'kd_desa',
    ];


    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'kd_kec', 'kd_kec');
    }




}
