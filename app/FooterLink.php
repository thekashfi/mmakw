<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    protected $table = 'gwc_footer_links';
    protected $fillable = ['display_order', 'name_en', 'name_ar', 'link', 'is_active'];
}
