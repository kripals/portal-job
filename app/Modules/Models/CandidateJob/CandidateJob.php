<?php

namespace App\Modules\Models\CandidateJob;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Job\Job;
use Illuminate\Database\Eloquent\Model;

class CandidateJob extends Model
{
    protected $table = 'candidate_job';

    protected $fillable = [
        'ref_id', 'job_id', 'candidate_id', 'status'
    ];

    protected $appends = [
       'status_text'
    ];

    public function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
