<?php

namespace App\Http\Controllers\Front\Job;

use App\Http\Requests\Front\Job\JobBasicInfoRequest;
use App\Modules\Models\User\User;
use App\Modules\Service\Advertisement\AdvertisementService;
use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Company\CompanyService;
use App\Modules\Service\FrontEnd\GeneralService;
use App\Modules\Service\JobLevel\JobLevelService;
use App\Modules\Service\JobLocation\JobLocationService;
use App\Modules\Service\JobService\JobServicesService;
use App\Modules\Service\JobSkill\JobSkillService;
use App\Modules\Service\JobType\JobTypeService;
use App\Modules\Service\User\UserService;
use App\Modules\Service\Job\JobService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;

class JobController extends Controller
{
    protected $job;
    protected $company;
    protected $category;
    protected $userService;
    protected $jobLevel;
    protected $jobLocation;
    protected $jobType;
    protected $jobSkill;
    protected $jobServices;
    protected $jobCandidate;
    protected $generalService;
    protected $advertisement;
    protected $candidate;

    function __construct(JobService $job, CompanyService $company, CategoryService $category, UserService $userService,
                         JobLevelService $jobLevel, JobLocationService $jobLocation, JobTypeService $jobType,
                         JobServicesService $jobServices, JobSkillService $jobSkill, CandidateService $jobCandidate,
                         GeneralService $generalService,AdvertisementService $advertisement, CandidateService $candidate)
    {
        $this->company = $company;
        $this->category = $category;
        $this->userService = $userService;
        $this->job = $job;
        $this->jobLevel = $jobLevel;
        $this->jobLocation = $jobLocation;
        $this->jobType = $jobType;
        $this->jobSkill = $jobSkill;
        $this->jobServices = $jobServices;
        $this->jobCandidate = $jobCandidate;
        $this->generalService = $generalService;
        $this->advertisement = $advertisement;
        $this->candidate = $candidate;
    }

    public function jobList($country = null,$type = null)
    {
        $ads = $this->advertisement->getAds('job-list');
        if ($country && empty($type)) {
            if ($country == 'nepal') {
                $jobs = $this->job->getHomeCountryJobs();
            } else {
                $jobs = $this->job->getAbroadJobs();
            }
        }
        elseif ($country && $type){
            $jobs = $this->job->getJobsByCountryType($country,$type);
        }
        else {
            $jobs = $this->job->getAllJobsFront();
        }
        $searchCategories = $this->generalService->getSearchCategory();
        $featuredCategories = $this->generalService->getFeaturedCategories(12);
        $featuredCompanies = $this->generalService->getFeaturedCompanies();
        return view('frontend.jobs.job-listing', compact('jobs', 'searchCategories', 'featuredCategories','featuredCompanies','ads'));
    }

    public function jobDetail($id)
    {
        if (Auth::check() && auth()->user()->hasRole(['ROLE_CANDIDATE'])) {
            $user = auth()->id();
            $candidate = $this->userService->getCandidate($user);
            $appliedJobsArr = $candidate->job_applications->pluck('ref_id')->toArray();
        } else {
            $appliedJobsArr = [];
        }
        $job = $this->job->findByRefId($id);
        $job->increment('views');
        $relatedJobs = $this->job->getRelatedJobs($job);

        return view('frontend.jobs.job-detail', compact('job', 'relatedJobs', 'appliedJobsArr'));
    }

    public function createJob(Request $request)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $categories = $this->category->getCandidateCategories();
        $jobLevels = $this->jobLevel->jobLevelFront();
//        $jobLocations = $this->jobLocation->jobLocationFront();
        $jobServices = $this->jobServices->jobServiceFront();
        $jobTypes = $this->jobType->jobTypeFront();
        $jobDetail = $request->session()->get('job_create');
        $formType = 'basic';
        $formTitle = 'Basic Job Information';

