<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
    const ADMIN = 0;
    const UPT = 1;
    const PIMTI = 2;


    public function isAdmin()
    {
        return $this->role_id == User::ADMIN;
    }
        public function isUpt()
    {
        return $this->role_id == User::UPT;
    }
        public function isPimti()
    {
        return $this->role_id == User::PIMTI;
    }
}
