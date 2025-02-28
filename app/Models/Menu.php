<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'parent_id',
        'admin_id',
        'title',
        'description',
        'abstract',
        'text',
        'keywords',
        'thumbnail',
        'icon',
        'header_image',
        'order',
        'status'
    ];


    public function page(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Page::class,'menu_id');
    }

    public function childrenRecursive()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('childrenRecursive');
    }

}
