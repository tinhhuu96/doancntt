<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_user extends Model
{
    protected $table = 'permission_user';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
