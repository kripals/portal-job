<?php

namespace App\Modules\Models\Testimonial;

use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use Sluggable;

    protected $path = 'uploads/testimonial';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name', 'slug', 'description', 'keywords', 'image', 'visibility', 'image', 'status', 'availability', 'is_deleted',
        'deleted_at', 'created_by', 'last_updated_by', 'last_deleted_by'
    ];
    protected $appends = [
        'visibility_text', 'status_text', 'availability_text', 'thumbnail_path', 'image_path'
    ];

    function getVisibilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->visibility));
    }

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function getAvailabilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->availability));
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function getImagePathAttribute()
    {
        return $this->path . '/' . $this->image;

    }

    function getThumbnailPathAttribute()
    {
        return $this->path . '/thumb/' . $this->image;
    }

}
