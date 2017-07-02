<?php

namespace App;

use Kblais\Uuid\Uuid;

class Pharmacy extends BaseModel
{
    //
    use Uuid;

//    protected $uuid_version = 1;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ownerId()
    {
        return $this->belongsTo(Owner::class);
    }
}
