<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 
        'link', 
        'title', 
        'user_id', 
        'category_id',
        'description', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
