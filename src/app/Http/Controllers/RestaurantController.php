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
        $areas = Area::all();
        $genres = Genre::all();
        $restaurants = Restaurant::with(['area', 'genre'])->get();
        $favorites = Favorite::
            where('user_id', $user->id)
            ->get();

    return view('list', compact('areas','genres','restaurants','favorites'));
    }


    public function getDetail($id)
    {
        $restaurant = Restaurant::find($id);

        return view('detail', compact('restaurant'));
    }

    public function search(Request $request)
    {
    $areas = Area::all();
    $genres = Genre::all();

    $query = Restaurant::with(['area', 'genre']);

    if (!empty($request->area)) {
        $query->whereHas('area', function ($q) use ($request) {
            $q->where('area_id', $request->area);
        });
    }

    if (!empty($request->genre)) {
        $query->whereHas('genre', function ($q) use ($request) {
            $q->where('genre_id', $request->genre);
        });
    }

    if (!empty($request->search)) {
        $query->where('restaurant_name', 'like', '%' . $request->search . '%');
    }

    $restaurants = $query->get();

    return view('list', compact('areas', 'genres', 'restaurants'));
    }
}
