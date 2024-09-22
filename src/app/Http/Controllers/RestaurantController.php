<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;

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
        $restaurant = Restaurant::find($request->restaurant_id);
        $route = $request->route;

        return view('detail', compact('restaurant', 'route'));
    }

    public function search(Request $request)
    {

        $user = auth()->user();
        $query = Restaurant::with(['areas', 'genres']);

    if (!empty($request->area)) {
        $query->whereHas('areas', function ($q) use ($request) {
            $q->where('area_number', $request->area);
        });
    }

    if (!empty($request->genre)) {
        $query->whereHas('genres', function ($q) use ($request) {
            $q->where('genre_number', $request->genre);
        });
    }

    if (!empty($request->search)) {
        $query->where('restaurant_name', 'like', '%' . $request->search . '%');
    }

    $restaurants = $query->get();
    $favorites = Favorite::where('user_id', $user->id)->get();

    return view('list', compact('restaurants','favorites'));
    }
}
