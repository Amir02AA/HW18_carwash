<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\ReservationTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class ReservationTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dayIds = Day::all()->pluck('id')->sort()->toArray();
        foreach ($dayIds as $dayId) {
            $timeStamp = Date::createFromTime(9);
            for ($i = 0; $i < 48; $i++) {
                ReservationTime::create(
                    [
                        'start_time' => $timeStamp->toTimeString(),
                        'end_time' => $timeStamp->addMinutes(15)->toTimeString(),
                        'day_id' => $dayId
                    ]
                );
            }
        }
    }
}
