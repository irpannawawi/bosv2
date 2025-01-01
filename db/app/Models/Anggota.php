<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table ='anggota';
    protected $fillable =[
        'nrp',
        'pangkat',
        'nama',
        'kd_desa',
        'kd_kec',
        'username',
        'password',
    ];

    public function desa()
    {
        return $this->hasOne(Desa::class, 'kd_desa', 'kd_desa')
            ->where('kd_kec', $this->kd_kec);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'nrp', 'nrp');
    }
}
