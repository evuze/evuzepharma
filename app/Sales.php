<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;

    protected $fillable = ['drug_id','customer_id','unitprice','quantity','total'];

    public function drugIdList(){
        return PharmDrug::where('pharmacy_id',getCurrentPharmacy())->get();
    }


    public function customId(){
        return $this->belongsTo(Custom::class);
    }

    /**
    *  Relation for normal eloquent logic
    *
    */
    public function drug(){
        return $this->belongsTo(Drug::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
