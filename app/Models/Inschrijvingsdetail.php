<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inschrijvingsdetail extends Model
{
    use HasFactory;
    public function kind(): BelongsTo
    {
        return $this->belongsTo(Kind::class);
    }
    public function activiteit(): BelongsTo
    {
        return $this->belongsTo(Activiteit::class);
    }
}
