<?php

namespace App\Modules\Models\SiteSetting;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $path = 'uploads/siteSetting';

    protected $fillable = [
        'name', 'slug','address','email','email1','email2','phone','phone1','phone2','facebook_url','youtube_url','twitter_url','linkedin_url','snaptube_url','image','sub_image','map_src'  ];

    protected $appends = [
        'thumbnail_path', 'image_path'
    ];


    function getImagePathAttribute()
    {
        return $this->path . '/' . $this->image;
    }

    function getThumbnailPathAttribute()
    {
        return $this->path . '/thumb/' . $this->image;
    }

    /**
     * Get the options for generating the slug.
     */
}
