<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CareerCategory extends Model
{
    protected $table = 'gwc_career_categories';
    protected $fillable = ['display_order', 'name_en', 'name_ar', 'slug'];

    public function careers()
    {
        return $this->hasMany(Career::class, 'category_id');
    }
}
