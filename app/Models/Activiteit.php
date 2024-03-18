<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activiteit extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
    ];

    public function inschrijvingsdetails(): HasMany
    {
        return $this->hasMany(Inschrijvingsdetail::class);
    }
}
