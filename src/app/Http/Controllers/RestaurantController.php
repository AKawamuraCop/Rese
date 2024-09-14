<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;

class RestaurantController extends Controller
{
    public function getList()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $restaurants = Restaurant::with(['areas', 'genres'])->get();
    return view('list', compact('areas','genres','restaurants'));
    }


    public function getDetail($id)
    {
        $restaurant = Restaurant::find($id);

        return view('detail', compact('restaurant'));
    }

    public function search(Request $request)
    {
    // Fetch areas and genres for dropdown options
    $areas = Area::all();
    $genres = Genre::all();

    // Start with a basic query for restaurants
    $query = Restaurant::with(['areas', 'genres']);

    // Filter by area if an area is selected
    if (!empty($request->area)) {
        $query->whereHas('areas', function ($q) use ($request) {
            $q->where('area_id', $request->area);
        });
    }

    // Filter by genre if a genre is selected
    if (!empty($request->genre)) {
        $query->whereHas('genres', function ($q) use ($request) {
            $q->where('genre_id', $request->genre);
        });
    }

    // Search by restaurant name or other fields (optional)
    if (!empty($request->search)) {
        $query->where('restaurant_name', 'like', '%' . $request->search . '%');
    }

    // Get the filtered list of restaurants
    $restaurants = $query->get();

    // Return the search results to the view
    return view('list', compact('areas', 'genres', 'restaurants'));
    }
}
