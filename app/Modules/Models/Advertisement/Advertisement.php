<?php

namespace App\Modules\Models\Advertisement;

use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use Sluggable;

    protected $path = 'uploads/advertisement';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title', 'slug','image', 'link','type','expiry','status', 'is_deleted', 'deleted_at', 'created_by', 'last_updated_by',
        'last_deleted_by', 'created_by', 'last_updated_by', 'last_deleted_by'];

    protected $appends = [
        'status_text','image_path', 'thumbnail_path'
    ];

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function getImagePathAttribute()
    {
        if (!empty($this->image)) {
            return $this->path . '/' . $this->image;
        } else {
            return 'resources/admin/img/noimage.png';
        }

    }

    function getThumbnailPathAttribute()
    {
        if (!empty($this->image)) {
            return $this->path . '/thumb/' . $this->image;
        } else {
            return 'resources/admin/img/avatar7.jpg';
        }
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
