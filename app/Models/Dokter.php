<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'id_poli'
    ];

    protected $table = 'dokter';
    protected $guarded = ['id'];
}
