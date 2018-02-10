<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;

class DataRowsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $userDataType = DataType::where('slug', 'users')->firstOrFail();
        $menuDataType = DataType::where('slug', 'menus')->firstOrFail();
        $roleDataType = DataType::where('slug', 'roles')->firstOrFail();
        $pharmacyDataType = DataType::where('slug', 'pharmacies')->firstOrFail();
        $ownerDataType = DataType::where('slug', "owners")->firstOrFail();
        $employeeDataType = DataType::where('slug', "employees")->firstOrFail();
        $dragDataType = DataType::where('slug', "all-drugs")->firstOrFail();
        $drugUnit = DataType::where('slug', 'drug-unit')->firstOrFail();
        $drugStrength = DataType::where('slug', 'drug-strength')->firstOrFail();
        $insuranceDataType = DataType::where('slug', 'insurances')->firstOrFail();
        /**
         * DataRowForPharmacy
         */

<<<<<<< HEAD
        $drugsPharmDataType = DataType::where('slug', 'drugs')->firstOrFail();
        $insurancePharmDataType = DataType::where('slug', 'pharmacy-insurances')->firstOrFail();
=======
        $drugsPharmDataType    = DataType::where('slug', 'drugs')->firstOrFail();
        $salesPharmDataType    = DataType::where('slug','sales')->firstOrFail();
        $customerPharmDataType = DataType::where('slug','customer')->firstOrFail();
