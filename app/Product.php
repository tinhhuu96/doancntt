<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function parameter_details(){
      return $this->hasMany('App\Parameter_detail');
    }
}
