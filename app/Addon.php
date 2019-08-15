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

    public function getRealAuthorName() {
        return $this->author->getLinkedUser()->name ?? $this->author->name;
    }
}
