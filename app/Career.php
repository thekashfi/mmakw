<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public $table = "gwc_careers";
    protected $fillable = ['category_id', 'slug', 'title_en', 'title_ar', 'description_en', 'description_ar', 'image', 'is_active', 'display_order'];

    // public function category()
    // {
    //     return $this->belongsTo(NewsCategory::class, 'category_id');
    // }
    //
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class, 'news_id');
    // }
}
