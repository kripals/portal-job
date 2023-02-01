<?php

namespace App\Modules\Models\JobLocation;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\JobCountry\JobCountry;
use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model
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
        'title', 'slug','job_country_id', 'status', 'is_deleted', 'deleted_at', 'created_by', 'last_updated_by',
        'last_deleted_by', 'created_by', 'last_updated_by', 'last_deleted_by'];

    protected $appends = [
        'status_text'
    ];

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }

    function country()
    {
        return $this->belongsTo(JobCountry::class,'job_country_id');
    }
}
