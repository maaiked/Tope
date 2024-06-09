<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Text extends Model
{
    use HasTrixRichText;

    protected $guarded = [];
}
