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

    public function importDrugs(Request $request)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'drugs')->first();
        return view('pharmacy.drugs.import', compact('dataType'));
    }

    public function importingDrugs(Request $request)
    {
        $this->validate($request, [
            'file_import' => 'bail|required|mimes:xlsx',
        ]);
        
        $path = $request->file('file_import')->getRealPath();

        return dd($path);

    }

    public function exportDrugs(Request $request)
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', 'drugs')->first();

        return view('pharmacy.drugs.export', compact('dataType'));
    }

    public function exportingDrugs(Request $request)
    {                
        $arrayToExport = [];
        //Column Title
        $arrayToExport[] = ['Drug Code', 'Drug Name', 'Drug Batch Number', 'Manufactured Date', 'Imported Date', 'Expiring Date', 'Quantity'];
        

        switch($request->input('options')){
            case 1:
                $drugs = Drug::all(['short_name', 'full_name']);
                if( $drugs != null ){
                    foreach ($drugs as $drug) {
                        $arrayToExport[] = [$drug->short_name,$drug->full_name];
                    }
                }
                if( count($arrayToExport) > 0 )
                    $this->download($arrayToExport);

                break;
            case 2:
                break;
            case 3:
                $medecines = $request->input('medecine');
                $drugs = Drug::whereIn('id', $medecines)->get(['short_name', 'full_name']);
                
                if( $drugs != null ){
                    foreach ($drugs as $drug) {
                        $arrayToExport[] = [$drug->short_name,$drug->full_name];
                    }
                }

                if( count($arrayToExport) > 0 )
                    $this->download($arrayToExport);
                
                break;
        };

        return redirect()->back();
    }

    private function download($arrayToExport)
    {
        $date = date("Y-m-d", time());
        $excel = Excel::create('drugEntryFormat_' . $date, function($excel) use ($arrayToExport) {
            $date = date("Y-m-d", time());
            $excel->setTitle('DrugEntryFormat-' . $date);
            $excel->setCreator('hirwaf')->setCompany('e-vuze');
            $excel->setDescription('');

            $excel->sheet('sheet1', function($sheet) use ($arrayToExport) {
                $sheet->fromArray($arrayToExport, null, "A1", false, false);
            });

        }); // xlsx

        return $excel->download('xlsx');
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
