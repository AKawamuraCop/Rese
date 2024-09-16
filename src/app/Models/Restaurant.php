<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservations;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['restaurant_name','description','image'];


    public function area()
    {
        return $this->belongsToMany(Area::class, 'restaurant_areas');
    }

    public function genre()
    {
        return $this->belongsToMany(Genre::class,'restaurant_genres');
    }

    public function reservation()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function favorite()
    {
        return $this->hasMany('App\Models\Favorite');
    }
}
