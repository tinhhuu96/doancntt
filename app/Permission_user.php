<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_user extends Model
{
    protected $table = 'permission_user';
    protected $fillable = ['user_id','permission_id'];
    public $timestamps = true;
}
