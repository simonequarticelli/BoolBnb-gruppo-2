<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{   
    // relazione molti a molti houses/features
    public function houses() {
        return $this->belongsToMany('App\House');
    }
}
