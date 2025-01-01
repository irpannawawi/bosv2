<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';

    protected $fillable = [
        'id',
        'kd_prov',
        'nama',
        'created_at',
        'updated_at'
    ];

    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'kd_prov', 'kd_prov');
    }
}
