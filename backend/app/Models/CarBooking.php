<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
    /** @use HasFactory<\Database\Factories\CarBookingFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'start_time',
        'end_time',
    ];
}
