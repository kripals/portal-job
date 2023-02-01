<?php

namespace App\Modules\Models\Package;

use App\Modules\Models\Company\Company;
use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'title', 'slug','type','quantity','rate','expiry','display_type', 'status','visibility',
        'is_deleted', 'deleted_at', 'created_by', 'last_updated_by',
        'last_deleted_by', 'created_by', 'last_updated_by', 'last_deleted_by'];

    protected $appends = [
        'status_text','visibility_text','expiry_text'
    ];

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function getVisibilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->visibility));
    }

    function getExpiryTextAttribute()
    {
        return $this->expiry.' Day(s)';
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function company()
    {
        return $this->belongsToMany(Company::class)->withPivot('order_id','quantity','discount')
            ->withTimestamps();
    }
}
