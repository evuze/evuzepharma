<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BaseModel extends Model
{
    /**
     * Override find method
     * @override find()
     */

    public function find()
    {

    }

    /**
     * Override all method
     * @override all()
     */

    public static function all($columns = ['*'])
    {
        $get = parent::all($columns);
        if ( Auth::user()->hasRole('owner') ) {
            $get = self::where('user_id', Auth::user()->id)->get();
        }
        return $get;
    }

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array  $columns
     * @return \Illuminate\Support\Collection
     */
    public function get($columns = ['*'])
    {
        $get = parent::get();

        if( Auth::user()->hasRole('owner') ) {
            $get = self::where('user_id', Auth::user()->id)->get();
        }

        return $get;
    }

}
