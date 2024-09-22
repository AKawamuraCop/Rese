<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Reservation;
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
}
