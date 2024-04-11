<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Locatie;
use App\Models\Optie;
use App\Models\Profiel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create predefined useraccounts made for testing purposes
         \App\Models\User::factory()
         ->has(\App\Models\Kind::factory()->count(2), 'kinds')
         ->has(Profiel::factory()->count(1)->sequence(['voornaam' => 'Maaike']), 'profiel')
         ->create([
             'email' => 'maaike@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => false
         ]);
         \App\Models\User::factory()
         ->has(\App\Models\Kind::factory()->count(3)->sequence(
             ['allergie' => 'aardbei', 'beperking' => 'ADHD', 'infoAdminAnimator' => 'kind bij overprikkeling even naar aparte ruimte'],
             ['medicatie' => 'in nood een puffer'],
             ['infoAdmin' => 'laatste kans na vechtpartijen zomer 2023, besproken met ouder op 22 augustus'],
         ), 'kinds')
             ->has(Profiel::factory()->count(1)->sequence(['voornaam' => 'Robbe']), 'profiel')
             ->create([
             'email' => 'robbe@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => false
         ]);
         \App\Models\User::factory()->create([
             'email' => 'sarah@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => true
         ]);

         //create 10 random users with 2 children each
        \App\Models\User::factory()
        ->count(10)
        ->has(\App\Models\Kind::factory()->count(2), 'kinds')
        ->create();

        //create 2 locaties
        Locatie::factory()
            ->count(2)
            ->create();

        //create 15 activiteiten
        \App\Models\Activiteit::factory()
            ->count(15)
            ->has(Locatie::factory()->count(1), 'locatie')
            ->has(Optie::factory()->count(2), 'opties')
            ->create();

        // create 10 inschrijvingen
        \App\Models\Inschrijvingsdetail::factory()
           ->count(10)
            ->sequence(
                ['kind_id' => '1', 'activiteit_id' => '2'],
                ['kind_id' => '2', 'activiteit_id' => '2'],
                ['kind_id' => '3', 'activiteit_id' => '2'],
                ['kind_id' => '3', 'activiteit_id' => '3'],
                ['kind_id' => '3', 'activiteit_id' => '5'],
                ['kind_id' => '4', 'activiteit_id' => '7'],
                ['kind_id' => '5', 'activiteit_id' => '7'],
                ['kind_id' => '5', 'activiteit_id' => '8'],
                ['kind_id' => '5', 'activiteit_id' => '9'],
                ['kind_id' => '5', 'activiteit_id' => '10'],

            )
            ->create();

    }
}
