<?php

namespace App\Modules\Service\FrontEnd;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Category\Category;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Job\Job;
use App\Modules\Models\Testimonial\Testimonial;
use Carbon\Carbon;

class GeneralService{

    protected $category;
    protected $testimonial;
    protected $candidate;
    protected $company;
    protected $job;

    function __construct(
        Category $category,
        Testimonial $testimonial,
        Candidate $candidate,
        Company $company,
        Job $job
    )
    {
        $this->category = $category;
        $this->testimonial = $testimonial;
        $this->candidate = $candidate;
        $this->company = $company;
        $this->job = $job;
    }
    /**
     * @return Category
     */
    public function getCategory($limit = null)
    {
        if($limit)
        {
            return $this->category->whereIsDeleted('no')->whereStatus('active')->whereType('candidate')->whereAvailability('available')->take($limit)->get();
        }else{
            return $this->category->whereIsDeleted('no')->whereStatus('active')->whereType('candidate')->whereAvailability('available')->get();
        }
    }

    public function getFeaturedCategories($limit = null)
    {
        if($limit)
        {
            return $this->category->whereIsDeleted('no')->whereStatus('active')->whereType('candidate')->whereAvailability('available')->whereVisibility('visible')->take($limit)->inRandomOrder()->get();
        }else{
            return $this->category->whereIsDeleted('no')->whereStatus('active')->whereType('candidate')->whereAvailability('available')->whereVisibility('visible')->inRandomOrder()->get();
        }
    }

    public function getSearchCategory()
    {
            return $this->category->whereIsDeleted('no')->whereStatus('active')->whereType('candidate')->whereAvailability('available')->get();
    }

    public function getFeaturedCompanies()
    {
            return $this->company->whereIsDeleted('no')->whereStatus('active')->whereAvailability('available')->whereVisibility('visible')->orderBy('order','ASC')->get();
    }

    /**
     * @return Testimonial
     */
    public function getTestimonials()
    {
        return $this->testimonial->whereIsDeleted('no')->whereStatus('active')->whereVisibility('visible')->whereAvailability('available')->get();
    }

    /**
     * @return Candidate
     */
    public function getHomeTopCandidates()
    {
        return $this->candidate->whereIsDeleted('no')->whereStatus('active')->whereVisibility('visible')->whereAvailability('available')->orderBy('order','ASC')->inRandomOrder()->get()->take(8);
    }

    /**
     * @return Company
     */
    public function getCompanies()
    {
        return $this->company->whereIsDeleted('no')->whereStatus('active')->orderBy('order','ASC')->whereAvailability('available')->get();
    }

    /**
     * @return Job
     */
    public function getJobs()
    {
        return $this->job->whereIsDeleted('no')
        ->whereStatus('active')
        ->whereAvailability('available')
        ->orderBy('order','ASC')
        ->whereIsVerified('yes')
        ->take(20)
        ->whereDate('end_date','>=',Carbon::today()->toDateString())
        ->get();
    }

    public function getJobsByType($type)
    {
        return $this->job->whereHas('job_service',function($q) use($type){
            $q->where('slug','like','%'.$type.'%');
        })->whereIsDeleted('no')
        ->whereStatus('active')
        ->whereAvailability('available')
        ->whereVisibility('visible')
        ->orderBy('order','ASC')
        ->whereIsVerified('yes')
        ->take(20)
        ->whereDate('end_date','>=',Carbon::today()->toDateString())
        ->get();
    }
}
