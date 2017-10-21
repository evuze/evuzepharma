<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Models\User as VoyagerUserModel;

class User extends VoyagerUserModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Pharmacy that user belongs to
     */

    public function pharmacies()
    {
        return $this->hasMany(Pharmacy::class);
    }
}
