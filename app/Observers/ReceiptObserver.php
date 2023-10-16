<?php

namespace App\Observers;

use App\Models\Receipt;
use App\Models\ReservationTime;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class ReceiptObserver
{
    /**
     * Handle the Receipt "created" event.
     */


    public function changeTimeForNewBooking(Receipt $receipt)
    {
        $time = $receipt->reservation_time;
        $serviceDuration = $receipt->service->duration;

        $time->is_available = 0;

        $timesNeeded = $serviceDuration / Service::shortestDuration();
        Log::info("needed : $timesNeeded");
        if ($timesNeeded > 1) {
            $timesNeeded = ceil($timesNeeded);
            Log::info("new needed : $timesNeeded");
            for ($i = 1; $i < $timesNeeded; $i++) {
                $nextTime = ReservationTime::find($time->id + $i);
                $newEndTime = $nextTime->end_time;
                $nextTime->is_available = 0;
                $time->end_time = $newEndTime;
                $nextTime->save();
            }
        }
        $time->save();
    }

    public function changePreviousTimes(int $oldTimeId)
    {
        $currentTime = ReservationTime::find($oldTimeId);
        $nextTime = ReservationTime::find($currentTime->id + 1);
        $endTime = $currentTime->end_time;
        $currentTime->end_time = $nextTime->start_time;
        $currentTime->is_available = true;

        while ($endTime > $nextTime->start_time) {
            $nextTime->is_available = true;
            $nextTime->save();
            $nextTime = ReservationTime::find($nextTime->id + 1);
        }

        $currentTime->save();
    }

    public function created(Receipt $receipt): void
    {
        $this->changeTimeForNewBooking($receipt);
    }

    /**
     * Handle the Receipt "updated" event.
     */
    public function updated(Receipt $receipt): void
    {
        $oldId = $receipt->getOriginal('reservation_time_id');

        $this->changePreviousTimes($oldId);
        $this->changeTimeForNewBooking($receipt);
    }

    /**
     * Handle the Receipt "deleted" event.
     */
    public function deleted(Receipt $receipt): void
    {
        $this->changePreviousTimes($receipt->reservation_time->id);
    }

    /**
     * Handle the Receipt "restored" event.
     */
    public function restored(Receipt $receipt): void
    {
        //
    }

    /**
     * Handle the Receipt "force deleted" event.
     */
    public function forceDeleted(Receipt $receipt): void
    {
        //
    }
}
