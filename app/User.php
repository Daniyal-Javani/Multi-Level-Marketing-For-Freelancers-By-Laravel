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
        'name', 'email', 'password', 'root_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * One user has one admin
     */
    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    /**
     * One user has many invoices
     */
    public function invoice()
    {
        return $this->hasMany('App\Invoice');  //Many to one relationships
    }

    /**
     * One user has many commission
     */
    public function commission()
    {
        return $this->hasMany('App\Commission');  //Many to one relationships
    }
}
