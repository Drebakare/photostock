<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'country_id', 'currency_code', 'name','rate'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
