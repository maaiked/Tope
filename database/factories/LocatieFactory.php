<?php

namespace Database\Factories;

use App\Models\Locatie;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocatieFactory extends Factory
{
    protected $model = Locatie::class;

    public function definition(): array
    {
        return [
            'naam' => fake()->randomElement(['Speelplein Aap', 'speelplein Konijn']),
            'straat' => fake()->streetAddress(),
            'gemeente' => fake()->city()
        ];
    }
}
