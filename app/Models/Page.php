<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable =
        [
            'gallery_id',
            'title',
            'name',
            'abstract',
            'text',
            'description',
            'keywords',
            'source_link',
            'header_image',
            'thumbnail',
            'icon',
            'attached_file',
            'published_at',
            'order',
            'status'
        ];




        public function menu(): \Illuminate\Database\Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(Menu::class);
        }

        public function gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(Gallery::class);
        }

}
