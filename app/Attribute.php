<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'gwc_attributes';
    protected $fillable = ['display_order', 'title_en', 'title_ar', 'description_en', 'description_ar', 'is_active'];
}
