<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameters';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function parameter_details() {
      return $this->hasMany("App\Parameter_detail");
    }
}
