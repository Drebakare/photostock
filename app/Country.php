<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function region(){
        return $this->hasOne(Region::class);
    }
}
