<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         ->has(\App\Models\Kind::factory()->count(3), 'kinderen')
         ->create([
             'name' => 'Maaike',
             'email' => 'maaike@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => false
         ]);
         \App\Models\User::factory()
         ->has(\App\Models\Kind::factory()->count(1), 'kinderen')
         ->create([
             'name' => 'Robbe',
             'email' => 'robbe@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => false
         ]);
         \App\Models\User::factory()->create([
             'name' => 'Sarah',
             'email' => 'sarah@tope.be',
             'password' => Hash::make('Laravel123'),
             'isAdmin' => true
         ]);

         //create 10 random users with 2 children each
        \App\Models\User::factory()
        ->count(10)
        ->has(\App\Models\Kind::factory()->count(2), 'kinderen')
        ->create();
        
        //create 15 activiteiten
        \App\Models\Activiteit::factory()
            ->count(10)
            ->sequence(
                ['message' => 'Paasvakantie week 1 - maandag'],
                ['message' => 'Paasvakantie week 1 - dinsdag'],
                ['message' => 'Paasvakantie week 1 - woensdag'],
                ['message' => 'Paasvakantie week 1 - donderdag'],
                ['message' => 'Paasvakantie week 1 - vrijdag'],
                ['message' => 'Paasvakantie week 2 - maandag'],
                ['message' => 'Paasvakantie week 2 - dinsdag'],
                ['message' => 'Paasvakantie week 2 - woensdag'],
                ['message' => 'Paasvakantie week 2 - donderdag'],
                ['message' => 'Paasvakantie week 2 - vrijdag'],
            )
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
