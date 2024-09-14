<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Area extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['area_name'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_areas');
    }

    
}
