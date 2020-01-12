<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'user_id', 'approved','comment',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function collections()
    {
        return $this->hasOne(Collection::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public  function user()
    {
        return $this->belongsTo(User::class);
    }
}
