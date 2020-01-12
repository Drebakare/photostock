<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'picture_id', 'price', 'is_paid', 'upload_id','collection_id'
    ];

    public function photos()
    {
        return $this->belongsTo(Photo::class);
    }
    public function upload ()
    {
        return $this->belongsTo(Upload::class);
    }
    public  function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
