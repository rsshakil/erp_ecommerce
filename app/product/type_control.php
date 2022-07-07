<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class type_control extends Model
{
    //
    function users() {
        return $this->belongsTo('App\User');
    }
}
