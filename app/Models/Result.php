<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'birthday',
        'os',
        'status'
    ];

    public static function wasSent($os)
    {
        $result = self::where('os', $os)->first();

        if($result != null) {
            return true;
        } else {
            return false;
        }
    }

}
