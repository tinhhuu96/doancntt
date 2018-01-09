<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
	protected $table = 'calculation';
    protected $fillable = ['name'];
    public $timestamps = true;
}
