<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'destination',
        'category',
        'formule_base',
        'assets',
        'hotel_id',
    ];

    public $cast = [
        'assets' => 'array',
    ];


    public function tripDates() : HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function pricing(): MorphOne
    {
        return $this->morphOne(Pricing::class, 'pricingable');
    }
}
