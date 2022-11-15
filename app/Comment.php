<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'gwc_comments';
    protected $fillable = [
        'parent_id', 'news_id', 'name', 'email', 'text', 'is_approved', 'deleted_at'
    ];

    public function childComments(){
        return $this->hasMany(Comment::class,'parent_id')->where('is_approved', 1);
    }

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash";
    }
}
