<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Optie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'prijs', 'omschrijving', 'datum'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Activiteit::class);
    }
    public function inschrijvingsdetail_opties(): HasMany
    {
        return $this->hasMany(Inschrijvingsdetail_optie::class);
    }
}
