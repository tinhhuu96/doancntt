<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','parent'];
    public $timestamps = true;

    public function Product(){
  		return $this->hasMany('App\Product');
    }
    public function Paracatedetail(){
  		return $this->hasMany('App\Paracatedetail');
    }
}
