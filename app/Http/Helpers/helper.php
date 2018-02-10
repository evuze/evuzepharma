<?php
/**
 * Created by PhpStorm.
 * User: hirwaf
 * Date: 8/2/17
 * Time: 11:25 AM
 */


if ( !function_exists("getCurrentUser") ) {
    function getCurrentUser()
    {
        $guard = auth()->guard('pharmacy');
        if( $guard->check() ){
            return $guard->user();
        }

        return null;
    }
}

if ( !function_exists("getCurrentPharmacy") ) {
    function getCurrentPharmacy()
    {
        if ( ! is_null( getCurrentUser() ) ) {
            $pharmacist = getCurrentUser();

            return $pharmacist->pharmacy;
        }
        return null;
    }
}

if ( !function_exists('getDrugsNumber')  ) {
    function getDrugsNumber()
    {
        $count = \App\PharmDrug::where('pharmacy_id', getCurrentPharmacy()->id);

        return $count->count();
    }
}

if ( !function_exists('getMyStoke')  ) {
    function getMyStoke()
    {
        $stoke = \App\PharmDrug::where('pharmacy_id', getCurrentPharmacy()->id);

        return $stoke->get();
    }
}

if( ! function_exists("getExpiredDrugs") )
{
    function getExpiredDrugs()
    {
        $stoke = \App\PharmDrug::where('pharmacy_id', getCurrentPharmacy()->id);
    }
}

if ( ! function_exists('getPharmacyMenus') ) {
    function getPharmacyMenus($slug)
    {
        $view = false;
        if( isset($slug) ){
            if ( view()->exists("pharmacy.partials.menus.".$slug) ){
                $view = "pharmacy.partials.menus.".$slug;
                $size = \File::size(view()->make($view)->getPath());
                if( ! $size )
                    $view = false;
            }

        }
        return $view;
    }
}

if ( ! function_exists("getCurrentPharmacyInsurance") ){
    function getCurrentPharmacyInsurance()
    {
        $pharmInsurance = null;
        $pharm = getCurrentPharmacy();
        if ($pharm->insurance())
            $pharmInsurance = $pharm->insurance()->insurance();
    
        return $pharmInsurance;
    }
}

if( ! function_exists("getUserPharmacies") ) {
    function getUserPharmacies() {
        $user = auth()->user();
        $pharmacies = $user->pharmacies;

        return $pharmacies;
    }
}

if( ! function_exists("getInsurancePartner") ) {
    function getInsurancePartner($insurance=null, $square=false) {
        $user = auth()->user();
        $pharmacies = $user->pharmacies;
        $countPharm = $pharmacies->count();
        
        $enabledPharmacies = [];

        if( $countPharm > 0 ){
            foreach($pharmacies as $pharmacy) {
                if($pharmacy->getInsurance()->count() > 0 ){
                    foreach( $pharmacy->getInsurance()->get() as $pharmInsurance ) {
                        if( $pharmInsurance->insurance_id == $insurance ){
                            $enabledPharmacies[] = json_decode(json_encode([
                                'id'     =>  $pharmacy->id,
                                'name'   =>  $pharmacy->name
                            ]));
                        }
                    }
                }
            }
        }
        $feedback = $enabledPharmacies;

        if( $square == true ) {
            if( count($enabledPharmacies) == $countPharm )
                $feedback = true;
            else
                $feedback = false;
        }

        return $feedback;
    }
}

if( ! function_exists("getInsuranceFrom") ) {
    function getInsuranceFrom($insurance) {
        $find = \App\Insurance::find($insurance);
        if($find != null)
            return $find;

        return null;
    }
}

if(! function_exists("percentaging") ) {
    function percentaging($x=0, $t=0){
        $formula = 0;
        if( $t > 0 )
            $formula = ($x * 100) / $t;

        return $formula;
    }
}