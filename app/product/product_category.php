<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    //
    function users() {
        return $this->belongsTo('App\User');
    }
}
