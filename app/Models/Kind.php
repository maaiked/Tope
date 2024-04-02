<?php

namespace App\Models;

use App\Enums\LeerjaarEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kind extends Model
{
    use HasFactory;
    protected $fillable = [
        'voornaam', 'familienaam', 'contactpersoon', 'allergie', 'beperking', 'medicatie',
        'alleenNaarHuis', 'afhalenKind', 'fotoToestemming', 'rijksregisternummer',
        'uitpasnummer', 'infoAdminAnimator', 'infoAdmin', 'leerjaar',
    ];

    protected $casts = [
        'leerjaar' => LeerjaarEnum::class
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function inschrijvingsdetails(): HasMany
    {
        return $this->hasMany(Inschrijvingsdetail::class);
    }
}
