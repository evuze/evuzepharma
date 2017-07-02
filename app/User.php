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
        'name', 'email', 'password',
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

    public function pharmacyId()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
