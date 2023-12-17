<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_departure',
        'date_return',
        'status',
        'numbre_adult',
        'number_child',
        'number_baby',
        'is_payed',
        'is_online'
    ];
}
