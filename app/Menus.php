<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{

protected $table = 'gwc_menus';

protected $fillable = [
    'name', 'link','icon'
];

public function parent() {
return $this->hasOne('App\Menus', 'id', 'parent_id')->where('is_active', '1')->orderBy('display_order');
}

public function children() {
return $this->hasMany('App\Menus', 'parent_id', 'id')->where('is_active', '1')->orderBy('display_order');
}

public static function tree() {
return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '0')->where('is_active', '1')->orderBy('display_order')->get();
}

public function submenu(){
 return $this->hasMany('App\Menus', 'parent_id','id');
}

	
}
