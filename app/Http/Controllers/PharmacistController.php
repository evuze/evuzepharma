<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Excel;
use App\Drug;
use App\PharmDrug;

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
        // $this->validate($request, [
        //     'file_import' => 'bail|required|mimes:xlsx',
        // ]);
        
        $headerKey = PharmDrug::headerExcelExportKey();
        $path = $request->file('file_import')->getRealPath();

        $data = Excel::load($path);
        $_data = $data;
        $data = $data->toArray();
        $cols = $_data->all()->first()->keys()->toArray();
        
        $modifiedKey = [];
        $toValidate = [];

        /**
         * All Data From the file with matching  database columns
         */
        $srow = 2; #remove 2 row and start counting row for data in file
        foreach($data as $key => $collaction){
            $item_ = [];
            foreach($collaction as $key => $value) {
                if( ! is_int($key) )
                    $item_[($headerKey[$key])] = (string) $value;
            }
            if( ! empty($item_) )
                $modifiedKey[$srow] = $item_;

            $srow += 1;
        }

        /**
         * Validation items
         */
        // if( count($modifiedKey) > 0 ){            
        //     foreach($modifiedKey as $on => $rows){
        //         $item_ = [];
        //         foreach($rows as $key => $value) {
        //             foreach(PharmDrug::headerExcelExportValidate() as $item){
        //                 if( $item == $key )
        //                     $item_[$key] = $value;
        //             }                    
        //         }
        //         if( ! empty($item_) )
        //             $toValidate[$on] = $item_;
        //     }
        // }

        /**
         * Validating
         */

        //Get Validation Rules
        $rules = PharmDrug::getRules();
        $validation = $this->dataValidate($modifiedKey, $rules['rules'], $rules['messages']);
        
        if($validation != 0 ){
            return dd($validation);
        }
        
        return dd($modifiedKey);

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
        $arrayToExport[] = PharmDrug::headerExcelExport();        

        switch($request->input('options')){
            case 1:
                $drugs = Drug::all(['short_name', 'full_name']);
                if( $drugs != null ){
                    foreach ($drugs as $drug) {
                        $arrayToExport[] = [$drug->short_name, $drug->full_name];
                    }
                }       
                break;
            case 2:
                $drugs = getMyStoke();
                if( $drugs->count() > 0 ) {
                    foreach ($drugs as $drug)  {
                        $op = percentaging($drug->quantity, $drug->init_quantity);
                        if( $op <= 35 && $drug->init_quantity > 0 ){
                            $d = Drug::find($drug->drug_id);
                            if( $d != null ){
                                $arrayToExport[] = [$d->short_name, $d->full_name];
                            }
                        }
                    }
                }
                break;
            case 3:
                $medecines = $request->input('medecine');
                $drugs = Drug::whereIn('id', $medecines)->get(['short_name', 'full_name']);
                
                if( $drugs != null ){
                    foreach ($drugs as $drug) {
                        $arrayToExport[] = [$drug->short_name, $drug->full_name];
                    }
                }                
                break;
            case 4:
                
                break;
        };

        if( count($arrayToExport) > 1 )
            $this->download($arrayToExport);

        return redirect()->route("export.format.drugs");
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

    protected function dataValidate($elements, $rules, $messages)
    {
        $fail = 0;
        $errors = null;
        $onRow = null;
        foreach ($elements as $row => $element) {

            $validate = \Validator::make($element, $rules, $messages);

            if( $validate->fails() ){
                $onRow[] = $row;
                $errors[] = $validate->errors()->first();
                $fail += 1;
            }
        }

        if ( $fail == 0 ){
            return 0;
        }else{
            return ['rows' => $onRow, 'errors' => $errors];
        }
    }


}
