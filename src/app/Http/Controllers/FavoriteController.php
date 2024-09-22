<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $route = $request->route;
        $userId = auth()->id();
        //お気に入り検索
        $favorite =Favorite::
            where('restaurant_id',$request->input('restaurant_id'))
            ->where('user_id', $userId)
            ->first();

        //お気に入り解除
        if($favorite){

            Favorite::find($favorite->id)->delete();
        }
        else{
            //お気に入り登録
            Favorite::create([
                'user_id' => $userId,
                'restaurant_id'=> $request->input('restaurant_id'),

        ]);

        }
        if($route == 'list'){
            return redirect('/list');

        }else{
            return redirect('/mypage');

        }

        
    }


}
