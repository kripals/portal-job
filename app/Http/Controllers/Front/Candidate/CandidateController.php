<?php

namespace App\Http\Controllers\Front\Candidate;

use App\Http\Requests\Admin\Candidate\CandidateRequest;
use App\Http\Requests\Front\Candidate\CandidateBasicInfoRequest;
use App\Http\Requests\Front\Candidate\CandidateDetailRequest;
use App\Http\Requests\Front\Candidate\CandidateEducationRequest;
use App\Http\Requests\Front\Candidate\CandidateExperienceRequest;
use App\Http\Requests\Front\Candidate\CandidateJobPreferenceRequest;
use App\Http\Requests\Front\Candidate\CandidateLanguageRequest;
use App\Http\Requests\Front\Candidate\CandidateOthersRequest;
use App\Http\Requests\Front\Candidate\CandidatePrivacyRequest;
use App\Http\Requests\Front\Candidate\CandidateReferenceRequest;
use App\Http\Requests\Front\Candidate\CandidateRegisterRequest;
use App\Http\Requests\Front\Candidate\CandidateSocialMediaRequest;
use App\Http\Requests\Front\Candidate\CandidateTrainingRequest;
use App\Http\Requests\Front\Company\CompanyRegisterRequest;
use App\Http\Requests\Front\User\UserPasswordUpdateRequest;
use App\Modules\Models\User\User;
use App\Modules\Service\Advertisement\AdvertisementService;
use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Company\CompanyService;
use App\Http\Requests\Admin\Company\CompanyRequest;
use App\Modules\Service\EducationBoard\EducationBoardService;
use App\Modules\Service\FrontEnd\GeneralService;
use App\Modules\Service\Job\JobService;
use App\Modules\Service\JobCountry\JobCountryService;
use App\Modules\Service\JobLevel\JobLevelService;
use App\Modules\Service\JobLocation\JobLocationService;
use App\Modules\Service\JobSkill\JobSkillService;
use App\Modules\Service\JobType\JobTypeService;
use App\Modules\Service\User\UserService;

//use Barryvdh\DomPDF\PDF;
use PDF;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kamaln7\Toastr\Facades\Toastr;

class CandidateController extends Controller
{
    protected $candidate;
    protected $category;
    protected $user;
    protected $userService;
    protected $skill;
    protected $jobType;
    protected $jobLevel;
    protected $jobLocation;
    protected $job;
    protected $jobCountry;
    protected $educationBoard;
    protected $generalService;
    protected $advertisement;

    function __construct(CandidateService $candidate, CategoryService $category, User $user, UserService $userService,
                         JobTypeService $jobType, JobLevelService $jobLevel, JobSkillService $skill,
                         JobLocationService $jobLocation, JobService $job, JobCountryService $jobCountry, GeneralService $generalService, EducationBoardService $educationBoard, AdvertisementService $advertisement)
    {
        $this->candidate = $candidate;
        $this->category = $category;
        $this->user = $user;
        $this->userService = $userService;
        $this->skill = $skill;
        $this->jobLevel = $jobLevel;
        $this->jobType = $jobType;
        $this->jobLocation = $jobLocation;
        $this->job = $job;
        $this->jobCountry = $jobCountry;
        $this->generalService = $generalService;
        $this->educationBoard = $educationBoard;
        $this->advertisement = $advertisement;
    }

    public function candidateList($country = null)
    {

        $ads = $this->advertisement->getAds('candidate-list');
        if ($country) {
//            $candidates = $this->candidate->getByCountry($country);
            $candidates = candidateAll($country);
        } else {
            $candidates = $this->candidate->all(30);
        }
        $searchCategories = $this->generalService->getSearchCategory();
        $featuredCompanies = $this->generalService->getFeaturedCompanies();
        if (Auth::guard('web')->check() && Auth::user()->hasRole(['ROLE_COMPANY'])) {
            return view('frontend.candidate.candidate-list', compact('candidates', 'searchCategories', 'featuredCompanies', 'ads'));
        } else {
            return view('frontend.validate', compact('candidates', 'searchCategories'));
        }

    }

    public function candidateDetail($id = null)
    {
        $candidate = $this->candidate->findByRefID($id);
        $candidate->increment('views');
        if (Auth::guard('web')->check() && Auth::user()->hasRole(['ROLE_COMPANY'])) {
            return view('frontend.candidate.candidate-detail', compact('candidate'));
        } else {
            return view('frontend.validate');
        }

    }