>>>>>>> 44b525928d7d7ba25741861d30535884db46b659

        /**
         * DataRow for Owners Table
         */

        $dataRow = $this->dataRow($ownerDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($ownerDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($ownerDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'email',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  => "required|email|unique:owners,email"
                    ]
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($ownerDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'password',
                'display_name' => 'password',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        /**
         * DataRow for Pharmacies Table
         */

        $dataRow = $this->dataRow($pharmacyDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Pharmacy Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required'
                    ],
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, "user_id");
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Pharmacy Owner',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required'
                    ],
                ]),
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, 'logo');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Logo',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required'
                    ],
                ]),
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, 'watermark');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'Watermark',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, "location");
        if (!$dataRow->exists){
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Pharmacy Location',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required'
                    ],
                ]),
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($pharmacyDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        /**
         * DataRow for Users Table
         */

        $dataRow = $this->dataRow($userDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required'
                    ],
                ]),
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'email',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required|email|unique:users,email'
                    ],
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'password',
                'display_name' => 'password',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'remember_token');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'remember_token',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($userDataType, 'avatar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'avatar',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

        /**
         * DataRow for Menus Table
         */

        $dataRow = $this->dataRow($menuDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($menuDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        /**
         * DataRow for Roles Table
         */

        $dataRow = $this->dataRow($roleDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($roleDataType, 'display_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Display Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }



        $dataRow = $this->dataRow($userDataType, 'role_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'role_id',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 9,
            ])->save();
        }

        /**
         * DataRow for Employees Table
         */

        $dataRow = $this->dataRow($employeeDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'pharmacy_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Pharmacy',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => json_encode([
                    'relationship' => [
                        'key'   => 'id',
                        'label' => 'name',
                    ],
                    'validation'    =>  [
                        'rule'  =>  'required'
                    ],
                ]),
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Employee\'s Names',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required|string'
                    ],
                ]),
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'email');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Employee\'s Email',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required|email|unique:employees,email'
                    ],
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'password');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'password',
                'display_name' => 'password',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 0,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  'required|min:8',
                        'message'   =>  'The password must be over 8 characters'
                    ],
                ]),
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'remember_token');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'remember_token',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($employeeDataType, 'avatar');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => 'avatar',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }
        /**
         *  DataRows for Drugs DataType
         */

        $dataRow = $this->dataRow($dragDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($dragDataType, 'full_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Full Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  "required|unique:drugs,full_name"
                    ]
                ]),
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($dragDataType, 'short_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Short Name',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  "min:2|max:7|unique:drugs,short_name"
                    ]
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($dragDataType, 'details');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Details',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($dragDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($dragDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        /**
         *  DataRows for Drug Units DataType
         */

        $dataRow = $this->dataRow($drugUnit, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($drugUnit, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Unit Label',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'      =>  'required|unique:drug_units,name',
                        'message'   =>  'Drug Unit Label is needed'
                    ]
                ]),
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($drugUnit, 'comment');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Comment',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'      =>  'min:5'
                    ]
                ]),
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($drugUnit, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($drugUnit, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        /**
         *  DataRows for Drug Strength DataType
         */

        $dataRow = $this->dataRow($drugStrength, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($drugStrength, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Strength Label',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'      =>  'required|unique:drug_strengths,name',
                        'message'   =>  'Drug Strength Label is needed'
                    ]
                ]),
                'order'        => 1,
            ])->save();
        }
        $dataRow = $this->dataRow($drugStrength, 'comment');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Comment',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'      =>  'min:5'
                    ]
                ]),
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($drugStrength, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($drugStrength, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        /**
         *  DataRows for Insurances DataType
         */

        $dataRow = $this->dataRow($insuranceDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($insuranceDataType, 'full_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Full Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  "required|unique:insurances,full_name"
                    ]
                ]),
                'order'        => 2,
            ])->save();
        }
        $dataRow = $this->dataRow($insuranceDataType, 'short_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Short Name',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'  =>  "min:2|max:7|unique:insurances,short_name"
                    ]
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($insuranceDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Descriptions',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => '',
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($insuranceDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'created_at',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($insuranceDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 6,
            ])->save();
        }

        /**
         * DrugsPharm DataRows
         */

        $dataRow = $this->dataRow($drugsPharmDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'pharmacy_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Pharmacy',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'drug_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Drug Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required',
                        'message'   =>  'Drug name is required.'
                    ],
                    "relationship"  =>  [
                        "key"   => "id",
                        "label" => "full_name"
                    ]
                ]),
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'unit_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Drug Unit',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required',
                        'message'   =>  'Drug unit is required.'
                    ],
                    "relationship"  =>  [
                        "key"   => "id",
                        "label" => "name"
                    ]
                ]),
                'order'        => 4,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'strength_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Drug Strength',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required',
                        'message'   =>  'Drug strength is required.'
                    ],
                    "relationship"  =>  [
                        "key"   => "id",
                        "label" => "name"
                    ]
                ]),
                'order'        => 5,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'batch_number');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Drug Batch Number',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required',
                        'message'   =>  'Drug batch number is required.'
                    ]
                ]),
                'order'        => 6,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'manufactured_date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Manufactured Date',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required|date|before:tomorrow'
                    ]
                ]),
                'order'        => 7,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'import_date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Imported Date',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required|date|after:manufactured_date'
                    ]
                ]),
                'order'        => 8,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'expiring_date');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Expiring Date',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation' => [
                        'rule'      =>  'required|date|after:import_date'
                    ]
                ]),
                'order'        => 9,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'comment');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Description',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => json_encode([
                    'validation'    =>  [
                        'rule'      =>  'min:5'
                    ]
                ]),
                'order'        => 10,
            ])->save();
        }
        $dataRow = $this->dataRow($drugsPharmDataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Entry Date',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 20,
            ])->save();
        }

        $dataRow = $this->dataRow($drugsPharmDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 21,
            ])->save();
        }
    

        /**
         * Sales Datarows
         */

         $dataRow = $this->dataRow($salesPharmDataType, 'id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'id',
                 'required'     => 1,
                 'browse'       => 0,
                 'read'         => 0,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 0,
                 'details'      => '',
                 'order'        => 1,
             ])->save();
         }
 
         $dataRow = $this->dataRow($salesPharmDataType, 'drug_id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'select_dropdown',
                 'display_name' => 'Drug Name',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => json_encode([
                     'validation' => [
                         'rule'      =>  'required',
                         'message'   =>  'Drug name is required.'
                     ],
                     "relationship"  =>  [
                         "key"   => "id",
                         "label" => "full_name"
                     ]
                 ]),
                 'order'        => 2,
             ])->save();
         }
 
         $dataRow = $this->dataRow($salesPharmDataType, 'customer_id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'select_dropdown',
                 'display_name' => 'Customer Name',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => json_encode([
                     "relationship"  =>  [
                         "key"   => "id",
                         "label" => "names"
                     ]
                 ]),
                 'order'        => 3,
             ])->save();
         }
 
         $dataRow = $this->dataRow($salesPharmDataType, 'unitprice');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'unit Price',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => json_encode([
                     'validation' => [
                         'rule'      =>  'required|numeric|min:1',
                         'message'   =>  'Unit Price is required.'
                     ]
                 ]),
                 'order'        => 4,
             ])->save();
         }
 
         $dataRow = $this->dataRow($salesPharmDataType, 'quantity');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'Quantity',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => json_encode([
                     'validation' => [
                         'rule'      =>  'required|numeric|min:1',
                         'message'   =>  'Quantity is required.'
                     ]
                 ]),
                 'order'        => 5,
             ])->save();
         }
 
         $dataRow = $this->dataRow($salesPharmDataType, 'total');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'Total',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 6,
             ])->save();
         }
 
         $dataRow = $this->dataRow($salesPharmDataType, 'created_at');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'timestamp',
                 'display_name' => 'Sold Date',
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 0,
                 'details'      => '',
                 'order'        => 7,
             ])->save();
         }
 
        $dataRow = $this->dataRow($salesPharmDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }


        /**
         * Customer Datarows
         */

         $dataRow = $this->dataRow($customerPharmDataType, 'id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'id',
                 'required'     => 1,
                 'browse'       => 0,
                 'read'         => 0,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 0,
                 'details'      => '',
                 'order'        => 1,
             ])->save();
         }
 
         $dataRow = $this->dataRow($customerPharmDataType, 'names');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => 'Names',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 2,
             ])->save();
         }
 
         $dataRow = $this->dataRow($customerPharmDataType, 'sex');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'select_dropdown',
                 'display_name' => 'Sex',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => json_encode([
                     "options"  =>  [
                         "male"   => "male",
                         "female" => "female"
                     ]
                 ]),
                 'order'    => 3,
             ])->save();
         }
 
         $dataRow = $this->dataRow($customerPharmDataType, 'address');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => 'unit Price',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 4,
             ])->save();
         }
 
         $dataRow = $this->dataRow($customerPharmDataType, 'phone');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => 'Phone Number',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 5,
             ])->save();
         }
 
         $dataRow = $this->dataRow($customerPharmDataType, 'dob');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'date',
                 'display_name' => 'Date of Birth',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details' => json_encode(['format' =>'d-m-Y']),
                 'order'        => 6,
             ])->save();
         }
 
         $dataRow = $this->dataRow($customerPharmDataType, 'weight');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'Weight',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details' => json_encode(['format' =>'d-m-Y']),
                 'order'        => 6,
             ])->save();
         }

         $dataRow = $this->dataRow($customerPharmDataType, 'illness');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'number',
                 'display_name' => 'Weight',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details' => json_encode(['format' =>'d-m-Y']),
                 'order'        => 6,
             ])->save();
         }


         $dataRow = $this->dataRow($customerPharmDataType, 'nameofprincipal');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => 'Name of Principal',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 6,
             ])->save();
         }


         $dataRow = $this->dataRow($customerPharmDataType, 'cardnumber');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => 'Affiliate Number',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 6,
             ])->save();
         }


         $dataRow = $this->dataRow($customerPharmDataType, 'medicalcenter');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'text',
                 'display_name' => 'Medical Center',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'order'        => 6,
             ])->save();
         }

         $dataRow = $this->dataRow($salesPharmDataType, 'insurance_id');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'select_dropdown',
                 'display_name' => 'Insurance Name',
                 'required'     => 1,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 1,
                 'add'          => 1,
                 'delete'       => 1,
                 'details'      => json_encode([
                     "relationship"  =>  [
                         "key"   => "id",
                         "label" => "full_name"
                     ]
                 ]),
                 'order'        => 3,
             ])->save();
         } 
         
         $dataRow = $this->dataRow($customerPharmDataType, 'created_at');
         if (!$dataRow->exists) {
             $dataRow->fill([
                 'type'         => 'timestamp',
                 'display_name' => 'Sold Date',
                 'required'     => 0,
                 'browse'       => 1,
                 'read'         => 1,
                 'edit'         => 0,
                 'add'          => 0,
                 'delete'       => 0,
                 'details'      => '',
                 'order'        => 7,
             ])->save();
         }
 
        $dataRow = $this->dataRow($customerPharmDataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'updated_at',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'details'      => '',
                'order'        => 8,
            ])->save();
        }

    }

    
    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }
}
