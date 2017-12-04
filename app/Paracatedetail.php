<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paracatedetail extends Model
{
    protected $table = 'paracatedetail';
    protected $fillable = ['parameter_id','category_id'];
    public $timestamps = true;
}
