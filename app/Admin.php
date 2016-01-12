<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function user() //to note
    {
        return $this->belongsTo('App\User');
    }
}
