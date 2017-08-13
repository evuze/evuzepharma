<?php

namespace App\Http\Controllers\Activities;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Voyager;

class ImportsController extends Controller
{
    function __construct()
    {
        $this->middleware('admin.user');
    }

    public function getImportView($item)
    {
        $datatype = DataType::where('slug', $item);
        if ($datatype->count() > 0){
            $dataType = $datatype->first();

            return view('vendor.voyager.import', compact("dataType"));
        }

        return abort(404);
    }

    public function importFileIntoDB(Request $request){
        $dataType = DataType::where('slug', $request->input('dataType'));

        $validate = $this->validate($request, [
            'file_to_import'  =>  'required|mimes:csv,txt'
        ],[
            'The file must be a file of type csv'
        ]);

        if($request->hasFile('file_to_import') && $dataType->count() > 0 ) {
            $dataType = $dataType->first();
            $dataRow = DataRow::where('data_type_id', $dataType->id);

            $dataRowField = null;
            $requiredFields = [];
            $details = [];
            $messages = [];

            if( $dataRow->count() > 0 ) {
                foreach ($dataRow->get() as $row) {
                    if($row->add == '1') {
                        $dataRowField[] = $row->field;
                        if( $row->required == '1' )
                            $requiredFields[] = $row->field;
                        if ($row->details){
                            $decoded = json_decode($row->details, true);
                            if( isset( $decoded['validation'] ) ){
                                $details[$row->field] = $decoded['validation']['rule'];
                                if( isset( $decoded['validation']['message'] ) )
                                    $messages[$row->field] = $decoded['validation']['message'];
                            }
                        }
                    }
                }
            }

            if ( $validate == null ) {
                $path = $request->file('file_to_import')->getRealPath();
                $data = \Excel::load($path);
                $_data = $data;
                $data = $data->get();
                $cols = $_data->all()->first()->keys()->toArray();

                $checkingCols = $this->checkIfColumnsAreTheSome($requiredFields, $cols);

                if ( $data->count() && ! is_null($dataRowField) && $checkingCols['status'] ) {

                    foreach ($data as $key => $value){
                        $cx = 1;
                        foreach ($dataRowField as $field) {
                            $d1[$field] = strlen(trim($value->{$field})) > 0 ? trim($value->{$field}) : null;

                            if( $cx == count($dataRowField) )
                                $arr[] = $d1;

                            $cx++;
                        }

                    }
                    if (!empty($arr)) {
                        $n = app($dataType->model_name);
                        $arr = $this->elementToStore($arr, $n);
                        if ( is_null($arr) )
                            session()->put('error', 'No thing to import !');
                        else{
                            $ac = $this->dataValidate($request, $arr, $details, $messages);
                            $insertErrors = "";
                            if( $ac == 0 ) {
                                foreach ($arr as $key => $element) {
                                    $o = $this->dataValidate($request, [ $key => $element ], $details, $messages);
                                    if( $o == 0 )
                                        $n::create($element);
                                    else
                                        $insertErrors .= "You have duplicate on row : " . ($key+1) . "<br/>";

                                }

                                if( $insertErrors != "" )
                                    session()->put('error', $insertErrors);

                                session()->put('success', "File Imported Successfully.");

                            }else{
                                session()->put('error', $ac['error']."<br/>On row: ".$ac['row']);
                            }
                        }
                    }
                    else
                        return redirect(route('import', $request->input('dataType')))->withErrors(['It seems there are no data available']);
                }
                else{
                    $n = ( $checkingCols['status'] == false )? count($checkingCols['needed']) > 0 ? implode(", ", $checkingCols['needed']) : "" : "";
                    $error = 'It seems there are no data available or columns aren\'t matching.';
                    if( $n != ""  )
                        $error = "Make sure these are included in your columns title: <b><i>" . $n ."</i></b>";

                    session()->put('error', $error);
                }
            }
            else{
                return redirect(route('import', $request->input('dataType')))->withErrors($validate->errors->all());
            }
        }

        return redirect(route('import', $request->input('dataType')));
    }

    protected function dataValidate($request, $arr, $details, $messages)
    {
        $bp = 0;
        $errors = null;
        $onR = null;
        foreach ($arr as $row => $element) {

            $validate = \Validator::make($element, $details, $messages);

            if( $validate->fails() ){
                $onR[] = $row+1;
                $errors[] = $validate->errors()->all();
                $bp += 2;
            }
        }

        if ( $bp == 0 ){
            return 0;
        }else{


            return ['row' => $onR[0], 'error' => $errors[0][0]];
        }
    }

    protected function elementToStore($arr, $model)
    {
        $elements = null;
        foreach ($arr as $key => $ele){
            $cele = count($ele);
            $ex = 0;
            foreach ( $ele as $k => $v ) {
                $m = $model::where($k, $v);
                if( $m->count() > 0 )
                    $ex += 1;
            }
            if( $cele != $ex  )
                $elements[$key] = $arr[$key];
        }

        return $elements;
    }

    protected function checkIfColumnsAreTheSome($requiredColumns, $givenColumns)
    {
        if( count($requiredColumns) > 0 && count($givenColumns) > 0 ) {
            $cr = count($requiredColumns);
            $ck = 0;
            $needed = [];
            foreach ($requiredColumns as $v) {
                $pl = 1;
                foreach ($givenColumns as $b) {
                    if( strtolower($v) == strtolower($b) )
                        $ck += 1;

                    if( count($givenColumns) == $pl )
                        $needed[] = $v;

                    $pl += 1;
                }
            }

            if( $cr == $ck )
                return [ 'status' => true ];

        }

        return [ 'status' => false, 'needed' => $needed ];
    }
}
