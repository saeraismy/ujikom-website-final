<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'gallery_id',
        'file',
        'judul'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
