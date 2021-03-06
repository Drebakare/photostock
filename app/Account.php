<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id', 'account_name', 'account_number','bank'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
