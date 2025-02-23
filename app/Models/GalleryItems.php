<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItems extends Model
{
    protected $fillable =
        [
            'title',
            'description',
            'gallery_id',
            'src',
            'alt',
            'link',
            'status',
        ];
    public function gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }




}
