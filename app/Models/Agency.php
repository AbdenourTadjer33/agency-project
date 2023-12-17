<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'networks',
    ];

    public $cast = [
        'networks' => 'array',
    ];


    public function agencyCoordinates() : HasMany {
        return $this->hasMany(AgencyCoordinate::class);
    }

    public $timestamps = false;
}
