<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['code', 'name', 'detail', 'picture','price','quantity','active','category_id','provider_id','view'];

    public $timestamps = true;

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function parameter_details(){
      return $this->hasMany('App\Parameter_detail');
    }

    public function Comment(){
      return $this->hasMany('App\Comment');
    }

    public function Promotion_product() {
      return $this->belongsTo('App\promo_products');
    }
}
