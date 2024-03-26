<?php

namespace Database\Factories;

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
            'allergie' => "geen allergie",
            'beperking' => "niets",
            'medicatie' => "geen medicatie",
            'alleenNaarHuis' =>fake()->boolean(),
            'afhalenKind' => "alleen door ouders",
            'fotoToestemming' => fake()->boolean(),
            'rijksregisternummer' => "010101.00101",
            'uitpasnummer' => "010101.00101",
            'uitpasDatumCheck' => fake()->date(),
            'infoAdminAnimator' => "hier komt de interne info voor admin en animator",
            'infoAdmin' => "hier komt de interne info enkel zichtbaar voor admin",
        ];
    }
}
