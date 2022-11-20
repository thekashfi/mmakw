<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public $table = "gwc_careers";
    protected $fillable = ['category_id', 'slug', 'title_en', 'title_ar', 'description_en', 'description_ar', 'image', 'is_active', 'display_order'];

    public function resumes()
    {
        return $this->hasMany(Resume::class, 'career_id');
    }

    public function category()
    {
        return $this->belongsTo(CareerCategory::class, 'category_id');
    }
}
