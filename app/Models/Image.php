<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url', 'gallery_id'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
