<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait; 

class User extends Authenticatable
{
    use Notifiable;

    use EntrustUserTrait;

    
    protected $fillable = [
        'name', 'surname', 'date_of_birth', 'email', 'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relazione uno a molti houses/users
    public function houses() {
        return $this->hasMany('App\House');  
    }

    
}
