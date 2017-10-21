<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;

class PharmDrug extends Model
{
    use Uuid;


    public function save(array $options = [])
    {
        if ( Auth::guard('pharmacy')->check() ){
            // Forcing owner id to Pharmacy
            $this->pharmacy_id = Auth::guard('pharmacy')->user()->pharmacy_id;
        }

        parent::save();
    }


    /**
     * Voyager Relationship logic
     */
    public function drugId()
    {
        return $this->belongsTo(Drug::class);
    }

    public function unitId()
    {
        return $this->belongsTo(DrugUnit::class);
    }

    public function strengthId()
    {
        return $this->belongsTo(DrugStrength::class);
    }

    /**
     * Relationship for normal eloquent logic
     */

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function unit()
    {
        return $this->belongsTo(DrugUnit::class);
    }

    public function strength()
    {
        return $this->belongsTo(DrugStrength::class);
    }
}
