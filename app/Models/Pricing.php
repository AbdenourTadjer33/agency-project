<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_adult',
        'price_child',
        'price_baby',
        'price_lpd',
        'price_ldp',
        'price_lpc',
        'price_single',
        'price_double',
        'price_triple',
        'price_quadruple',
    ];

    public $timestamps = false;


    public function pricingable(): MorphTo
    {
        return $this->morphTo();
    }
}
