<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['names','sex','address','phone','dob','weight','illness','nameofprincipal','cardnumber','medicalcenter','insurance_id'];

    public function drugIdList(){
        return PharmInsurance::where('pharmacy_id',getCurrentPharmacy())->get();
    }

    public function insuranceId(){
        return $this->belongsTo(Insurance::class);
    }

    

    public function insurance(){
        return $this->belongsTo(Insurance::class);
    }
}
