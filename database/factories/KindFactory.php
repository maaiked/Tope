<?php

namespace Database\Factories;

use App\Enums\LeerjaarEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kind>
 */
class KindFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'voornaam' => fake()->firstName(),
            'familienaam' =>fake()->lastName(),
            'contactpersoon' =>fake()->name(),
            'alleenNaarHuis' =>fake()->boolean(),
            'afhalenKind' => fake()->randomElement(['alleen door ouders', 'oma Katrien', 'oma en opa Kip', 'tante Saskia', 'meetje en peetje']),
            'fotoToestemming' => fake()->boolean(),
            'rijksregisternummer' => fake()->numerify('##.##.##-###.##'),
            'uitpasnummer' => fake()->numerify('#############'),
            'leerjaar' => fake()->randomElement(LeerjaarEnum::cases())->value,
            'uitpasDatumCheck' => fake()->date(),
        ];
    }
}
