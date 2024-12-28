<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservations;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Review;
use App\Models\Feedback;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name','description','image'];


    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }


    public function userFavorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'restaurant_id', 'user_id');
    }

    public function userReservations()
    {
        return $this->belongsToMany(User::class, 'reservations', 'restaurant_id', 'user_id');
    }

    public function userReview()
    {
        return $this->belongsToMany(User::class, 'reviews', 'restaurant_id', 'user_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function feedbackByUser($userId)
    {
        return $this->hasOne(Feedback::class)->where('user_id', $userId);
    }

    public function getAverageRateAttribute()
    {
        // フィードバックがない場合は null を返す
        if ($this->feedbacks->isEmpty()) {
            return null;
        }

        // フィードバックのレートの平均を計算
        return $this->feedbacks->avg('rate');
    }
}
