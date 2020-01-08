<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser', 'username', 'pword', 'vloga', 'random','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pword', 'random',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     *     protected $casts = [
    'email_verified_at' => 'datetime',
    ];
     */


    protected $table = 'UPORABNIK';
    public $timestamps = false;
}
