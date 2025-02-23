<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable =
        [
            'menu_id',
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


        public function menus(): \Illuminate\Database\Eloquent\Relations\HasMany
        {
            return $this->hasMany(Menu::class);
        }

}
