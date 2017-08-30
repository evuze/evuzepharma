<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['names','sex','address','phone','insurance_id'];
}
