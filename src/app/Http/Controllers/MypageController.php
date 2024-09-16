<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Favorite;

class MypageController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $restaurants = Restaurant::with(['area', 'genre'])->get();

        $reservations = Reservation::with(['restaurant'])
            ->where('user_id', $user->id)
            ->get();

        $favorites = Favorite::with(['restaurant.area', 'restaurant.genre'])
            ->where('user_id', $user->id)
            ->get();

        return view('mypage',compact('reservations', 'favorites', 'user'));
    }
}
