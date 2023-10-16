<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert(
            [
                [
                    'name' => 'RooShooE',
                    'duration' => '15',
                    'price' => '25'
                ],
                [
                    'name' => 'Dahkel',
                    'duration' => '20',
                    'price' => '30'
                ],
                [
                    'name' => 'SefrShooE',
                    'duration' => '60',
                    'price' => '80'
                ]
            ]
        );
    }
}
