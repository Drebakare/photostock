<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','token','is_seller'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
    public function withdrawal()
    {
        return $this->hasMany(Withdrawal::class);
    }
    public function cashout()
    {
        return $this->hasMany(Cashout::class);
    }
    public function account()
    {
        return $this->hasMany(Account::class);
    }
    public function keywords()
    {
        return $this->hasMany(Keyword::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

