<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

	/**
	 * One admin belongs to one user
	 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
