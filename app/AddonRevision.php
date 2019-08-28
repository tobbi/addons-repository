<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AddonRevision extends Model
{
    protected $table = "addon_revisions";

    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id', 'id');
    }

    public function getDownloadUrl()
    {
        return url("/").Storage::url($this->file_path);
    }
}
