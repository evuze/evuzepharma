<?php

namespace App\Http\Controllers\Activities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnershipController extends Controller
{
    
    function __constructor() {
        
    }

    public function partner($id) {
        $this->middleware('admin.user');
        $pharmacies = getUserPharmacies();
        $partner = getInsurancePartner($id);
        $insurance = \App\Insurance::find($id);
        $resetpharm = [];
        $newnew = false;
        
        if( $pharmacies->count() > 0 && count($partner) > 0 ) {
            foreach($pharmacies as $pharmacy ) {
                foreach($partner as $value) {
                    if( $value->id != $pharmacy->id ) {
                        $resetpharm[] = json_encode([
                            'id'    =>  $pharmacy->id,
                            'name'  =>  $pharmacy->name
                        ]);
                    }
                }
            }
        }else{
            $resetpharm = $pharmacies;
            $newnew = true;
        }
        if( ! $newnew ){
            if( count($resetpharm) <= 0 )
                $resetpharm = json_encode([]);
            else
                $resetpharm = json_encode($resetpharm);

            $resetpharm = json_decode($resetpharm);
        }

        // dd($resetpharm);

        return view("vendor.voyager.insurances.partner", compact("resetpharm", "insurance", "newnew"));
    }

    

    public function submit(Request $request)
    {
        if( $request->has('pharmacies') ) {
            $insurance = $request->input('insurance');            
            foreach( $request->input('pharmacies') as $pharmacy ) {
                $exist = \App\PharmInsurance::where('pharmacy_id', $pharmacy)
                                            ->where('insurance_id', $insurance)
                                            ->withTrashed();
                
                if( $exist->count() <= 0 ) {
                    $pharminsurance = new \App\PharmInsurance();
                    $pharminsurance->pharmacy_id = $pharmacy;
                    $pharminsurance->insurance_id = $insurance;
                    $pharminsurance->save();
                }else{
                    if( $exist->first()->trashed() ){
                        $pharminsurance = $exist->first();
                        $pharminsurance->restore();
                    }
                }
            }
        }

        return redirect()->route('voyager.insurances.index');
    }

    public function destroy(Request $request, $id)
    {
        $find = \App\PharmInsurance::find($id);
        if($find)
            $find->delete();

        return redirect()->back();
    }

}
