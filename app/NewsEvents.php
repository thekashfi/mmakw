<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsEvents extends Model
{
    public $table = "gwc_newsevents";

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_id');
    }
}
