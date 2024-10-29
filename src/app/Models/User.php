<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Review;
use Laravel\Cashier\Billable;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'auth',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function restaurantFavorites()
    {
        return $this->belongsToMany(Restaurant::class, 'favorites', 'user_id', 'restaurant_id');
    }

    public function restaurantReservations()
    {
        return $this->belongsToMany(Restaurant::class, 'reservations', 'user_id', 'restaurant_id');
    }

    public function restaurantReviews()
    {
        return $this->belongsToMany(Restaurant::class, 'reviews', 'user_id', 'restaurant_id');
    }

}
