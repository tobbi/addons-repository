<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonRevision extends Model
{
    protected $table = "addon_revisions";

    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }
}
