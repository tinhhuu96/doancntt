<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['product_id','user_id','contents'];
    public $timestamps = true;
    
}
