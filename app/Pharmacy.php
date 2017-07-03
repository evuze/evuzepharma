<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Kblais\Uuid\Uuid;

class Pharmacy extends BaseModel
{
    //
    use Uuid;

//    protected $uuid_version = 1;

    public function save(array $options = [])
    {
        if ( Auth::check() && Auth::user()->hasRole('owner') ){
            // Forcing owner id to Pharmacy
            $this->user_id = Auth::user()->id;
        }

        parent::save();
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'id', 'pharmacy_id')
                    ->orderBy('name', 'ASC');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
