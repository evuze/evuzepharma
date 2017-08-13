<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugStrength extends Model
{
    protected $fillable = [
        'name', 'comment'
    ];
}
