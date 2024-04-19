<?php

namespace Database\Factories;

use App\Models\Inschrijvingsdetail_optie;
use Illuminate\Database\Eloquent\Factories\Factory;

class Inschrijvingsdetail_optieFactory extends Factory
{
    protected $model = Inschrijvingsdetail_optie::class;

    public function definition(): array
    {
        return [
            'optie_id' =>fake()->numberBetween(1, 4)
        ];
    }
}
