<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        /*
         *  Adding Permission to Admin Role
         */
        $role = Role::where('name', 'admin')->firstOrFail();
        $permissions = Permission::all();

        /*
         * Exincluding Some Table for Admin
         */
        $except = Permission::where('table_name', 'pharmacies')
                            ->orWhere('table_name', 'employees');
        $exceptArr = [];
        if( $except->count() > 0 ) {
            foreach ($except->get() as $element) {
                $exceptArr[] = $element->id;
            }
        }
        if( count($exceptArr) > 0 )
            $permissions = Permission::all()->except($exceptArr);

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

        /*
         *  Adding All Permission Regarding to Pharmacies Table on Owner Role
         */

        $role = Role::where('name', 'owner')->firstOrFail();

        $permissions = Permission::where('table_name', 'pharmacies')
                                    ->orWhere('table_name', 'employees')
                                    ->orWhere('key', 'browse_admin')
                                    ->orWhere('key', 'edit_users');

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

    }
}
