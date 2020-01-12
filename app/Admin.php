<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $guard = 'admin';
    
    protected $fillable = [
        'nama_admin','email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

  

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function gedung()
    {
        return $this->hasMany('App\Gedung');
    }
}
