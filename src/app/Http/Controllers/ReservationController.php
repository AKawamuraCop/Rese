<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $userId = auth()->id();
        $route = $request->route;

        if($request->route == 'update')
        {
            $reservation = Reservation::find($request->input('reservation_id'));

            if ($reservation && $reservation->user_id == $userId) {
                $reservation->update([
                    'restaurant_id' => $request->input('restaurant_id'),
                    'date' => $request->input('date'),
                    'time' => $request->input('time'),
                    'number' => $request->input('number')
                ]);
            } else {
                return redirect()->back()->withErrors('Reservation not found or unauthorized.');
            }

            return view('done',compact('route'));

        }else{

            Reservation::create([
                'user_id' => $userId,
                'restaurant_id'=> $request->input('restaurant_id'),
                'date' => $request->input('date'),
                'time'=> $request->input('time'),
                'number' => $request->input('number')

        ]);

        return view('done',compact('route'));

        }
        
    }

    public function destroy(Request $request)
    {
        Reservation::find($request->reservation_id)->delete();

        return redirect('/mypage');

    }

    public function update(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $date = $reservation->date;
        $time = $reservation->time;
        $number = $reservation->number;

        $restaurant = Restaurant::find($reservation->restaurant_id);
        $route = $request->route;
        return view('detail', compact('restaurant','reservation','route'));

    }
}
