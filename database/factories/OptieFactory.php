<?php

namespace Database\Factories;

use App\Models\Optie;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptieFactory extends Factory
{
    protected $model = Optie::class;

    public function definition(): array
    {
        return [
            'prijs' => fake()->randomFloat('2', '1', '30'),
            'omschrijving' => fake()->randomElement(['middagmaal', 'zwemmen', 'opvang', 'toneel', 'uitstap']),
            'datum' => fake()->date()
        ];
    }
}
