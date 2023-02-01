<?php

namespace App\Modules\Models\JobLevel;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Job\Job;
use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class JobLevel extends Model
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
        'title', 'slug', 'status', 'is_deleted', 'deleted_at', 'created_by', 'last_updated_by',
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

    function job()
    {
        return $this->belongsTo(Job::class);
    }

    function candidate()
    {
        return $this->hasMany(Candidate::class);
    }
}

