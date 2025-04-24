<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'phone', 'email', 'address', 'short_address', 'facebook', 'twitter',
        'instagram', 'youtube', 'general_title', 'general_description', 'general_photo'
    ];
}
