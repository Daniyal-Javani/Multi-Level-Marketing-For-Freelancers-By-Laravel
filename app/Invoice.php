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
     * A invoice belongs to one user
     * @return [type] [description]
     */
	public function user()
    {
   		return $this->belongsTo('App\User');
    }
}
