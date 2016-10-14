<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'role_id', 'is_active', 'name', 'email', 'password', 'photo_id'
    ];

//    protected $placeholder = "/images/placeholder.jpg";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role ()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo ()
    {
        return $this->belongsTo('App\Photo');
    }

    public function isAdmin ()
    {
        if($this->role->name == 'Administrator' && $this->is_active == 1) {
            return true;
        }
        return false;
    }

    public function posts ()
    {
        return $this->hasMany('App\Post');
    }

//    public function getPhoto_idAttribute ($photo)
//    {
//        if ($photo == "") {
//            return $this->placeholder;
//        }
//    }
}
