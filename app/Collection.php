<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'upload_id', 'price'
    ];


    public function upload(){
        return $this->belongsTo(Upload::class);
    }
    public function photos(){
        return $this->belongsTo(Upload::class);
    }

}
