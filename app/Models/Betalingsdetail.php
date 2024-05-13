<?php

namespace App\Models;

use App\Enums\MethodeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Betalingsdetail extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $fillable =
        ['methode', 'datum'];

    protected $casts = [
        'datum' => 'date',
        'methode' => MethodeEnum::class
    ];

    public function inschrijvingsdetail(): BelongsTo
    {
        return $this->belongsTo(Inschrijvingsdetail::class);
    }
}
