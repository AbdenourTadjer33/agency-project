<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'country',
        'city',
        'address',
        'coordinates',
        'classification',
        'number_rooms',
        'services',
        'assets',
    ];

    public $cast = [
        'coordinates' => 'array',
        'services' => 'array',
        'assets' => 'array',
    ];

    public function pricing(): MorphOne
    {
        return $this->morphOne(Pricing::class, 'pricingable');
    }
}
