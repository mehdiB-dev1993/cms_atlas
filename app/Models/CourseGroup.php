<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseGroup extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'status',
        'parent_id',
    ];

    public function childrenRecursive()
    {
        return $this->hasMany(CourseGroup::class, 'parent_id')->with('childrenRecursive');
    }



  public function courses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
  {
    return $this->belongsToMany(Course::class);
  }
}
