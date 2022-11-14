<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'gwc_news_categories';
    protected $fillable = ['display_order', 'name_en', 'name_ar', 'slug'];

    // public function news()
    // {
    //     return $this->hasMany(Newsasdfaf::class, 'category_id');
    // }
}
