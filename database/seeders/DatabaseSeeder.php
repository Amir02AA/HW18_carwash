<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Day;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        Day::insert(
            [
                ['name' => 'saturday'],
                ['name' => 'sunday'],
                ['name' => 'monday'],
                ['name' => 'tuesday'],
                ['name' => 'wednesday'],
                ['name' => 'thursday'],
                ['name' => 'friday']
            ]
        );

        $this->call([
            ReservationTimeSeeder::class,
            ServiceSeeder::class
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
