<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inschrijvingsdetail extends Model
{
    use SoftDeletes, HasFactory;
    public function kind(): BelongsTo
    {
        return $this->belongsTo(Kind::class);
    }
    public function activiteit(): BelongsTo
    {
        return $this->belongsTo(Activiteit::class);
    }

    protected $guarded = [
        'ziekenfondsattestVerzonden', 'deelnemersattestVerzonden'
    ];
}
