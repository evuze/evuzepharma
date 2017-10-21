<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugUnit extends Model
{
    protected $fillable = [
        'name', 'comment'
    ];
}
