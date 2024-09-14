<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->id();
        Reservation::create([
                'user_id' => $userId,
                'restaurant_id'=> $request->input('restaurant_id'),
                'date' => $request->input('date'),
                'time'=> $request->input('time'),
                'number' => $request->input('number')

        ]);
        return view('done');
    }
}
