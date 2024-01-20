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

    public static function randomCode()
    {
        do {
            $randomCode = str_shuffle(random_int(10000, 99999));
        } while (static::where('code', $randomCode)->first());
        return $randomCode;
    }
}
