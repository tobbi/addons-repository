<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonType extends Model
{
    protected $table = 'addontype';

    public function addons()
    {
        return $this->hasMany('App\Addon');
    }
}