    public function candidateProfile()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        return view('frontend.candidate.candidate-details.profile', compact('candidate'));
    }

    public function appliedJobs()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $appliedJobs = $this->job->getAppliedJobs($candidate);

        return view('frontend.candidate.candidate-details.applied-job', compact('candidate', 'appliedJobs'));
    }


    public function downloadResume($candidateId = null)
    {
        if (!empty($candidateId)) {
            $candidate = $this->candidate->findByRefId($candidateId);
        } else {
            $user = auth()->id();
            $candidate = $this->userService->getCandidate($user);
        }
        ini_set('max_execution_time', 200);
        $pdf = PDF::loadView('frontend.candidate.candidate-details.download', compact('candidate'));

        return $pdf->download($candidate->user->full_name);
//        return $pdf->setPaper('a4')->stream();
        // return view('frontend.candidate.candidate-details.download', compact('candidate'));
    }

    public function fetchLocation(Request $request)
    {
        $locations = $this->jobLocation->getLocationByCountry($request->country_id);
        $output = '<option value="">Select Location</option>';
        foreach ($locations as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->title . '</option>';
        }

        return $output;
    }

    public function register(CandidateRegisterRequest $request)
    {

        event(new Registered($user = $this->user->create($request->all())));
        if (!empty($user)) {
            $role = $this->userService->attachRegisterRole($user, 'Candidate');
            $this->candidate->registerCandidate($user, $request->all());
            Toastr::success('Candidate registration successful. Please check mail for activation code.', 'Success !!!', ['positionClass' => 'toast-bottom-right']);

            return redirect()->route('login');
        }
        Toastr::error('Candidate Registration process failed. Please try again.', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('signup');

    }

    public function dashboard()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $jobTypes = $this->jobType->jobTypeFront();
        $matchingJobs = $this->job->getMatchingJobs($candidate);
        $appliedJobs = $this->job->getAppliedJobs($candidate, 5);
        $shortlisted = $this->job->getShortlistedCount($candidate);
        $appliedJobsCount = $this->job->getAppliedJobs($candidate);
        $appliedJobsArr = $candidate->job_applications->pluck('ref_id')->toArray();
        foreach ($jobTypes as $type) {
            $jobType = $type;
        }

        return view('frontend.candidate.candidate-dashboard', compact('candidate', 'jobType', 'matchingJobs', 'appliedJobs', 'appliedJobsArr', 'appliedJobsCount', 'shortlisted'));
    }

    public function JobPreference()
    {

        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $candidateCategories = $this->category->getCandidateCategories();
        $jobLevels = $this->jobLevel->jobLevelFront();
        $jobLocations = $this->jobLocation->jobLocationFront();
        $jobCountries = $this->jobCountry->jobCountryFront();
        $jobTypes = $this->jobType->jobTypeFront();
        $skills = $this->skill->jobSkillFront();

        return view('frontend.candidate.candidate-details.job-preference', compact('candidateCategories', 'candidate', 'jobLevels', 'jobLocations', 'jobTypes', 'skills', 'jobCountries'));
    }

    public function updateJobPreference(CandidateJobPreferenceRequest $request, $candidate)
    {
        if ($this->candidate->updateJobPreference($candidate, $request->all())) {
            Toastr::success('Candidate updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.edit-profile');
        }
        Toastr::error('Candidate cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

    }

    public function basicInfo()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        $contactDetails = $educations = $this->candidate->getContactDetails($candidate);

        return view('frontend.candidate.candidate-details.basicinfo', compact('candidate', 'contactDetails'));
    }

    public function storeBasicInfo(CandidateBasicInfoRequest $request, $candidate)
    {
        if ($this->candidate->storeBasicInfo($candidate, $request->all())) {
            if ($request->hasFile('resume')) {
                $candidate = $this->candidate->findByRefId($candidate);
                $this->uploadResumeFile($request, $candidate);
            }
            if ($request->hasFile('avatar')) {
                $candidateAvatar = $this->candidate->find($candidate);
                $this->candidate->uploadAvatarFile($request->avatar, $candidateAvatar);
            }

            Toastr::success('Candidate Basic Information updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.basic-information');
        }
        Toastr::error('Candidate Basic Information cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.basic-information');

    }

    public function education()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $educations = $this->candidate->getEducations($candidate);
        $educationBoards = $this->educationBoard->educationBoardFront();

        return view('frontend.candidate.candidate-details.education', compact('candidate', 'educations', 'educationBoards'));
    }

    public function storeEducation(CandidateEducationRequest $request, $candidate)
    {

        if ($candidate = $this->candidate->storeEducation($candidate, $request->all())) {
            Toastr::success('Candidate Education created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.education');
        }
        Toastr::error('Candidate Education cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.education');
    }

    public function training()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        $trainings = $this->candidate->getTrainings($candidate);

        return view('frontend.candidate.candidate-details.training', compact('candidate', 'trainings'));
    }

    public function storeTraining(CandidateTrainingRequest $request, $candidate)
    {
        if ($candidate = $this->candidate->storeTraining($candidate, $request->all())) {
            Toastr::success('Candidate Training created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.training');
        }
        Toastr::error('Candidate Training cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.training');
    }

    public function workExperience()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $companyCategories = $this->category->getCompanyCategories();
        $candidateCategories = $this->category->getCandidateCategories();
        $jobLevels = $this->jobLevel->jobLevelFront();
        $jobLocations = $this->jobLocation->jobLocationFront();

        $experiences = $this->candidate->getExperiences($candidate);

        return view('frontend.candidate.candidate-details.work-experience', compact('candidate', 'companyCategories', 'candidateCategories', 'jobLevels', 'jobLocations', 'experiences'));

    }

    public function storeExperience(CandidateExperienceRequest $request, $candidate)
    {
        if ($candidate = $this->candidate->storeExperience($candidate, $request->all())) {
            Toastr::success('Candidate Job Experience created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.work-experience');
        }
        Toastr::error('Candidate Job Experience cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.work-experience');
    }

    public function language()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $languages = $this->candidate->getLanguages($candidate);

        return view('frontend.candidate.candidate-details.language', compact('candidate', 'languages'));
    }

    public function storeLanguage(CandidateLanguageRequest $request, $candidate)
    {
        if ($candidate = $this->candidate->storeLanguage($candidate, $request->all())) {
            Toastr::success('Candidate Language created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.language');
        }
        Toastr::error('Candidate Language cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.language');
    }

    public function socialMedia()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        $socialMedias = $this->candidate->getSocialMedias($candidate);

        return view('frontend.candidate.candidate-details.social-account', compact('candidate', 'socialMedias'));
    }

    public function storeSocialMedia(CandidateSocialMediaRequest $request, $candidate)
    {
        if ($candidate = $this->candidate->storeSocialMedia($candidate, $request->all())) {
            Toastr::success('Candidate Social Media created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.social-account');
        }
        Toastr::error('Candidate Social Media cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.social-account');
    }

    public function reference()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        $references = $this->candidate->getReferences($candidate);

        return view('frontend.candidate.candidate-details.reference', compact('candidate', 'references'));
    }

    public function storeReference(CandidateReferenceRequest $request, $candidate)
    {

        if ($candidate = $this->candidate->storeReference($candidate, $request->all())) {
            Toastr::success('Candidate references created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.reference');
        }
        Toastr::error('Candidate references cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.reference');
    }

    public function others()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);

        return view('frontend.candidate.candidate-details.others', compact('candidate'));
    }

    public function storeOthers(Request $request, $candidate)
    {
        if ($candidate = $this->candidate->storeOthers($candidate, $request->all())) {
            Toastr::success('Candidate data saved.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);

            return redirect()->route('candidate.others');
        }
        Toastr::error('Candidate data cannot be saved.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);

        return redirect()->route('candidate.others');
    }

    function uploadResumeFile(Request $request, $candidate)
    {
        $file = $request->file('resume');
        $fileName = $this->candidate->uploadFile($file);

        if (!empty($candidate->resume)) {
            $this->candidate->__deleteImages($candidate);
        }

        $data['resume'] = $fileName;

        $this->candidate->updateFrontResume($candidate->ref_id, $data);

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
        if ($fieldName == 'contactDetails') {
            return $this->candidate->getFrontContactDetailsFields($fieldName, $divCount);
        }
        if ($fieldName == 'educations') {
            return $this->candidate->getFrontEducationFields($fieldName, $divCount);
        }
        if ($fieldName == 'experiences') {
            return $this->candidate->getFrontExperienceFields($fieldName, $divCount);
        }
        if ($fieldName == 'trainings') {
            return $this->candidate->getFrontTrainingFields($fieldName, $divCount);
        }
        if ($fieldName == 'references') {
            return $this->candidate->getFrontReferenceFields($fieldName, $divCount);
        }
        if ($fieldName == 'languages') {
            return $this->candidate->getFrontLanguageFields($fieldName, $divCount);
        }
        if ($fieldName == 'social_medias') {
            return $this->candidate->getFrontSocialMediaFields($fieldName, $divCount);
        }
    }

    function removeFields(Request $request)
    {
        $itemName = $request->item_name;
        $refID = $request->ref_id;

        return $this->candidate->removeFields($itemName, $refID);
    }

    public function accountSetting()
    {
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        return view('frontend.candidate.account-setting', compact('candidate'));
    }

    public function storeChangePassword(UserPasswordUpdateRequest $request)
    {
        $user = auth()->id();

        $this->userService->updateUserPassword($user, $request->all());

        Toastr::success('Password updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('candidate.account-setting');
    }

    public function privacyControl()
    {
        candidateAll();
        $user = auth()->id();
        $candidate = $this->userService->getCandidate($user);
        $privacyControls = $this->candidate->getPrivacyControls($candidate);

        return view('frontend.candidate.privacy-control', compact('candidate', 'privacyControls'));
    }

    public function storePrivacy(CandidatePrivacyRequest $request, $candidate)
    {
        if ($candidate = $this->candidate->storePrivacy($candidate, $request->all())) {
            Toastr::success('Candidate data saved.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('candidate.privacy-control');
        }
        Toastr::error('Candidate data cannot be saved.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('candidate.privacy-control');
    }
}

