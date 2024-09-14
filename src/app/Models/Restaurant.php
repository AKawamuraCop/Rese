<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Genre;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['restaurant_name','description','image'];


    public function areas()
    {
        return $this->belongsToMany(Area::class, 'restaurant_areas');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'restaurant_genres');
    }
}
