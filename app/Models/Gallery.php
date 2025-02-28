<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable =
        [
            'name',
            'title',
            'description',
            'abstract',
            'text',
            'keywords',
            'header_image',
            'thumbnail',
            'icon',
            'order',
            'status',
        ];

    public function GalleryItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GalleryItems::class);
    }

    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Page::class);
    }
}
