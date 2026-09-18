<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'guest', 'reservation_date',
        'reservation_time', 'message', 'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];
}
