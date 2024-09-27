<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;

class RestaurantController extends Controller
{
     public function getList()
    {
        $user = auth()->user();
        $restaurants = Restaurant::with(['areas', 'genres'])->get();
        $favorites = Favorite::
            where('user_id', $user->id)
            ->get();

    return view('list', compact('restaurants','favorites'));
    }


    public function getDetail(Request $request)
    {
        $userId = auth()->id();
        $restaurant = Restaurant::find($request->restaurant_id);
        $route = $request->route;

        //過去予約の件数を取得
        $reservationCount = Reservation::where('user_id', $userId)
                        ->where('restaurant_id', $restaurant->id)
                        ->whereDate('date', '<', now()->toDateString())
                        ->count();

        //評価の件数を取得
        $reviewCount = Review::where('user_id', $userId)
                    ->where('restaurant_id', $restaurant->id)
                    ->count();

        // 件数が等しくない場合は、評価画面を表示させる
        if($reservationCount !== $reviewCount)
        {
            $show = 'review';
        }
        else
        {
            $show = 'reservation';
        }

        return view('detail', compact('restaurant', 'route', 'show'));
    }

    public function search(Request $request)
    {

        $user = auth()->user();
        $query = Restaurant::with(['areas', 'genres']);

    if (!empty($request->area)) {
        $query->whereHas('areas', function ($q) use ($request) {
            $q->where('number', $request->area);
        });
    }

    if (!empty($request->genre)) {
        $query->whereHas('genres', function ($q) use ($request) {
            $q->where('number', $request->genre);
        });
    }

    if (!empty($request->search)) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $restaurants = $query->get();
    $favorites = Favorite::where('user_id', $user->id)->get();

    return view('list', compact('restaurants','favorites'));
    }
}
