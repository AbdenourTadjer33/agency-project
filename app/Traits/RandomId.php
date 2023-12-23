<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait RandomId
{

    public static function randomId(string $col = 'ref')
    {
        do {
            $randomId = str_shuffle(time() . random_int(1000, 9999));
        } while (static::where($col, $randomId)->first());
        return $randomId;
    }
}
