<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $fillable = ['name','content','date_begin','date_end','active','calculation_id'];
    public $timestamps = true;
}
