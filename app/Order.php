<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'address', 'shipping_status', 'phone', 'name', 'email','user_id'];
    public $timestamps = true;

    public function OrderDetail(){
  		return $this->hasMany('App\OrderDetail');
    }
}

