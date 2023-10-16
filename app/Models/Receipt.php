<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'service_id', 'reservation_time_id', 'code'];

    protected function reservation_time()
    {
        return $this->belongsTo(ReservationTime::class);
    }

    protected function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function checkForBooking(array $receiptAttributes): bool
    {

        $smallestDuration = Service::shortestDuration();
        $serviceDuration = Service::find($receiptAttributes['service_id'])->duration;
        $timesNeeded = $serviceDuration / $smallestDuration;
        $time = ReservationTime::find($receiptAttributes['reservation_time_id']);

        Log::info("short : $smallestDuration | duration : $serviceDuration | need : $timesNeeded ");
        if ($timesNeeded > 1) {
            $timesNeeded = ceil($timesNeeded);
            for ($i = 1; $i < $timesNeeded; $i++) {
                $nextTime = ReservationTime::find($time->id + $i);

                if (!$nextTime->is_available) {
                    return false;
                }
            }
        }

        return true;
    }

}
