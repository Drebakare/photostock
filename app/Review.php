<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'rating', 'comment','image_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function photos(){
        return $this->belongsTo(Photo::class, "image_id");
    }
}
