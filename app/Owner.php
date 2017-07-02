<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    //

    public function pharmacies()
    {
        return $this->hasMany(Pharmacy::class);
    }

}
