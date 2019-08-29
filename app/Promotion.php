<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    // relazione molti a molti houses/promotions
    public function houses() {
        return $this->belongsToMany('App\House');
    }
}
