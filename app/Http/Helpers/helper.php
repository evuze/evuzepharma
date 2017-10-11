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
        $pharm = getCurrentPharmacy();
        $pharmInsurance = $pharm->insurance()->insurance();
    
        return $pharmInsurance;
    }
}