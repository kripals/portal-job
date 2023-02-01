<?php

namespace App\Modules\Models\Category;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Job\Job;
use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $path = 'uploads/category';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name', 'slug', 'description', 'keywords', 'image', 'type', 'visibility', 'status', 'availability', 'has_subcategory', 'is_deleted',
        'deleted_at', 'created_by', 'last_updated_by', 'last_deleted_by'
    ];
    protected $appends = [
        'visibility_text', 'has_subcategory_text', 'status_text', 'availability_text', 'thumbnail_path', 'image_path'
    ];

    function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    function getImagePathAttribute()
    {
        return $this->path . '/' . $this->image;

    }

    function getThumbnailPathAttribute()
    {
        return $this->path . '/thumb/' . $this->image;
    }

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

    function getInputTypeTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->input_type));
    }

    function getHasSubcategoryTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->has_subcategory));
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function company()
    {
        return $this->belongsTo(Company::class);
    }

    function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    function job()
    {
        return $this->belongsTo(Job::class);
    }



}
