<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    protected $fillable = [
        'id_periksa',
        'id_obat'
    ];

    protected $table = 'detail_periksa';
    protected $guarded = ['id'];
}
