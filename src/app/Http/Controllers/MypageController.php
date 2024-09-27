<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Favorite;

class MypageController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $restaurants = Restaurant::with(['areas', 'genres'])->get();

        //予約状況取得
        $reservations = Reservation::with(['restaurant'])
            ->where('user_id', $user->id)
            ->whereDate('date', '>=', now()->toDateString())
            ->get();

        //過去の予約を取得
        $pastReservations = Reservation::with(['restaurant'])
            ->where('user_id', $user->id)
            ->whereDate('date', '<', now()->toDateString())
            ->groupBy('restaurant_id', 'user_id')
            ->selectRaw('MAX(date) as date, restaurant_id, user_id')
            ->get();


        $favorites = Favorite::with(['restaurant'])
            ->where('user_id', $user->id)
            ->get();


        return view('mypage',compact('reservations','pastReservations', 'favorites', 'user'));
    }
}
