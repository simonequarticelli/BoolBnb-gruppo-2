<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // relazione uno a molti payments/promotions
    public function promotion() {
        return $this->belongsTo('App\Promotion');
    }

    // relazione molti a molti houses/payments
    public function houses() {
        return $this->belongsToMany('App\House');
    }

    protected $fillable = ['status'];
}
