<?php

namespace App\Http\Controllers;

use App\Models\ReservationTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function times()
    {
        $times = ReservationTime::query()->paginate(24);
        return view('time',compact('times'));
    }
    public function timesEdit()
    {
        $times = ReservationTime::query()->paginate(24);
        return view('timeEdit',compact('times'));
    }
}
