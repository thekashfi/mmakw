<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'gwc_resumes';
    protected $fillable = ['name', 'career_id', 'email', 'mobile', 'message', 'file', 'has_seen'];

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
}
