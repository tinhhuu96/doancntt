<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'address', 'phone', 'name', 'email','user_id'];
    public $timestamps = true;

    public function OrderDetails(){
  		return $this->hasMany('App\OrderDetail');
    }

    public function scopeStatus($query, $value)
    {
      if($value == 'all')
      {
        return;
      }
        return $query->where('status', $value);
    }

    public function scopeDateFrom($query, $value)
    {
      if (empty($value)) {
        return;
      }
      return $query->where('created_at', '>', $value);
    }

    public function scopeDateTo($query, $value)
    {
      if (empty($value)) {
        return;
      }
      return $query->where('created_at', '<', $value);
    }
}

