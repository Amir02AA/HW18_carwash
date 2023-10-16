<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function shortestDuration():int
    {
        return (int) min(self::all()->pluck('duration')->toArray());
    }
}
