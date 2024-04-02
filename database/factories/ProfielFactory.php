<?php

namespace Database\Factories;

use App\Models\Profiel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfielFactory extends Factory
{
    protected $model = Profiel::class;

    public function definition(): array
    {
        return [
            'voornaam' => fake()->firstName(),
            'familienaam' =>fake()->lastName(),
            'straat' =>fake()->streetName(),
            'huisnummer' =>fake()->numberBetween(1, 40),
            'bus' => fake()->numberBetween(0, 37),
            'postcode' => fake()->numberBetween(1000, 9999),
            'gemeente' => fake()->city(),
            'telefoonnummer' => fake()->phoneNumber(),
            'rijksregisternummer' => fake()->numerify('##.##.##-###.##'),
        ];
    }
}
