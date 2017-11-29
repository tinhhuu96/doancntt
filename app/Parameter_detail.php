<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter_detail extends Model
{
    protected $table = 'parameter_detail';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function product() {
      return $this->belongsTo('App\Product');
    }

    public function parameter() {
      return $this->belongsTo('App\Parameter');
    }
}
