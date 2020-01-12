<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashout extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
