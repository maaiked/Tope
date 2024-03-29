<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Profiel extends Model
{
    use HasFactory;
    protected $fillable = [
        'voornaam', 'familienaam', 'straat', 'huisnummer', 'bus',
        'postcode', 'gemeente','rijksregisternummer',
        'telefoonnummer',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
