<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function getList()
    {
        $restaurants = Restaurant::all();
        return view('list', compact('restaurants'));
    }


    public function getDetail($id)
    {
        $restaurant = Restaurant::find($id);

        return view('detail', compact('restaurant'));
    }
}
