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

        Reservation::create([
                'user_id' => $userId,
                'restaurant_id'=> $request->input('restaurant_id'),
                'date' => $request->input('date'),
                'time'=> $request->input('time'),
                'number' => $request->input('number')

        ]);

        return view('done',compact('route'));

    }


    public function destroy(Request $request)
    {
        Reservation::find($request->reservation_id)->delete();

        return redirect('/mypage');

    }

    public function update(Request $request)
    {
        $userId = auth()->id();
        $reservation = Reservation::find($request->input('reservation_id'));

            if ($reservation && $reservation->user_id == $userId) {
                $reservation->update([
                    'date' => $request->input('date'),
                    'time' => $request->input('time'),
                    'number' => $request->input('number')
                ]);
            } else {
                return redirect()->back()->withErrors('Reservation not found or unauthorized.');
            }
        return redirect('/mypage')->withResult('予約を変更しました');

    }

    public function getList()
    {
        $reservations = Reservation::with(['user','restaurant'])->get();
        return view('reservationList', compact('reservations'));
    }
}
