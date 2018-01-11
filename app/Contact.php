<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name','email','content','view','star', 'reply'];
    public $timestamps = true;
}
