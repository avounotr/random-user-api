<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public static function getAllCodeValues() {
        return static::all()->pluck('code')->toArray();
    }
}
