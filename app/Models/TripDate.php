<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'date_departure',
        'date_return'
    ];

    public $timestamps = false;
}
