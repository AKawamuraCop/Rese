<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Genre extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['number','name','restaurant_id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
