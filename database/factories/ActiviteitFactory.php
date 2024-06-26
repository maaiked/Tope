<?php

namespace Database\Factories;

use App\Enums\LeerjaarEnum;
use App\Enums\VakantieEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        // https://stackoverflow.com/questions/26700446/laravel-faker-increment-generated-datetime

        $starts_at = Carbon::createFromTimestamp(fake()->dateTimeBetween($startDate = '-3 days', $endDate = '+4 week')->getTimeStamp()) ;
        $ends_at= Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addHours( fake()->numberBetween( 1, 4 ) );
        $inscribe_from = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addDays( fake()->numberBetween( -7, -21 ) );
        $inscribe_to = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addDays( fake()->numberBetween( -1, -6 ) );
        $unsubscribe = Carbon::createFromFormat('Y-m-d H:i:s', $starts_at)->addDays( fake()->numberBetween( -1, -6 ) );

        return [
            'naam' => fake()->randomElement(['maandagvoormiddag', 'maandagnamiddag', 'dinsdagvoormiddag', 'dinsdagnamiddag', 'woensdagvoormiddag', 'woensdagnamiddag', 'donderdagvoormiddag', 'donderdagnamiddag', 'vrijdagvoormiddag', 'vrijdagnamiddag' ]),
            'omschrijving' => fake()->sentence(),
            'starttijd' => $starts_at,
            'eindtijd' => $ends_at,
            'prijs' =>fake()->randomFloat(2, 2, 20),
            'capaciteit' =>fake()->numberBetween(11, 50),
            'aantalInschrijvingen'  =>'0',
            'leerjaarVanaf' => fake()->randomElement([1, 2, 3, 11, 12, 13]),
            'leerjaarTot'=> fake()->randomElement([14, 15, 16, 21, 22, 23, 24, 25, 26]),
            'inschrijvenVanaf' => $inscribe_from,
            'inschrijvenTot' => $inscribe_to,
            'annulerenTot' => $unsubscribe,
            'vakantie' => fake()->randomElement(VakantieEnum::cases())->value,
            'locatie_id' =>fake()->numberBetween(1, 2),
        ];
    }
}
