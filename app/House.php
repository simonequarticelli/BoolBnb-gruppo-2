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

    // relazione molti a molti houses/features
    public function features() {
      return $this->belongsToMany('App\Feature');
    }
}
