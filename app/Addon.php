<?php

namespace App;

use App\Author;
use App\AddonRevision;
use App\AddonType;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function addonType()
    {
        return $this->belongsTo(AddonType::class, "type", "id");
    }

    public function revisions()
    {
        return $this->hasMany(AddonRevision::class);
    }

    public function getRealAuthorName()
    {
        return $this->author->getLinkedUser()->name ?? $this->author->name;
    }
}
