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
            'naam' => fake()->randomElement(['maandagvoormiddag', 'maandagnamiddag', 'dinsdagvoormiddag', 'dinsdagnamiddag', 'paasvakantie week 1', 'paasvakantie week2' ]),
            'omschrijving' => fake()->sentence(),
            'starttijd' =>fake()->dateTimeBetween('-2 week', '+3 week'),
            'eindtijd' =>fake()->dateTimeBetween('-2 week', '+4 week'),
            'prijs' =>fake()->randomFloat('2', '2', '20'),
            'capaciteit' =>fake()->numberBetween('11', '50'),
            'aantalInschrijvingen'  =>fake()->numberBetween('0', '10'),
            'leerjaarVanaf' => fake()->randomElement(LeerjaarEnum::cases())->value,
            'leerjaarTot'=> fake()->randomElement(LeerjaarEnum::cases())->value,
            'inschrijvenVanaf' => fake()->dateTimeBetween('-2 week', '+2 week'),
            'inschrijvenTot' => fake()->dateTimeBetween('-1 week', '+3 week'),
            'annulerenTot' =>fake()->dateTimeBetween('-1 week', '+3 week'),
            'vakantie' => fake()->randomElement(VakantieEnum::cases())->value,
        ];
    }
}
