<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'adit_booking';
    
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'jam',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}
