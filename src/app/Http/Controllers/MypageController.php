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

        //中間テーブルを作って、Mypageにお気に入りを表示させるとき、
        //中間テーブルから直接取り出す方がいいのか、Mypageなので、ユーザモデルから関連情報をする方がいいのか
        //Laravelは正規化の考え方はあるのか？
        $reservations = Reservation::with(['restaurant'])
            ->where('user_id', $user->id)
            ->get();

        $favorites = Favorite::with(['restaurant'])
            ->where('user_id', $user->id)
            ->get();

        //$reservations = User::with('restaurantReservations')
            //->where('id', $user->id)
            //->get();

        //$favorites = User::with('restaurantFavorites')
            //->where('id', $user->id)
            //->get();


        return view('mypage',compact('reservations', 'favorites', 'user'));
    }
}
