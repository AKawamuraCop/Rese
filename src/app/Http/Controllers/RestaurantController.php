<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

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

    public function getRestaurantRegister()
    {
        return view('restaurantRegister');
    }

    public function postRestaurantRegister(Request $request)
    {
        // バリデーションを行う（必要に応じて追加）
        // 画像を保存し、そのパスを取得
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            // パスを簡単にアクセスできるようにする
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        } else {
            $imagePath = null; // 画像がアップロードされない場合
        }
        // Restaurantのデータを保存し、そのIDを取得
        $restaurant = Restaurant::create([
                'name' => $request->input('restaurant_name'),
                'description' => $request->input('description'),
                'image' => $imagePath
        ]);

        // ジャンルを保存
        $genres = $request->input('genres');
        if (!empty($genres)) {
            foreach ($genres as $genre) {
                // JSON形式の値をデコードして配列に変換
                $genreData = json_decode($genre, true);

                Genre::create([
                    'number' => $genreData['id'],
                    'name' => $genreData['name'],
                    'restaurant_id' => $restaurant->id
                ]);
            }
        }

        // エリアを保存
        $areas = $request->input('areas');
        if (!empty($areas)) {
            foreach ($areas as $area) {
                // JSON形式の値をデコードして配列に変換
                $areaData = json_decode($area, true);

                Area::create([
                    'number' => $areaData['id'],
                    'name' => $areaData['name'],
                    'restaurant_id' => $restaurant->id

                ]);
            }
        }
        return redirect()->back()->with('success', 'Restaurant registered successfully.');

    }
}