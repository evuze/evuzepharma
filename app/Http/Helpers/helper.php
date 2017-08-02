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