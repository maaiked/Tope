<?php

namespace App\Models;

use App\Enums\MethodeEnum;
use Illuminate\Database\Eloquent\Model;

class Betalingsdetail extends Model
{
    public $timestamps = false;

    protected $casts = [
        'datum' => 'date',
        'methode' => MethodeEnum::class
    ];
}
