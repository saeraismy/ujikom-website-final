<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'post_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
