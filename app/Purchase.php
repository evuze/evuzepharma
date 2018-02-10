<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;
use Auth;

class Purchase extends Model
{
    //
    use Uuid;
    use SoftDeletes;

    public function save(array $options = [])
    {
        if ( Auth::guard('pharmacy')->check() ){
            $this->pharmacy_id = Auth::guard('pharmacy')->user()->pharmacy_id;
            $this->employee_id = Auth::guard('pharmacy')->user()->id;
        }

        parent::save();
    }
}