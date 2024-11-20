<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'post_id',
        'posisi',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($gallery) {
            $gallery->images()->delete();
        });
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
