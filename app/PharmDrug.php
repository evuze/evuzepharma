<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class PharmDrug extends Model
{
    use Uuid;
    use SoftDeletes;

    private static $headerExcelExport = [
        'drug_code' =>  'Drug Code', 
        'drug_name' =>  'Drug Name',
        'drug_batch_number' =>  'Drug Batch Number', 
        'manufactured_date' =>  'Manufactured Date',
        'imported_date' =>  'Imported Date', 
        'expiring_date' =>  'Expiring Date',
        'quantity' =>  'Quantity',
        'price' =>  'Price',
        'supplier' =>  'Supplier',
        'comment' =>  'Comment'
    ];

    private static $headerExcelExportKey = [
        'drug_code' =>  'short_name', 
        'drug_name' =>  'full_name',
        'drug_batch_number' =>  'batch_number',
        'manufactured_date' =>  'manufactured_date',
        'imported_date' =>  'import_date',
        'expiring_date' =>  'expiring_date',
        'quantity' =>  'init_quantity',
        'price' =>  'price',
        'supplier' =>  'supplier',
        'comment' =>  'comment'        
    ];

    private static $headerExcelExportValidate = [
        'batch_number','manufactured_date', 'import_date', 
        'expiring_date','init_quantity', 'supplier',
        'comment'
    ];

    public function save(array $options = [])
    {
        if ( Auth::guard('pharmacy')->check() ){
            // Forcing owner id to Pharmacy
            $this->pharmacy_id = Auth::guard('pharmacy')->user()->pharmacy_id;
        }

        parent::save();
    }


    /**
     * Voyager Relationship logic
     */
    public function drugId()
    {
        return $this->belongsTo(Drug::class);
    }

    public function unitId()
    {
        return $this->belongsTo(DrugUnit::class);
    }

    public function strengthId()
    {
        return $this->belongsTo(DrugStrength::class);
    }

    /**
     * Relationship for normal eloquent logic
     */

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    public function unit()
    {
        return $this->belongsTo(DrugUnit::class);
    }

    public function strength()
    {
        return $this->belongsTo(DrugStrength::class);
    }

    public static function headerExcelExport()
    {
        return self::$headerExcelExport;
    }

    public static function headerExcelExportKey()
    {
        return self::$headerExcelExportKey;
    }

    public static function headerExcelExportValidate()
    {
        return self::$headerExcelExportValidate;
    }

    public static function getRules()
    {
        $rules = [];
        $messages = [];

        $dataType = DataType::where('slug', 'drugs');
        if( $dataType->count() > 0 ) {
            $dataType = $dataType->first();
            $dataRow = DataRow::where('data_type_id', $dataType->id);
            if($dataRow->count() > 0) {
                $dataRow = $dataRow->get();
                foreach($dataRow as $row){
                    foreach(self::headerExcelExportValidate() as $field){
                        if( $row->field == $field && $row->details ){
                            $decoded = json_decode($row->details, true);
                            if( isset( $decoded['validation'] ) ){
                                $rules[$row->field] = $decoded['validation']['rule'];
                                if( isset( $decoded['validation']['message'] ) )
                                    $messages[$row->field] = $decoded['validation']['message'];
                            }
                        }
                    }
                }
            }
        }

        return ['rules' => $rules, 'messages' => $messages ];
    }

}
