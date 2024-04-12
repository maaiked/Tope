<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inschrijvingsdetail_optie extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'optie_id', 'inschrijvingsdetail_id',
    ];
    public function optie(): BelongsTo
    {
        return $this->belongsTo(Optie::class);
    }
    public function inschrijvingsdetail(): BelongsTo
    {
        return $this->belongsTo(Inschrijvingsdetail::class);
    }
}
