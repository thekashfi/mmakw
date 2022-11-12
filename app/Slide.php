<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'gwc_slides';
    protected $fillable = ['title_en', 'title_ar', 'sub_title_en', 'sub_title_ar', 'image', 'video', 'display_order', 'link', 'link_title'];
}
