<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Excel;
use App\Drug;

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

    public function exportDrugs(Request $request)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'drugs')->first();

        return view('pharmacy.drugs.export', compact('dataType'));
    }

    public function exportingDrugs(Request $request)
    {
        $drugs = Drug::all(['short_name', 'full_name'])->take(5);
        
        $arrayToExport = [];
        //Column Title
        $arrayToExport[] = ['Drug Code', 'Drug Name', 'Drug Batch Number', 'Manufactured Date', 'Imported Date', 'Expiring Date', 'Quantity'];
        if( $drugs != null ){
            foreach ($drugs as $drug) {
                $arrayToExport[] = [$drug->short_name,$drug->full_name];
            }
        }

        // Excel::create('drugEntryFormat', function($excel) use ($arrayToExport) {
        //     $excel->setTitle('DrugEntryFormat');
        //     $excel->setCreator('hirwaf')->setCompany('e-vuze');
        //     $excel->setDescription('');

        //     $excel->sheet('sheet1', function($sheet) use ($arrayToExport) {
        //         $sheet->fromArray($arrayToExport, null, "A1", false, false);
        //     });

        // })->download('csv'); // xlsx

        return dd(getCurrentPharmacy()->id." ==== ".$this->user()->pharmacy->id);
    }

    public function getSlug(Request $request)
    {
        // parent::getSlug($request);

        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $slug = explode('.', $request->route()->getName())[0];
        }

        return $slug;
    }

    protected function user()
    {
        return auth()->guard('pharmacy')->user();
    }



}
