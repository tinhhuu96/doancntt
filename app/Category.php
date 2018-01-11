<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','parent'];
    public $timestamps = true;

    public function products(){
  		return $this->hasMany('App\roduct');
    }
    public function Paracatedetail(){
  		return $this->hasMany('App\Paracatedetail');
    }
}
