<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permission';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function Permission_user(){
  		return $this->hasMany('App\Permission_user');
    }
}
