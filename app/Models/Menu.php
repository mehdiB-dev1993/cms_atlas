<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
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
}
