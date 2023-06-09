<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)
             ->withPersonalTeam()
             ->create();

         User::factory()
             ->withPersonalTeam()
             ->create([
             'name' => 'Josh Cuneo',
             'email' => 'josh@critical.codes',
         ]);
    }
}