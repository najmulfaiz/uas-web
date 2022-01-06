<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_vaksin_id',
        'penyelenggara',
        'lat',
        'lng',
        'alamat',
    ];

    public function jenis_vaksin()
    {
        return $this->belongsTo(JenisVaksin::class);
    }

    public function jadwal_dosis()
    {
        return $this->hasMany(JadwalDosis::class);
    }
}
