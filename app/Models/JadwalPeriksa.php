<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    protected $table = 'jadwal_periksa';
    protected $guarded = ['id'];

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal'); 
    }
}
