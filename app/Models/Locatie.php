<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locatie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'naam', 'straat', 'gemeente'
    ];

    public function activiteits(): HasMany
    {
        return $this->hasMany(Activiteit::class);
    }
}
