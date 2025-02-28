<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItems extends Model
{
    protected $fillable =
        [
            'gallery_id',
            'title',
            'description',
            'src',
            'alt',
            'link',
            'order',
            'status',

        ];
    public function gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }




}
