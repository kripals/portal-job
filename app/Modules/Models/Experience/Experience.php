<?php

namespace App\Modules\Models\Experience;

use App\Modules\Models\JobLocation\JobLocation;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\JobLevel\JobLevel;
use App\Modules\Models\Category\Category;

class Experience extends Model
{
    protected $fillable= [
        'ref_id','candidate_id', 'job_title', 'company_name','description','location_id','company_category_id','candidate_category_id','job_level_id','start_date','end_date','is_current'
    ];

    function candidate(){
        return $this->belongsTo(Candidate::class,'candidate_id');
    }

    function job_level(){
        return $this->belongsTo(JobLevel::class,'job_level_id');
    }

    function location(){
        return $this->belongsTo(JobLocation::class,'location_id');
    }

    function company_category(){
        return $this->belongsTo(Category::class,'company_category_id');
    }

    function candidate_category(){
        return $this->belongsTo(Category::class,'candidate_category_id');
    }
}
