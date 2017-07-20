<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PharmacyController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/pharmacy/dashboard';

    protected $guard = 'pharmacy';


    public function showLoginForm()
    {
        return view('voyager::login', [
            'pharmacy' => str_random(16)
        ]);
    }

    public function guard()
    {
        return \Auth::guard($this->guard);
    }

//    public function loading()
//    {
//        $this->middleware('pharmacy.auth');
//
//        $pharmacy = str_slug($this->guard()->user()->pharmacy->name);
//
//        return redirect("/".$pharmacy."/");
//    }


    public function username()
    {
        return 'email';
    }
}
