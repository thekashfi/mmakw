<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'gwc_boxes';
    protected $fillable = ['display_order', 'title_en', 'title_ar', 'description_en', 'description_ar', 'link_title_en', 'link_title_ar', 'link', 'image', 'is_active', 'display_order'];
}
