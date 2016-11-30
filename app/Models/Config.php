<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = [
        'code', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image', 'facebook_app_id', 'credit', 'status', 'lang',
    ];
    
}
