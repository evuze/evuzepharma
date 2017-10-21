<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class PharmInsurance extends Model
{
    //
    use SoftDeletes;
    use Uuid;

    protected $dates = ['deleted_at'];

    protected $fillable = ['pharmacy_id', 'insurance_id'];

    public function pharmacy() {
        $this->belongsTo(Pharmacy::class, 'pharmacy_id');
    }

    public function insurance() {
        $this->belongsTo(Insurance::class, 'insurance_id');
    }

}
