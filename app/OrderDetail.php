<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	 protected $table = 'orders_detail';
    protected $fillable = ['quantity', 'price', 'order_id', 'product_id',];
    public $timestamps = true;
    public function Order(){
  		return $this->belongsTo('App\Order');
    }
}
