<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $guarded = ['id'];

    public function desa()
    {
        return $this->hasMany(Desa::class, 'kd_kec', 'kd_kec');
    }

    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class, 'kd_kab', 'kd_kab');
    }
}
