<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $table = 'adit_lapangan';
    
    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'lokasi',
        'gambar'
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
