<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Requests\Admin\Job\JobRequest;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Company\CompanyService;
use App\Modules\Service\Job\JobService;
use App\Modules\Service\JobCountry\JobCountryService;
use App\Modules\Service\JobLevel\JobLevelService;
use App\Modules\Service\JobService\JobServicesService;
use App\Modules\Service\JobSkill\JobSkillService;
use App\Modules\Service\JobType\JobTypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class JobController extends Controller
{
    protected $job;
    protected $company;
    protected $category;
    protected $jobLevel;
    protected $jobType;
    protected $jobSkill;
    protected $jobServices;
    protected $jobCountry;

    function __construct(JobService $job, CompanyService $company, CategoryService $category,
                         JobLevelService $jobLevel, JobTypeService $jobType,
                         JobServicesService $jobServices, JobSkillService $jobSkill, JobCountryService $jobCountry)
    {
        $this->job = $job;
        $this->company = $company;
        $this->category = $category;
        $this->job = $job;
        $this->jobLevel = $jobLevel;
        $this->jobType = $jobType;
        $this->jobSkill = $jobSkill;
        $this->jobServices = $jobServices;
        $this->jobCountry = $jobCountry;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.job.index');
    }

    public function getAllData()
    {
        return $this->job->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $refId = getRandomInt();
        $companies = $this->company->all();
        $categories = $this->category->getCandidateCategories();
        $jobLevels = $this->jobLevel->getJobLevelAdmin();
        $jobServices = $this->jobServices->jobServiceAdmin();
        $jobTypes = $this->jobType->getJobTypeAdmin();
        $jobSkills = $this->jobSkill->getJobSkillAdmin();
        $jobCountries = $this->jobCountry->all();
        return view('admin.job.create', compact('refId','companies','categories','jobLevels', 'jobServices', 'jobTypes','jobSkills','jobCountries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        if ($job = $this->job->create($request->all())) {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $job);
            }
            Toastr::success('Job created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job.index');
        }
        Toastr::error('Job cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = $this->job->find($id);
        $company = $this->job->findCompanyById($job->company_id);
        $contactDetails = $this->company->getContactDetails($company);
        return view('admin.job.detail',compact('job','company','contactDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = $this->job->find($id);
        $refId = getRandomInt();
        $companies = $this->company->all();
        $categories = $this->category->getCandidateCategories();
        $jobLevels = $this->jobLevel->getJobLevelAdmin();
        $jobServices = $this->jobServices->jobServiceAdmin();
        $jobTypes = $this->jobType->getJobTypeAdmin();
        $jobSkills = $this->jobSkill->getJobSkillAdmin();
        $jobCountries = $this->jobCountry->all();
        return view('admin.job.edit', compact('job','refId','companies','categories','jobLevels', 'jobServices', 'jobTypes','jobSkills','jobCountries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->job->update($id, $request->all())) {
            if ($request->hasFile('image')) {
                $job = $this->job->find($id);
                $this->uploadFile($request, $job);
            }
            Toastr::success('Job updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job.index');
        }
        Toastr::error('Job cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->job->delete($id)) {
            Toastr::success('Job deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.index');
        }
        Toastr::error('Job cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.index');
    }

    function uploadFile(Request $request, $job)
    {
        $file = $request->file('image');
        $fileName = $this->job->uploadFile($file);
        if (!empty($job->image))
            $this->job->__deleteImages($job);


        $data['image'] = $fileName;
        $this->job->updateImage($job->id, $data);

    }

    public function getJobCandidates($job = null)
    {
        $job = $this->job->find($job);
        return view('admin.job.candidate.index',compact('job'));
    }

    public function getAllJobCandidates($job = null)
    {
        $job = $this->job->find($job);
        return $this->job->getAllCandidateData($job);
    }

    public function listApplicants()
    {
        return view('admin.job.applicants');
    }

    public function getAllApplicantData()
    {
        return $this->job->getAllApplicantData();
    }
}
