<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'destination',
        'formule_base',
        'assets',
        'trip_category_id',
        'hotel_id',
    ];

    public $cast = [
        'assets' => 'array',
    ];

    public function tripCategory() : HasOne
    {
        return $this->hasOne(TripCategorie::class);
    }

    public function tripDates() : HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function pricing(): MorphOne
    {
        return $this->morphOne(Pricing::class, 'pricingable');
    }
}
