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
            'afhalenKind' => "alleen door ouders",
            'fotoToestemming' => fake()->boolean(),
            'rijksregisternummer' => "010101.00101",
            'uitpasnummer' => "010101.00101",
            'leerjaar' => fake()->randomElement(LeerjaarEnum::cases())->value,
            'uitpasDatumCheck' => fake()->date(),
        ];
    }
}
