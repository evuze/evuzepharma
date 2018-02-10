<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kblais\Uuid\Uuid;

class Drug extends Model
{
    use Uuid;    
    use SoftDeletes;
    use Uuid;
    
    protected $fillable = [
        'full_name', 'short_name', 'details'
    ];
    protected $dates = ['deleted_at'];

    public function pharmdrug()
    {
        $this->hasMany(PharmDrug::class);
    }
}
