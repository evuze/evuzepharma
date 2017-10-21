<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = ['particulars','vch_type','vch_no','amount_dbt','amount_cdt'];
}
