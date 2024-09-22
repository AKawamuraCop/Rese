<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservations;
use App\Models\Favorite;
use App\Models\User;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['restaurant_name','description','image'];


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
}
