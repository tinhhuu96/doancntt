<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    protected $fillable = ['name','value_km','date_begin','date_end','active','calculation_id'];
    public $timestamps = true;
    
    public function Promotion_product() {
      return $this->hasMany("App\Promotion_product");
    }
}
