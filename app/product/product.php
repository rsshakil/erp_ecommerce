<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    function users() {
        return $this->belongsTo('App\User');
    }
}
