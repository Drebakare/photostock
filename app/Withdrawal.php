<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id', 'amount',"status"
    ];

    public  function user()
    {
        return $this->belongsTo(User::class);
    }
}
