<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Insurance extends Model
{
 use SoftDeletes;
    protected $fillable = [
        'full_name', 'short_name',
    ];
    protected $dates = ['deleted_at'];
}
