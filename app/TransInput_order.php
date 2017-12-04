<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransInput_order extends Model
{
    protected $table = 'traninput_order';
    protected $fillable = ['id_product', 'quantity','price','total'];
    public $timestamps = true;
}
