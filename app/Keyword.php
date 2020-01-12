<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{

    protected $fillable = [
        'user_id', 'keyword','search_count'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

}
