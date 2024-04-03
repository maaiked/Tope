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
            'allergie' => fake()->randomElement([null, null, null, null, 'kiwi', 'shmink', 'melk', 'ei', 'aardbei', 'pollen']),
            'medicatie' => fake()->randomElement([null, null, null, null, null, null, null, null, 'siroop over de middag', 'puffer in nood', 'relatine']),
            'beperking' =>fake()->randomElement([null, null, null, null, null, null, null, null, 'ASS', 'ADHD', 'doof rechts', 'astma']),
            'fotoToestemming' => fake()->boolean(),
            'rijksregisternummer' => fake()->numerify('##.##.##-###.##'),
            'uitpasnummer' => fake()->numerify('#############'),
            'leerjaar' => fake()->randomElement(LeerjaarEnum::cases())->value,
            'uitpasDatumCheck' => fake()->date(),
            'infoAdmin' => fake()->randomElement([null, null, null, null, null, null, null, null, null, null, 'op voorhand betalen', 'laatste kans na vechtpartij zomer 2023', 'in nood werkgever X bellen', 'ouders spreken Frans']),
            'infoAdminAnimator' => fake()->randomElement([null, null, null, null, null, null, null, null, null, null, 'spreekt geen Nederlands', 'moeite met drukte', 'indien nodig afzonderen', 'niet zindelijk', 'wegloper'])

        ];
    }
}
