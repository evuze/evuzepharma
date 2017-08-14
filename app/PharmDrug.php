<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;

class PharmDrug extends Model
{
    use Uuid;

    /**
     * Voyager Relationship logic
     */
    public function drugId()
    {
        return $this->belongsTo(Drag::class);
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
        return $this->belongsTo(Drag::class);
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
