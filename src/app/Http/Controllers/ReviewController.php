<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->id();
        $restaurantId = $request->input('restaurant_id');

        Review::create([
            'user_id' => $userId,
            'restaurant_id'=> $request->input('restaurant_id'),
            'rate' => $request->input('rating'),
            'comment'=>$request->input('comment')
        ]);

        return back()->with('msg', '評価ありがとうございました');


    }
}
