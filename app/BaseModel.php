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

    public static function all($columns = [])
    {

    }
}
