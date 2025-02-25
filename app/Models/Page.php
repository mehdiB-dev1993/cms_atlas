<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable =
        [
            'gallery_id',
            'title',
            'title_in_menu',
            'text',
            'full_text',
            'description',
            'keywords',
            'source',
            'header_image',
            'thumbnail',
            'icon',
            'date',
            'order',
            'status '
        ];




        public function menu(): \Illuminate\Database\Eloquent\Relations\HasMany
        {
            return $this->hasMany(Menu::class,'page_id');
        }

        public function gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
        {
            return $this->belongsTo(Gallery::class);
        }

}