        return view('frontend.jobs.create', compact('company', 'categories', 'jobLevels', 'jobServices', 'jobTypes', 'jobDetail', 'formType', 'formTitle'));
    }

    public function storeUpdateJob(Request $request, $jobId = null)
    {
        $type = $request->submit;

        if ($type == 'job_basic') {

            $validatedData = $request->validate([
                'title' => 'required',
                'end_date' => 'required|after:today',
            ]);

            if (empty($request->session()->get('job_create'))) {
                $job_basic = $this->job->fillSession($request->all());

                $request->session()->put('job_create', $job_basic);
            } else {
                $job_basic = $request->session()->get('job_create');

                $job_basic->fill($request->all());

                $request->session()->put('job_create', $job_basic);
            }

            return redirect()->route('company.job.specification');
        }
        if ($type == 'job_specific') {

//            $validatedData = $request->validate([
//                'education_level' => 'required',
//                'experience_type' => 'required',
//                'experience_value' => 'required',
//            ]);

            $job_basic = $request->session()->get('job_create');

            $job_basic->fill($request->all());
            $job_basic->setAttribute('skills',$request->skills);

            $request->session()->put('job_create', $job_basic);
            return redirect()->route('company.job.description');
        }
        if ($type == 'job_desc') {

            $job_basic = $request->session()->get('job_create');

            $job_basic->fill($request->all());

            $request->session()->put('job_create', $job_basic);

            return redirect()->route('company.job.vacancy-setting');
        }
        if ($type == 'vacancy_setting') {

            $job_basic = $request->session()->get('job_create');

            $job_basic->fill($request->all());

            if ($jobId) {
                $this->job->updateJobFront($job_basic->toArray(), $jobId);
                Toastr::success('Job Updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            } else {
                $user = auth()->id();
                $company = $this->userService->getCompany($user);
                $this->job->storeJobFront($company, $job_basic->toArray());
                Toastr::success('Job created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            }

            $request->session()->forget('job_create');

            return redirect()->route('company.dashboard');
        }

        Toastr::error('Job cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.job.create');
    }

    public function editJob($id)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $categories = $this->category->getCandidateCategories();
        $jobLevels = $this->jobLevel->jobLevelFront();
//        $jobLocations = $this->jobLocation->jobLocationFront();
        $jobServices = $this->jobServices->jobServiceFront();
        $jobTypes = $this->jobType->jobTypeFront();
        $jobDetail = $this->job->findByRefId($id);
        $formType = 'basic';
        $formTitle = 'Basic Job Information';

        return view('frontend.jobs.edit', compact('company', 'categories', 'jobLevels', 'jobServices', 'jobTypes', 'jobDetail', 'formType', 'formTitle'));
    }

    public function updateJob(Request $request, $jobId)
    {
        $type = $request->submit;

        if ($type == 'job_basic') {

            $validatedData = $request->validate([
                'title' => 'required',
                'end_date' => 'required|after:today',
            ]);

            if (empty($request->session()->get('job_create'))) {
                $job_basic = $this->job->fillSession($request->all());
                $request->session()->put('job_create', $job_basic);
            } else {
                $job_basic = $request->session()->get('job_create');

                $job_basic->fill($request->all());

                $request->session()->put('job_create', $job_basic);
            }
            return redirect()->route('company.job.specification', $jobId);
        }
        if ($type == 'job_specific') {
//            $validatedData = $request->validate([
//                'education_level' => 'required',
//                'experience_type' => 'required',
//                'experience_value' => 'required',
//            ]);

            $job_basic = $request->session()->get('job_create');

            $job_basic->fill($request->all());

            $request->session()->put('job_create', $job_basic);

            return redirect()->route('company.job.description', $jobId);
        }
        if ($type == 'job_desc') {

            $job_basic = $request->session()->get('job_create');

            $job_basic->fill($request->all());

            $request->session()->put('job_create', $job_basic);

            return redirect()->route('company.job.vacancy-setting', $jobId);
        }
        if ($type == 'vacancy_setting') {

            $job_basic = $request->session()->get('job_create');

            $job_basic->fill($request->all());

            $this->job->updateJobFront($job_basic->toArray(), $jobId);

            $request->session()->forget('job_create');

            Toastr::success('Job Updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.dashboard');
        }

        Toastr::error('Job cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.job.edit', $jobId);

    }

    public function destoryJob($id)
    {
        $jobDetail = $this->job->findByRefId($id);
        if ($this->job->delete($jobDetail->id)) {
            Toastr::success('Job deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.job.all-jobs');
        }
        Toastr::error('Job cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.job.all-jobs');
    }

    public function jobSpecification(Request $request, $jobId = null)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $jobSkills = $this->jobSkill->jobSkillFront();
        $job = $request->session()->get('job_create');
        $formType = 'specification';
        $formTitle = 'Job Specification';
        $jobDetail = '';
        if ($jobId) {
            $jobDetail = $this->job->findByRefId($jobId);
            return view('frontend.jobs.edit', compact('company', 'jobSkills', 'job', 'formType', 'formTitle', 'jobDetail'));
        } else {
            return view('frontend.jobs.create', compact('company', 'jobSkills', 'job', 'formType', 'formTitle'));
        }
    }

    public function jobDescription(Request $request, $jobId = null)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $job = $request->session()->get('job_create');
        $formType = 'description';
        $formTitle = 'Job Description';
        $jobDetail = '';
        if ($jobId) {
            $jobDetail = $this->job->findByRefId($jobId);
            return view('frontend.jobs.edit', compact('company', 'job', 'formType', 'formTitle', 'jobDetail'));
        } else {
            return view('frontend.jobs.create', compact('company', 'job', 'formType', 'formTitle'));
        }
    }

    public function vacancySetting(Request $request, $jobId = null)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $job = $request->session()->get('job_create');
        $formType = 'vacancy';
        $formTitle = 'Vacancy Setting';
        $jobDetail = '';
        if ($jobId) {
            $jobDetail = $this->job->findByRefId($jobId);
            return view('frontend.jobs.edit', compact('company', 'job', 'formType', 'formTitle', 'jobDetail'));
        } else {
            return view('frontend.jobs.create', compact('company', 'job', 'formType', 'formTitle'));
        }
    }

    public function allJobs()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $jobs = $this->company->getCompanyJobs($company->id);
        return view('frontend.company.jobs.all-jobs', compact('company', 'jobs'));
    }

    public function jobByCategory($category)
    {
        $ads = $this->advertisement->getAds('job-list');
        $searchCategories = $this->generalService->getSearchCategory();
        $jobs = $this->job->getJobByCategory($category);
        $featuredCategories = $this->generalService->getCategory(12);
        $featuredCompanies = $this->generalService->getFeaturedCompanies();
        return view('frontend.jobs.job-listing', compact('jobs', 'searchCategories', 'featuredCategories','featuredCompanies','ads'));
    }

    public function applications($jobRefId = null)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $job = $this->job->findByRefId($jobRefId);
        $candidates = $job->applicants()->paginate(10);
//        $candidates = $this->company->getJobApplicants($company);
        return view('frontend.company.jobs.application', compact('company', 'candidates','job'));
    }

    public function jobApply($refId = null)
    {
        $job = $this->job->findByRefId($refId);
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        return view('frontend.candidate.job.apply', compact('job', 'candidate'));

    }

    public function jobApplicationPost($refId = null)
    {
        $job = $this->job->findByRefId($refId);
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        if ($this->job->postJobApplication($job, $candidate)) {
            Toastr::success('Job Application posted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.dashboard');
        }
        Toastr::error('Job Application process cannot be completed.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('candidate.job.apply.process', $refId);

    }

    function candidateResume($id = null)
    {
        $jobCandidate = $this->jobCandidate->findByRefId($id);
        return redirect($jobCandidate->resume_path);
    }

    function manageApplication($id = null, $action = null)
    {
        if ($action == 'shortlisted') {
            $this->job->updateJobStatus($id, 'shortlisted');
        }

        if ($action == 'rejected') {
            $this->job->updateJobStatus($id, 'rejected');
        }

        Toastr::success('Job Application Status has been Updated and Candidate have been Notified.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->back();
    }
}
