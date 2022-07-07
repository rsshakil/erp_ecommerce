<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class branch_control extends Model
{
    //
    function users() {
        return $this->belongsTo('App\User');
    }
}
