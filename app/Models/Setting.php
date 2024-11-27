<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_title',
        'site_logo',
        'site_description',
        'contact_info',
        'facebook_link',
        'youtube_link',
        'twitter_link',
        'whatsapp_link'
    ];

}
