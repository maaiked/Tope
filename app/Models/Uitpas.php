<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uitpas extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'clientId', 'clientSecret', 'api_url', 'io_url', 'account_url', 'organizerId', 'locationId'
    ];
}
