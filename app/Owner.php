<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role;

class Owner extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function save(array $options = [])
    {
        $role = Role::where('name', 'owner')->first();

        if( User::where('email', $this->email)->count() <= 0 ) {

            User::create([
                'name'      =>  $this->name,
                'email'     =>  $this->email,
                'password'  =>  $this->password,
                'role_id'   =>  $role->id
            ]);
        }

        parent::save();
    }

    public function delete()
    {
        $user = User::where('email', $this->email);
        if($user->first())
            $user->first()->delete();

        return parent::delete();
    }


//    public function pharmacies()
//    {
//        return $this->hasMany(Pharmacy::class);
//    }

}
