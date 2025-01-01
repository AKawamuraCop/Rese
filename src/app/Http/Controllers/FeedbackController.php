<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function getFeedback($restaurant_id)
    {
        $restaurant = Restaurant::with(['areas', 'genres'])
                    ->where('id' ,$restaurant_id)->first();
        $favorites = Favorite::
            where('user_id', Auth::id())
            ->where('restaurant_id', $restaurant_id)
            ->first();

        $feedback = null;

        return view('feedback',compact('restaurant','favorites','feedback'));

    }

    public function postFeedback(FeedbackRequest $request)
    {
        $restaurantId = $request->input('restaurant_id');
        $show = 'reservation';
        $route = 'list';
        $qrCode = null;

        //レストラン情報検索
        $restaurant = Restaurant::where('id', $restaurantId)->first();

        //口コミがあるか確認
        $feedback = Feedback::where('user_id', Auth::id())
                    ->where('restaurant_id', $restaurantId)
                    ->first();

        // 画像を保存し、そのパスを取得
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            // パスを簡単にアクセスできるようにする
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }
        else {
            $imagePath = null; // 画像がアップロードされない場合
        }

        //口コミがなかったら作成
        if(empty($feedback))
        {

            $feedback = Feedback::create([
                    'user_id' => Auth::id(),
                    'restaurant_id'=> $request->input('restaurant_id'),
                    'rating' => $request->input('rating'),
                    'comment'=>$request->input('comment'),
                    'image' => $imagePath
            ]);

            
        }
        else
        {
            $feedback -> update([
                    'user_id' => Auth::id(),
                    'restaurant_id'=> $request->input('restaurant_id'),
                    'rating' => $request->input('rating'),
                    'comment'=>$request->input('comment'),
            ]);
            if(!empty($imagePath))
            {
                $feedback -> update([
                    'image' => $imagePath
            ]);
            }
            
 
        }

        return redirect()->route('restaurant.detail', ['restaurant_id' => $restaurantId])
        ->with([
            'route' => $route,
            'show' => $show,
            'qrCode' => $qrCode,
            'feedback' => $feedback,
        ]);

    
    }

    public function update($restaurant_id)
    {
        $restaurant = Restaurant::with(['areas', 'genres'])
                    ->where('id' ,$restaurant_id)->first();
        $favorites = Favorite::
            where('user_id', Auth::id())
            ->where('restaurant_id', $restaurant_id)
            ->first();

        $feedback = Feedback::
                    where('restaurant_id', $restaurant_id)
                    ->where('user_id', Auth::id())
                    ->first();


        return view('feedback',compact('restaurant','favorites','feedback'));

    }

    // public function delete($restaurant_id)
    // {
    //     $restaurant = Restaurant::with(['areas', 'genres'])
    //                 ->where('id' ,$restaurant_id)->first();
    //     $favorites = Favorite::
    //         where('user_id', Auth::id())
    //         ->where('restaurant_id', $restaurant_id)
    //         ->first();

    //     $feedback = Feedback::
    //                 where('restaurant_id', $restaurant_id)
    //                 ->where('user_id', Auth::id())
    //                 ->first();
    //     if($feedback)
    //     {
    //         $feedback->delete();
    //         $feedback = null;
    //     }

    //     return view('feedback',compact('restaurant','favorites','feedback'));

    // }

    public function showAllFeedback($restaurantId)
{
    // レストランIDに基づいて、そのレストランの全ての口コミを取得
    $feedbacks = Feedback::where('restaurant_id', $restaurantId)
                            ->with('user')
                            ->get();

    return view('feedbackList', compact('feedbacks'));
}

public function deleteFeedback($feedbackId)
{
    $feedback = Feedback::find($feedbackId);
    
    if (Auth::user()->auth == 1) {
        $feedback->delete();
    } else if ($feedback && $feedback->user_id == Auth::id()) {
    
    $feedback->delete();
    }

    return redirect()->back()->with('msg', '口コミが削除されました');
}


}
