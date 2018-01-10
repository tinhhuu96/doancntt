<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter_detail extends Model
{
    protected $table = 'parameter_details';
    protected $fillable = ['product_id','parameter_id','content'];
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function product() {
      return $this->belongsTo('App\Product');
    }

    public function parameter() {
      return $this->belongsTo('App\Parameter');
    }
}
