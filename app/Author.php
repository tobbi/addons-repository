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

    public function getLinkedUser()
    {
        if(!$this->hasLinkedUser())
            return null;

        return User::where('id', $this->user_id)->first();
    }

    public function hasLinkedUser()
    {
        return $this->user_id != null;
    }
}
