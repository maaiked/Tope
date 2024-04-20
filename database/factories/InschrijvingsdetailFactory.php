<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inschrijvingsdetail>
 */
class InschrijvingsdetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'inschrijvingsdatum' => fake()->dateTimeBetween('-3years' ),
            'prijs' =>fake()->randomFloat(2, 1, 120),
            'kind_id' =>fake()->numberBetween(5, 10)
        ];
    }
}
