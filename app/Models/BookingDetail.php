<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_uuid',
        'booking_id',
        'first_name',
        'last_name',
        'dob',
        'passport_number'
    ];

    public $timestamps = false;
}
