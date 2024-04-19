<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inschrijvingsdetail;
use App\Models\Inschrijvingsdetail_optie;
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
         ]);
         \App\Models\User::factory()->create([
             'email' => 'sarah@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => true
         ]);
        \App\Models\User::factory()->create([
            'email' => 'yoni@tope.be',
            'password' => Hash::make('Laravel123'),
            'isAnimator' => true
        ]);

         //create 10 random users with 2 children each & with profiel
        \App\Models\User::factory()
        ->count(10)
        ->has(\App\Models\Kind::factory()->count(2), 'kinds')
            ->has(Profiel::factory()->count(1), 'profiel')
        ->create();

        //create 2 random users with 1 child each & no profiel
        \App\Models\User::factory()
            ->count(2)
            ->has(\App\Models\Kind::factory()->count(1), 'kinds')
            ->create();

        //create 2 locaties
        Locatie::factory()
            ->count(2)
            ->sequence(
                ['naam' => 'speelplein Aap'],['naam' => 'speelplein Konijn'] )
            ->create();

        //create 2 activiteiten for testing purposes
        \App\Models\Activiteit::factory()
            ->count(1)
            ->sequence(['prijs' => '5.50','aantalInschrijvingen'=>'5','capaciteit'=>'25', 'naam'=>'testactiviteit: donderdagnamiddag 28/04/2025 ','starttijd' => '2024-03-09 15:55:14', 'eindtijd' => '2036-03-09 15:55:14', 'inschrijvenVanaf' => '2024-03-09 15:55:14', 'inschrijvenTot' => '2036-03-09 15:55:14', 'annulerenTot' => '2036-03-09 15:55:14', 'leerjaarVanaf' => '1ste kleuter', 'leerjaarTot' => '5de middelbaar'] )
            ->has(Locatie::factory()->count(1), 'locatie')
            ->has(Optie::factory()->count(2)->sequence(['prijs' => '2.00', 'omschrijving' => 'maaltijd'], ['prijs' => '2.00', 'omschrijving' => 'opvang']), 'opties')
            ->has(Inschrijvingsdetail::factory()->count(5)->sequence(['prijs'=>'7.50', 'kind_id' => '1'], ['prijs'=>'9.50', 'kind_id' => '2'], ['prijs'=>'7.50', 'kind_id' => '3'], ['prijs'=>'9.50', 'kind_id' => '4'], ['prijs'=>'5.50', 'kind_id' => '5']))
            ->create();

        \App\Models\Activiteit::factory()
            ->count(1)
            ->sequence(['prijs' => '8.00','aantalInschrijvingen'=>'4','capaciteit'=>'10','naam'=>'testactiviteit: maandagnamiddag 23/04/2025','starttijd' => '2024-04-19 15:55:14', 'eindtijd' => '2036-04-19 15:55:14', 'inschrijvenVanaf' => '2024-04-19 15:55:14', 'inschrijvenTot' => '2036-04-19 15:55:14', 'annulerenTot' => '2036-04-19 15:55:14', 'leerjaarVanaf' => '2de kleuter', 'leerjaarTot' => '6de middelbaar' ])
            ->has(Locatie::factory()->count(1), 'locatie')
            ->has(Optie::factory()->count(1)->sequence(['prijs' => '3.00', 'omschrijving' => 'maaltijd']), 'opties')
            ->has(Inschrijvingsdetail::factory()->count(4)->sequence(['prijs'=>'11.00', 'kind_id' => '2'], ['prijs'=>'11.00', 'kind_id' => '3'], ['prijs'=>'8.00', 'kind_id' => '4'], ['prijs'=>'8.00', 'kind_id' => '5']))
            ->create();

        //create inschrijvingsdetail_opties for test inschrijvingen
        Inschrijvingsdetail_optie::factory()
            ->count(8)
            ->sequence(['inschrijvingsdetail_id'=>'1', 'optie_id'=>'1'], ['inschrijvingsdetail_id'=>'2', 'optie_id'=>'1'], ['inschrijvingsdetail_id'=>'2', 'optie_id'=>'2'], ['inschrijvingsdetail_id'=>'3', 'optie_id'=>'2'], ['inschrijvingsdetail_id'=>'4', 'optie_id'=>'1'], ['inschrijvingsdetail_id'=>'4', 'optie_id'=>'2'], ['inschrijvingsdetail_id'=>'6', 'optie_id'=>'3'], ['inschrijvingsdetail_id'=>'7', 'optie_id'=>'3'])
            ->create();

        //create 5 activiteiten
        \App\Models\Activiteit::factory()
            ->count(15)
            ->has(Locatie::factory()->count(1), 'locatie')
            ->has(Optie::factory()->count(2), 'opties')
            ->create();
    }
}
