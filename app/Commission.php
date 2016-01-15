<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{

	/**
     * One commission has one user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * One commission has one invoice
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');  //Many to one relationships
    }
}
