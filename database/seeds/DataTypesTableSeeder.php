<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'owners');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'owners',
                'display_name_singular' => 'Owner',
                'display_name_plural'   => 'Owners',
                'icon'                  => 'voyager-certificate',
                'model_name'            => 'App\\Owner',
//                'controller'            => '\\App\\Http\\Controllers\\OwnersController',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pharmacies');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pharmacies',
                'display_name_singular' => 'Pharmacy',
                'display_name_plural'   => 'Pharmacies',
                'icon'                  => 'voyager-droplet',
                'model_name'            => 'App\\Pharmacy',
//                'controller'            => '',
                'controller'            => '\\App\\Http\\Controllers\\PharmaciesController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'employees');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'employees',
                'display_name_singular' => 'Employee',
                'display_name_plural'   => 'Employees',
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\\Employee',
//                'controller'            => '',
                'controller'            => '\\App\\Http\\Controllers\\EmployeesController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }


        $dataType = $this->dataType('slug', 'drugs');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'drugs',
                'display_name_singular' => 'Drug',
                'display_name_plural'   => 'Drugs',
                'icon'                  => 'voyager-leaf',
                'model_name'            => 'App\\Drag',
                'controller'            => '',
//                'controller'            => '\\App\\Http\\Controllers\\DragsController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => 'User',
                'display_name_plural'   => 'Users',
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\\User',
                'controller'            => '',
//                'controller'            => '\\App\\Http\\Controllers\\UsersController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => 'Menu',
                'display_name_plural'   => 'Menus',
                'icon'                  => 'voyager-list',
                'model_name'            => 'TCG\\Voyager\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => 'Role',
                'display_name_plural'   => 'Roles',
                'icon'                  => 'voyager-lock',
                'model_name'            => 'TCG\\Voyager\\Models\\Role',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'drug-unit');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'drug_unit',
                'display_name_singular' => 'Drug Unit',
                'display_name_plural'   => 'Drug Units',
                'icon'                  => 'voyager-wand',
                'model_name'            => 'App\\DrugUnit',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'drug-strength');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'drug_strength',
                'display_name_singular' => 'Drug Strength',
                'display_name_plural'   => 'Drug Strengths',
                'icon'                  => 'voyager-barbell',
                'model_name'            => 'App\\DrugStrength',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'pharm-drugs');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'pharm_drug',
                'display_name_singular' => 'Pharmacy\'drug',
                'display_name_plural'   => 'Pharmacy\'drugs',
                'icon'                  => 'voyager-droplet',
                'model_name'            => '\\APP\\DrugStrength',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
