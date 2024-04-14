<?php

namespace Database\Factories;

use App\Enums\LeerjaarEnum;
use App\Enums\VakantieEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activiteit>
 */
class ActiviteitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naam' => fake()->randomElement(['maandagvoormiddag', 'maandagnamiddag', 'dinsdagvoormiddag', 'dinsdagnamiddag', 'woensdagvoormiddag', 'woensdagnamiddag', 'donderdagvoormiddag', 'donderdagnamiddag', 'vrijdagvoormiddag', 'vrijdagnamiddag' ]),
            'omschrijving' => fake()->sentence(),
            'starttijd' =>fake()->dateTimeBetween('-2 week', '+1 week'),
            'eindtijd' =>fake()->dateTimeBetween('+1 week', '+4 week'),
            'prijs' =>fake()->randomFloat('2', '2', '20'),
            'capaciteit' =>fake()->numberBetween('11', '50'),
            'aantalInschrijvingen'  =>fake()->numberBetween('0', '10'),
            'leerjaarVanaf' => fake()->randomElement(['1ste kleuter', '2de kleuter', '3de kleuter', '1ste leerjaar', '2de leerjaar', '3de leerjaar']),
            'leerjaarTot'=> fake()->randomElement(['4de leerjaar', '5de leerjaar', '6de leerjaar', '1ste middelbaar', '2de middelbaar', '3de middelbaar', '4de middelbaar', '5de middelbaar', '6de middelbaar']),
            'inschrijvenVanaf' => fake()->dateTimeBetween('-4 week', '+1 week'),
            'inschrijvenTot' => fake()->dateTimeBetween('-3 day', '+3 week'),
            'annulerenTot' =>fake()->dateTimeBetween('-1 day', '+3 week'),
            'vakantie' => fake()->randomElement(VakantieEnum::cases())->value,
        ];
    }
}
