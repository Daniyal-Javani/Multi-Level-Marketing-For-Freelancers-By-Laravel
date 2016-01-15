<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'amount',
    ];

    /**
     * One invoice belongs to one user
     */
	public function user()
    {
   		return $this->belongsTo('App\User');
    }

    /**
     * One invoice has many commission
     */
    public function commission()
    {
        return $this->hasMany('App\Commission');  //Many to one relationships
    }
}
