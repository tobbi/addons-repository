<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function revisions()
    {
        return $this->hasMany('App\AddonRevision');
    }

    public function type()
    {
        return $this->belongsTo('App\AddonType');
    }

    public function getRealAuthorName() {
        return $this->author->getLinkedUser()->name ?? $this->author->name;
    }

    public function getType()
    {
        return $this->type;
    }
}
