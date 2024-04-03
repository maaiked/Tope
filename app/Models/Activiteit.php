<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activiteit extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'message',
    ];

    public function inschrijvingsdetails(): HasMany
    {
        return $this->hasMany(Inschrijvingsdetail::class);
    }
}
