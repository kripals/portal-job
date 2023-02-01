<?php

namespace App\Http\Controllers\Admin\Candidate;

use App\Http\Requests\Admin\Candidate\CandidateRequest;
use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\EducationBoard\EducationBoardService;
use App\Modules\Service\JobCountry\JobCountryService;
use App\Modules\Service\JobLevel\JobLevelService;
use App\Modules\Service\JobLocation\JobLocationService;
use App\Modules\Service\JobSkill\JobSkillService;
use App\Modules\Service\JobType\JobTypeService;
use App\Modules\Service\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class CandidateController extends Controller
{
    protected $candidate;
    protected $category;
    protected $user;
    protected $jobLevel;
    protected $jobType;
    protected $skill;
    protected $jobLocation;
    protected $jobCountry;
    protected $educationBoard;

    function __construct(
        CandidateService $candidate,
        CategoryService $category,
        UserService $user,
        JobTypeService $jobType,
        JobLevelService $jobLevel,
        JobSkillService $skill,
        JobLocationService $jobLocation,
        JobCountryService $jobCountry,
        EducationBoardService $educationBoard
    )
    {
        $this->candidate = $candidate;
        $this->category = $category;
        $this->user = $user;
        $this->skill = $skill;
        $this->jobLevel = $jobLevel;
        $this->jobType = $jobType;
        $this->jobLocation = $jobLocation;
        $this->jobCountry = $jobCountry;
        $this->educationBoard = $educationBoard;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = $this->candidate->paginate();
        return view('admin.candidate.index', compact('candidates'));
    }


    public function getAllData()
    {
        return $this->candidate->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $refId = getRandomInt();
        $candidateCategories = $this->category->getCandidateCategories();
        $companyCategories = $this->category->getCompanyCategories();
        $users = $this->user->candidateUsers();
        $jobLevels = $this->jobLevel->getJobLevelAdmin();
        $jobLocations = $this->jobLocation->getJobLocationAdmin();
        $jobCountries = $this->jobCountry->getJobCountryAdmin();
        $jobTypes = $this->jobType->getJobTypeAdmin();
        $skills = $this->skill->getJobSkillAdmin();
        $educationBoards = $this->educationBoard->getEducationBoardAdmin();

        return view('admin.candidate.create', compact('refId', 'candidateCategories', 'companyCategories', 'users', 'jobLevels', 'jobLocations', 'jobTypes', 'skills','jobCountries','educationBoards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        if ($candidate = $this->candidate->create($request->all())) {
            if ($request->hasFile('resume')) {
                $this->uploadFile($request, $candidate);
            }
            Toastr::success('Candidate created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('candidate.index');
        }
        Toastr::error('Candidate cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('candidate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = $this->candidate->find($id);

        $educations = $this->candidate->getEducations($candidate);
        $experiences = $this->candidate->getExperiences($candidate);
        $trainings = $this->candidate->getTrainings($candidate);
        $references = $this->candidate->getReferences($candidate);
        $languages = $this->candidate->getLanguages($candidate);
        $socialMedias = $this->candidate->getSocialMedias($candidate);
        $contactDetails = $this->candidate->getContactDetails($candidate);
        return view('admin.candidate.detail', compact('candidate', 'educations', 'experiences', 'trainings', 'references', 'languages', 'socialMedias', 'contactDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = $this->candidate->find($id);
        $candidateCategories = $this->category->getCandidateCategories();
        $companyCategories = $this->category->getCompanyCategories();
        $users = $this->user->candidateUsers();
        $jobLevels = $this->jobLevel->getJobLevelAdmin();
        $jobLocations = $this->jobLocation->getJobLocationAdmin();
        $jobTypes = $this->jobType->getJobTypeAdmin();
        $skills = $this->skill->getJobSkillAdmin();
        $educations = $this->candidate->getEducations($candidate);
        $experiences = $this->candidate->getExperiences($candidate);
        $trainings = $this->candidate->getTrainings($candidate);
        $references = $this->candidate->getReferences($candidate);
        $languages = $this->candidate->getLanguages($candidate);
        $socialMedias = $this->candidate->getSocialMedias($candidate);
        $jobCountries = $this->jobCountry->getJobCountryAdmin();
        $educationBoards = $this->educationBoard->getEducationBoardAdmin();
        return view('admin.candidate.edit', compact('candidate', 'candidateCategories', 'companyCategories', 'users',
            'jobLevels', 'jobLocations', 'jobTypes', 'skills', 'educations', 'experiences', 'trainings', 'references', 'languages', 'socialMedias','jobCountries','educationBoards'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->candidate->update($id, $request->all())) {
            if ($request->hasFile('resume')) {
                $company = $this->candidate->find($id);
                $this->uploadFile($request, $company);
            }
            Toastr::success('Candidate updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('candidate.index');
        }
        Toastr::error('Candidate cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('candidate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->candidate->delete($id)) {
            Toastr::success('Candidate deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('candidate.index');
        }
        Toastr::error('Candidate cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('candidate.index');
    }


    function uploadFile(Request $request, $candidate)
    {
        $file = $request->file('resume');
        $fileName = $this->candidate->uploadFile($file);
        if (!empty($candidate->image))
            $this->candidate->__deleteImages($candidate);


        $data['resume'] = $fileName;
        $this->candidate->updateImage($candidate->id, $data);

    }

    public function getCandidateJobs($candidate = null)
    {
        $candidate = $this->candidate->find($candidate);
        return view('admin.candidate.job.index',compact('candidate'));
    }

    public function getAllCandidateJobs($candidate = null)
    {
        $candidate = $this->candidate->find($candidate);
        return $this->candidate->getAllJobData($candidate);
    }

    function viewResume($id = null)
    {
        $candidate = $this->candidate->find($id);
        return redirect($candidate->resume_path);
    }

    function getCloneFields(Request $request)
    {
        $fieldName = $request->field_name;
        $divCount = $request->div_count;
        if ($fieldName == 'educations') {
            return $this->candidate->getEducationFields($fieldName, $divCount);
        }
        if ($fieldName == 'experiences') {
            return $this->candidate->getExperienceFields($fieldName, $divCount);
        }
        if ($fieldName == 'trainings') {
            return $this->candidate->getTrainingFields($fieldName, $divCount);
        }
        if ($fieldName == 'references') {
            return $this->candidate->getReferenceFields($fieldName, $divCount);
        }
        if ($fieldName == 'languages') {
            return $this->candidate->getLanguageFields($fieldName, $divCount);
        }
        if ($fieldName == 'social_medias') {
            return $this->candidate->getSocialMediaFields($fieldName, $divCount);
        }
    }

    function removeFields(Request $request)
    {
        $itemName = $request->item_name;
        $refID = $request->ref_id;
        return $this->candidate->removeFields($itemName, $refID);
    }
}
