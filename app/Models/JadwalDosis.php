<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'dosis_id',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function dosis()
    {
        return $this->belongsTo(Dosis::class);
    }
}
