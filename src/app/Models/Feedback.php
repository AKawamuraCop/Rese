<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Restaurant;

class Feedback extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

     protected $table = 'feedbacks';

    protected $fillable = ['user_id','restaurant_id','rating','comment', 'image'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}

