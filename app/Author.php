<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    
    public function addons()
    {
        return $this->hasMany('App\Addon');
    }

    public function linkedUser()
    {
        return $this->belongsTo('App\User');
    }
}
