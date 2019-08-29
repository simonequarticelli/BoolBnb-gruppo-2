<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{   
    // relazione uno a molto houses/users
    public function user() {
        // belongTo -> APPARTIENE A
        return $this->belongsTo('App\User');
      }
}
