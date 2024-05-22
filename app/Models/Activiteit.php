<?php

namespace App\Models;

use App\Enums\LeerjaarEnum;
use App\Enums\VakantieEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activiteit extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'naam', 'locatie_id', 'foto', 'omschrijving', 'starttijd', 'eindtijd', 'prijs', 'capaciteit',
        'aantalInschrijvingen', 'leerjaarVanaf', 'leerjaarTot', 'inschrijvenVanaf', 'inschrijvenTot',
        'annulerenTot', 'vakantie', 'uitdatabank_id', 'uitdatabank_url', 'uitdatabank_kansentarief'
    ];

    protected $casts = [
        'leerjaarTot' => LeerjaarEnum::class,
        'leerjaarVanaf' => LeerjaarEnum::class,
        'vakantie' => VakantieEnum::class
    ];

    public function inschrijvingsdetails(): HasMany
    {
        return $this->hasMany(Inschrijvingsdetail::class);
    }

    public function opties(): HasMany
    {
        return $this->hasMany(Optie::class);
    }

    public function locatie(): BelongsTo
    {
        return $this->belongsTo(Locatie::class);
    }
}
