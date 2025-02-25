<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'page_id',
        'parent_id',
        'title',
        'description',
        'text',
        'full_text',
        'keywords',
        'thumbnail',
        'icon',
        'header_image',
        'order',
        'status'
    ];


    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function childrenRecursive()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('childrenRecursive');
    }

}
