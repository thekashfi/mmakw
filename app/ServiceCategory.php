<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'gwc_service_categories';
    protected $fillable = ['display_order', 'name_en', 'name_ar'];

    public function services()
    {
        return $this->hasMany(Services::class, 'category_id');
    }
}
