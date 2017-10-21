<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacistController extends Controller
{


    public function __construct()
    {
        $this->middleware('pharmacy.auth');
    }

    public function dashboard()
    {
        $user = $this->user();

        return view('pharmacy.dashboard', compact('user'));
    }

    public function importDrugs()
    {
        return dd($this->user());
    }

    public function exportDrugs()
    {
        return dd(null);
    }

    protected function user()
    {
        return auth()->guard('pharmacy')->user();
    }



}
