<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

class Employee extends AuthUser
{

    /**
     * Override all method
     * @override all()
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */

    public static function all($columns = [])
    {
        $resp = parent::all($columns);

        $user = Auth::check();
        if ( $user ){
            if( $user->hasRole('owner') ){
                $getP = Pharmacy::where('user_id', Auth::user()->id)->get();
                $get = [];
                if( $getP ){
                    foreach ($getP as $p) {
                        $get[] = $p->id;
                    }
                }

                $resp = self::whereIn('pharmacy_id', $getP);
            }
        }

        return $resp;
    }

    public function save(array $options = [])
    {
        // If no avatar has been set, set it to the default
        $this->avatar = $this->avatar ?: config('voyager.user.default_avatar', 'users/default.png');

        parent::save();
    }

    public function pharmacyId()
    {
        return $this->belongsTo(Pharmacy::class);
    }


}
