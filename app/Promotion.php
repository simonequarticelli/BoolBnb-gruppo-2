<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    // relazione molti a molti houses/promotions
    public function houses() {
        return $this->belongsToMany('App\House');
    }

    // relazione uno a molti payments/promotions
    public function payments() {
        // hasMany -> HA MOLTI
        return $this->hasMany('App\Payment');
    }

    protected $fillable = ['name', 'price', 'duration'];
}
