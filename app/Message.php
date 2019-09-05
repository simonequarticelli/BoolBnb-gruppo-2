<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // relazione uno a molti houses/messages
    public function house() {
        return $this->belongsTo('App\House');
    }
}
