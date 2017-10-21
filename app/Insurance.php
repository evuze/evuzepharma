<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;


class Insurance extends Model
{
    use SoftDeletes;
    use Uuid;
 
    protected $fillable = ['full_name', 'short_name', 'description'];

    protected $dates = ['deleted_at'];

    public function pharmacies() {
        return $this->hasMany(PharmInsurance::class);
    }

    /**
     * Get All Pharmacies Base on Insurance Single Model     
     */
     
    public function getPharmacies(){
        $pharmacies = $this->pharmacies();
        if( $pharmacies != null ) {
            if ( $pharmacies->count() > 0 ){
                $pharmacies = $pharmacies->pharmacy()->get();
                return $pharmacies;
            }
        }

        return null;
    }


}