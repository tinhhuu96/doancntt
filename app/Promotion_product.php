<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion_product extends Model
{
    protected $table = 'promo_products';
    protected $fillable = ['product_id','promotion_id'];
    public $timestamps = true;

    public function Promotion() {
      return $this->belongsTo('App\Promotion');
    }
    public function Product() {
      return $this->belongsTo('App\Product');
    }
}
