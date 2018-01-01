<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];
    public $timestamps = true;

    public function users(){
  		return $this->hasMany('App\User');
    }
}
