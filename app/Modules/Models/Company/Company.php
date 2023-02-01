<?php

namespace App\Modules\Models\Company;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\CandidateJob\CandidateJob;
use App\Modules\Models\Category\Category;
use App\Modules\Models\ContactDetail\ContactDetail;
use App\Modules\Models\Job\Job;
use App\Modules\Models\Package\Package;
use App\Modules\Models\SocialMedia\SocialMedia;
use App\Modules\Models\User\User;
use App\Modules\Models\UserDetail\UserDetail;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Sluggable;

    protected $path = 'uploads/company';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'company_name'
            ]
        ];
    }

    protected $fillable = [
        'company_name', 'slug', 'ref_id', 'user_id', 'company_size', 'category_id','address',
        'company_reg_no', 'ownership', 'description', 'keywords', 'image', 'website','views',
        'visibility', 'status', 'availability', 'is_verified', 'is_deleted','order',
        'deleted_at', 'created_by', 'last_updated_by', 'last_deleted_by'
    ];

    protected $appends = [
        'visibility_text', 'status_text', 'availability_text', 'verified_text', 'image_path', 'thumbnail_path'
    ];

    function getCompanyNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function getRouteKeyName()
    {
        return 'ref_id';
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

    function getVerifiedTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->is_verified));
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

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function contact_persons()
    {
        return $this->hasMany(CompanyContact::class);
    }

    function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function contact_details()
    {
        return $this->morphMany(ContactDetail::class, 'contactable');
    }

    public function social_medias()
    {
        return $this->morphMany(SocialMedia::class, 'socialable');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('order_id','quantity','discount')
            ->withTimestamps();
    }
}
