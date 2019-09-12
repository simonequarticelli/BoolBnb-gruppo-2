<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{   
    // relazione uno a molti houses/users
    public function user() {
        return $this->belongsTo('App\User');
    }

    // relazione molti a molti houses/features
    public function features() {
      return $this->belongsToMany('App\Feature');
    }

    // relazione molti a molti houses/promotions
    public function promotions() {
      return $this->belongsToMany('App\Promotion')->withTimestamps();
    }

    // relazione uno a molti houses/messages
    public function messages() {
      return $this->hasMany('App\Message');
    }

    protected $fillable = ['title', 'n_beds', 'n_wc', 'mq', 'address', 'longitude', 'latitude', 'slug'];
}
