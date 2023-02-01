<?php

namespace App\Modules\Models\Education;

use App\Modules\Models\Job\Job;
use App\Modules\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class EducationBoard extends Model
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

    function education()
    {
        return $this->belongsTo(Education::class);
    }
}
