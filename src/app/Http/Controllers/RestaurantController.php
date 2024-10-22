<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $user = auth()->user();
        $userId = $user->id;
        $userAuth = $user->auth;

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
        {//件数が等しい場合は、予約が可能になる
            $show = 'reservation';
        }

        //店舗代表だけが見ることができるQRを生成
        if($userAuth === 2)
        {
            // 予約が存在する場合、QRコードを生成
            $reservations = Reservation::where('restaurant_id', $restaurant->id)
                        ->whereDate('date', '>', now()->toDateString())
                        ->get();

            $qrCode = null;
            if ($reservations->isNotEmpty()) {
                // すべての予約情報を配列として取得
                $qrCodeData = [];
                foreach ($reservations as $reservation) {
                    $qrCodeData[] = [
                        'restaurant_name' => $restaurant->name,
                        'date' => $reservation->date,
                        'time' => $reservation->time,
                        'number' => $reservation->number,
                        'user_id' => $reservation->user_id,
                    ];
                }

                // QRコードに予約情報をエンコードし、ルート情報を付加
                $encodedData = route('reservation.check', [
                    'data' => json_encode($qrCodeData)
                ]);

                // QRコードを生成するためのライブラリを使用（例: Simple QR Code Generator）
                $qrCode = QrCode::generate($encodedData); // QrCodeは使用するライブラリに応じて変更
            }

        }else{
            $qrCode = null;
        }


        return view('detail', compact('restaurant', 'route', 'show', 'qrCode'));
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
        $restaurant = null;
        return view('restaurantRegister', compact('restaurant'));
    }

    public function postRestaurantRegister(Request $request)
    {

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

                // ジャンルをレストランに紐付けて保存
                Genre::create([
                    'number' => $genreData['number'],
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
                    'number' => $areaData['number'],
                    'name' => $areaData['name'],
                    'restaurant_id' => $restaurant->id

                ]);
            }
        }
        return redirect()->back()->with('success', 'Restaurant registered successfully.');

    }

    public function getUpdateList()
    {
        $user = auth()->user();
        $restaurants = Restaurant::with(['areas', 'genres'])->get();

    return view('restaurantUpdateList', compact('restaurants'));
    }

    public function getRestaurantUpdate(Request $request)
    {

        $restaurant = Restaurant::with(['areas', 'genres'])->find($request->restaurant_id);

        return view('restaurantUpdate', compact('restaurant'));
    }


    public function postRestaurantUpdate(Request $request)
    {
        // 画像を保存し、そのパスを取得
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            // パスを簡単にアクセスできるようにする
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        } else {
            $imagePath = null; // 画像がアップロードされない場合
        }

        $restaurantId = $request->input('restaurant_id');

        Restaurant::find($restaurantId)->update([
            'restaurant_name' => $request->input('restaurant_name'),
            'description' => $request-> input('description'),
        ]);

        //画像を更新
        if($imagePath != null){
            Restaurant::find($restaurantId)->update([
                'image' => $imagePath
            ]);
        }

        // ジャンルを更新
        $existGenres = Genre::where('restaurant_id', $restaurantId)->get();

        $genres = $request->input('genres');
        $existingGenreIds = $existGenres->pluck('number')->toArray();  // 既存ジャンルのIDを配列に変換

        if (!empty($genres)) {
            // 新しいジャンルの処理
            foreach ($genres as $genre) {
                // JSON形式の値をデコードして配列に変換
                $genreData = json_decode($genre, true);
                // ジャンルが存在しなければ新規作成
                if (!in_array($genreData['number'], $existingGenreIds)) {
                    Genre::create([
                        'number' => $genreData['number'],
                        'name' => $genreData['name'],
                        'restaurant_id' => $restaurantId,
                        ]);
                }
            }
        }

        // 削除対象のジャンルの処理
        $newGenreIds = array_column(array_map('json_decode', $genres), 'number');  // 新しいジャンルのIDを配列に変換
        foreach ($existGenres as $existGenre) {
            // 新しいジャンルの中に既存のジャンルがなければ削除
            if (!in_array($existGenre->number, $newGenreIds)) {
                $existGenre->delete();
            }
        }

         // エリアを更新
        $existAreas = Area::where('restaurant_id', $restaurantId)->get();

        $areas = $request->input('areas');
        $existingAreaIds = $existAreas->pluck('number')->toArray();  // 既存エリアのIDを配列に変換

        if (!empty($areas)) {
            // 新しいジャンルの処理
            foreach ($areas as $area) {
                // JSON形式の値をデコードして配列に変換
                $areaData = json_decode($area, true);
                // ジャンルが存在しなければ新規作成
                if (!in_array($areaData['number'], $existingAreaIds)) {
                    Area::create([
                        'number' => $areaData['number'],
                        'name' => $areaData['name'],
                        'restaurant_id' => $restaurantId,
                        ]);
                }
            }
        }

        // 削除対象のエリアの処理
        $newAreaIds = array_column(array_map('json_decode', $areas), 'id');  // 新しいジャンルのIDを配列に変換
        foreach ($existAreas as $existArea) {
            // 新しいエリアの中に既存のエリアがなければ削除
            if (!in_array($existArea->number, $newAreaIds)) {
                $existArea->delete();
            }
        }

        return redirect()->back()->with('success', 'Restaurant registered successfully.');

    }
}