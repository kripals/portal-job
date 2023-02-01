<?php namespace

App\Modules\Service\Candidate;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Candidate\PrivacyControl;
use App\Modules\Models\ContactDetail\ContactDetail;
use App\Modules\Models\Education\Education;
use App\Modules\Models\Experience\Experience;
use App\Modules\Models\Job\Job;
use App\Modules\Models\JobCountry\JobCountry;
use App\Modules\Models\Language\Language;
use App\Modules\Models\Reference\Reference;
use App\Modules\Models\SocialMedia\SocialMedia;
use App\Modules\Models\Training\Training;
use App\Modules\Models\User\User;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\EducationBoard\EducationBoardService;
use App\Modules\Service\JobCountry\JobCountryService;
use App\Modules\Service\JobLevel\JobLevelService;
use App\Modules\Service\JobLocation\JobLocationService;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class CandidateService extends Service
{
    protected $candidate;
    protected $contactDetail;
    protected $category;
    protected $education;
    protected $experience;
    protected $training;
    protected $reference;
    protected $language;
    protected $socialMedia;
    protected $privacy;
    protected $jobLocation;
    protected $jobLevel;
    protected $users;
    protected $jobCountry;
    protected $educationBoard;

    public function __construct(Candidate $candidate, CategoryService $category, User $users, ContactDetail $contactDetail,
                                Education $education, Experience $experience, Training $training, Reference $reference, Language $language,
                                SocialMedia $socialMedia, JobLocationService $jobLocation, JobLevelService $jobLevel, JobCountry $jobCountry,
                                EducationBoardService $educationBoard, PrivacyControl $privacy)
    {
        $this->candidate = $candidate;
        $this->category = $category;
        $this->contactDetail = $contactDetail;
        $this->education = $education;
        $this->experience = $experience;
        $this->training = $training;
        $this->reference = $reference;
        $this->language = $language;
        $this->socialMedia = $socialMedia;
        $this->jobLocation = $jobLocation;
        $this->jobLevel = $jobLevel;
        $this->user = $users;
        $this->jobCountry = $jobCountry;
        $this->educationBoard = $educationBoard;
        $this->privacy = $privacy;
    }

    //    public function getLoggedInCandidate()
    //    {
    //        $user      = auth()->id();
    //        dd($this->candidate->find($user));
    //        $candidate = $this->candidate($user);
    //
    //        dd($candidate);
    //    }
    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->candidate->whereIsDeleted('no')->with('user')->get();

        return DataTables::of($query)->addIndexColumn()
            ->editColumn('candidate_image', function (Candidate $candidate) {
                return getTableHtml($candidate->user, 'image');
            })
            ->addColumn('candidate_name', function (Candidate $candidate) {
                if ($candidate->visibility == 'visible')
                    return "<a href='" . route('candidate.show', $candidate->id) . "'>" . $candidate->user->full_name . "</a> <span class='label label-danger'>Top</span>";
                else
                    return "<a href='" . route('candidate.show', $candidate->id) . "'>" . $candidate->user->full_name . "</a>";
            })
            ->addColumn('company_category', function (Candidate $candidate) {
                return $candidate->category->name;
            })
            ->editColumn('experience_period', function (Candidate $candidate) {
                if (!empty($candidate->experience_period))
                    return $candidate->experience_text;
                else
                    return 'N/A';
            })
            ->addColumn('job_level', function (Candidate $candidate) {
                if (!empty($candidate->job_level_id)) {
                    return $candidate->job_level->title;
                } else {
                    return "N/A";
                }
            })
            ->addColumn('candidate_skills', function (Candidate $candidate) {
                if (!$candidate->known_skills->isEmpty())
                    return getTableHtml($candidate, 'candidate_skills');
                else
                    return "N/A";
            })
            ->addColumn('contact_number', function (Candidate $candidate) {
                if (!$candidate->contact_details->isEmpty()) {
                    return $candidate->contact_details()->first()->detail_value;
                } else {
                    return "N/A";
                }
            })
            ->addColumn('jobs_applied', function (Candidate $candidate) {
                if (!$candidate->job_applications->isEmpty()) {
                    return "<a href='" . route('candidate.job', $candidate->id) . "'>" . $candidate->job_applications()->count() . "</a>";
                } else {
                    return "N/A";
                }
            })
            ->editColumn('availability', function (Candidate $candidate) {
                return getTableHtml($candidate, 'availability');
            })
            ->editColumn('status', function (Candidate $candidate) {
                return getTableHtml($candidate, 'status');
            })->editColumn('actions', function (Candidate $candidate) {
                $editRoute = route('candidate.edit', $candidate->id);
                $deleteRoute = route('candidate.destroy', $candidate->id);
                $optionRoute = route('candidate.show', $candidate->id);
                $optionRouteText = '';
                $optionRoute2 = '';
                $optionRouteText2 = '';
                if ($candidate->resume) {
                    $optionRoute2 = route('candidate.view-resume', $candidate->id);
                    $optionRouteText2 = 'resume';
                }

                return getTableHtml($candidate, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText, $optionRoute2, $optionRouteText2);
            })->rawColumns([
                'candidate_image',
                'candidate_name',
                'jobs_applied',
                'visibility',
                'availability',
                'is_verified',
                'status',
                'actions'
            ])->make(true);
    }


    public function getAllJobData($candidate)
    {
        $query = $candidate->job_applications()->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('title', function (Job $job) {
                return "<a href='" . route('job.show', $job->id) . "'>" . $job->title . "</a>";
            })
            ->editColumn('job_category', function (Job $job) {
                return $job->category->name;
            })
            ->editColumn('job_level', function (Job $job) {
                return $job->job_level->title;
            })
            ->editColumn('job_type', function (Job $job) {
                return $job->job_type->title;
            })
            ->editColumn('job_expiry', function (Job $job) {
                return prettyDate($job->created_at);
            })
            ->editColumn('status', function (Job $job) {
                return getTableHtml($job, 'status');
            })
            ->editColumn('actions', function (Job $job) {
                $editRoute = route('job.edit', $job->id);
                $deleteRoute = route('job.destroy', $job->id);
                $optionRoute = route('job.show', $job->id);
                $optionRouteText = '';

                return getTableHtml($job, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText);
            })->rawColumns(['title', 'job_expiry', 'status', 'actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        try {
            //            dd($data);
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/

            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['travel_outside'] = (isset($data['travel_outside']) ? $data['travel_outside'] : '') == 'on' ? 'yes' : 'no';
            $data['relocate_location'] = (isset($data['relocate_location']) ? $data['relocate_location'] : '') == 'on' ? 'yes' : 'no';
            $data['two_wheeler_license'] = (isset($data['two_wheeler_license']) ? $data['two_wheeler_license'] : '') == 'on' ? 'yes' : 'no';
            $data['four_wheeler_license'] = (isset($data['four_wheeler_license']) ? $data['four_wheeler_license'] : '') == 'on' ? 'yes' : 'no';
            $data['two_wheeler_vehicle'] = (isset($data['two_wheeler_vehicle']) ? $data['two_wheeler_vehicle'] : '') == 'on' ? 'yes' : 'no';
            $data['four_wheeler_vehicle'] = (isset($data['four_wheeler_vehicle']) ? $data['four_wheeler_vehicle'] : '') == 'on' ? 'yes' : 'no';
            $data['is_verified'] = (isset($data['is_verified']) ? $data['is_verified'] : '') == 'on' ? 'yes' : 'no';

            //            $data['education_is_current'] = (isset($data['education_is_current']) ? $data['education_is_current'] : '') == 'on' ? 'yes' : 'no';
            //            $data['experience_is_current'] = (isset($data['experience_is_current']) ? $data['experience_is_current'] : '') == 'on' ? 'yes' : 'no';

            $data['created_by'] = Auth::user()->id;
//            dd($data);
            if ($candidate = $this->candidate->create($data)) {
                if (isset($data['job_types'])) {
                    foreach ($data['job_types'] as $jt) {
                        $candidate->job_types()->attach($jt);
                    }
                }
                if (isset($data['location_id'])) {
                    foreach ($data['location_id'] as $lo) {
                        $candidate->preferred_locations()->attach($lo);
                    }
                }
                if (isset($data['skill_id'])) {
                    foreach ($data['skill_id'] as $sk) {
                        $candidate->known_skills()->attach($sk);
                    }
                }
                if (isset($data['qualification_level'])) {
                    $this->createEducations($candidate, $data);
                }
                if (isset($data['experience_job_title'])) {
                    $this->createExperiences($candidate, $data);
                }
                if (isset($data['training_name'])) {
                    $this->createTrainings($candidate, $data);
                }
                if (isset($data['reference_name'])) {
                    $this->createReferences($candidate, $data);
                }
                if (isset($data['language_name'])) {
                    $this->createLanguages($candidate, $data);
                }
                if (isset($data['social_media_key'])) {
                    $this->createSocialMedias($candidate, $data);
                }
            }

            return $candidate;

        } catch (Exception $e) {
            return null;
        }
    }

    public function createContactDetails($candidate, array $data)
    {
        foreach ($data['detail_key'] as $key => $value) {
            $contact_detail = new $this->contactDetail([
                'ref_id' => getRandomInt(),
                'detail_key' => $value,
                'detail_value' => $data['detail_value'][$key]
            ]);
            $candidate->contact_details()->save($contact_detail);
        }
    }

    public function createEducations($candidate, array $data)
    {
        foreach ($data['qualification_level'] as $key => $value) {
            if (!empty($value)) {
                $educationDetails[] = new $this->education([
                    'ref_id' => getRandomInt(),
                    'qualification_level' => $value,
                    'program_name' => $data['program_name'][$key],
                    'education_board_id' => $data['education_board'][$key],
                    'institute_name' => $data['institute_name'][$key],
                    'passing_year' => $data['passing_year'][$key],
                    'is_current' => $data['education_is_current'][$key] ?? 'no',
                    'marks_obtained' => $data['marks_obtained'][$key],
                    'marks_type' => $data['marks_type'][$key]
                ]);
                $candidateEducations = $candidate->education()->saveMany($educationDetails);
            }
        }
    }

    public
    function createExperiences($candidate, array $data)
    {
        foreach ($data['experience_job_title'] as $key => $value) {
            if (!empty($value)) {
                $experienceDetails[] = new $this->experience([
                    'ref_id' => getRandomInt(),
                    'job_title' => $value,
                    'company_name' => $data['company_name'][$key],
                    'description' => $data['experience_description'][$key],
                    'location_id' => $data['experience_location_id'][$key],
                    'company_category_id' => $data['company_category_id'][$key],
                    'candidate_category_id' => $data['candidate_category_id'][$key],
                    'job_level_id' => $data['experience_job_level_id'][$key],
                    'is_current' => $data['experience_is_current'][$key] ?? 'no',
                    'start_date' => $data['experience_start_date'][$key],
                    'end_date' => $data['experience_end_date'][$key]
                ]);
                $candidateExperiences = $candidate->experience()->saveMany($experienceDetails);
            }
        }
    }

    public
    function createTrainings($candidate, array $data)
    {
        foreach ($data['training_name'] as $key => $value) {
            if (!empty($value)) {
                $trainingDetails[] = new $this->training([
                    'ref_id' => getRandomInt(),
                    'name' => $value,
                    'agency_name' => $data['training_agency_name'][$key],
                    'start_date' => $data['training_start_date'][$key],
                    'end_date' => $data['training_end_date'][$key]
                ]);
                $candidateTrainings = $candidate->training()->saveMany($trainingDetails);
            }
        }
    }

    public
    function createReferences($candidate, array $data)
    {
        foreach ($data['reference_name'] as $key => $value) {
            if (!empty($value)) {
                $referenceDetails[] = new $this->reference([
                    'ref_id' => getRandomInt(),
                    'name' => $value,
                    'designation' => $data['reference_designation'][$key],
                    'company_name' => $data['reference_company_name'][$key],
                    'phone' => $data['reference_phone'][$key],
                    'phone2' => $data['reference_phone2'][$key],
                    'email' => $data['reference_email'][$key]
                ]);
                $candidateReferences = $candidate->reference()->saveMany($referenceDetails);
            }
        }
    }

    public
    function createLanguages($candidate, array $data)
    {
        foreach ($data['language_name'] as $key => $value) {
            if (!empty($value)) {
                $languageDetails[] = new $this->language([
                    'ref_id' => getRandomInt(),
                    'name' => $value,
                    'reading' => $data['language_reading'][$key],
                    'writing' => $data['language_writing'][$key],
                    'speaking' => $data['language_speaking'][$key],
                    'listening' => $data['language_listening'][$key]
                ]);
                $candidateLanguages = $candidate->language()->saveMany($languageDetails);
            }
        }
    }


    public
    function createSocialMedias($candidate, array $data)
    {
        foreach ($data['social_media_key'] as $key => $value) {
            if (!empty($value)) {
                $social_media = new $this->socialMedia([
                    'ref_id' => getRandomInt(),
                    'media_key' => $value,
                    'media_value' => $data['social_media_value'][$key]
                ]);
                $candidate->social_medias()->save($social_media);
            }
        }
    }

    public
    function update($candidateId, array $data)
    {

        try {
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['is_verified'] = (isset($data['is_verified']) ? $data['is_verified'] : '') == 'on' ? 'yes' : 'no';
            $data['travel_outside'] = (isset($data['travel_outside']) ? $data['travel_outside'] : '') == 'on' ? 'yes' : 'no';
            $data['relocate_location'] = (isset($data['relocate_location']) ? $data['relocate_location'] : '') == 'on' ? 'yes' : 'no';
            $data['two_wheeler_license'] = (isset($data['two_wheeler_license']) ? $data['two_wheeler_license'] : '') == 'on' ? 'yes' : 'no';
            $data['four_wheeler_license'] = (isset($data['four_wheeler_license']) ? $data['four_wheeler_license'] : '') == 'on' ? 'yes' : 'no';
            $data['two_wheeler_vehicle'] = (isset($data['two_wheeler_vehicle']) ? $data['two_wheeler_vehicle'] : '') == 'on' ? 'yes' : 'no';
            $data['four_wheeler_vehicle'] = (isset($data['four_wheeler_vehicle']) ? $data['four_wheeler_vehicle'] : '') == 'on' ? 'yes' : 'no';
            $data['last_updated_by'] = Auth::user()->id;
            $candidate = $this->candidate->find($candidateId);
            $candidateUpdate = $candidate->update($data);
            if ($candidateUpdate) {
                if (isset($data['job_types'])) {
                    $candidate->job_types()->sync($data['job_types']);
                }
                if (isset($data['location_id'])) {
                    $candidate->preferred_locations()->sync($data['location_id']);
                }
                if (isset($data['skill_id'])) {
                    $candidate->known_skills()->sync($data['skill_id']);
                }

                //for Educations
                if (isset($data['educations_ref_id'])) {
                    for ($i = 0; $i < count($data['educations_ref_id']); $i++) {
                        $education = $this->education->whereRefId($data['educations_ref_id'][$i])->first();
                        $educationData = [
                            'qualification_level' => $data['qualification_level'][$i],
                            'program_name' => $data['program_name'][$i],
                            'education_board_id' => $data['education_board'][$i],
                            'institute_name' => $data['institute_name'][$i],
                            'passing_year' => $data['passing_year'][$i],
                            'is_current' => $data['education_is_current'][$i] ?? 'no',
                            'marks_obtained' => $data['marks_obtained'][$i],
                            'marks_type' => $data['marks_type'][$i]
                        ];
                        $education->update($educationData);
                        unset($data['qualification_level'][$i]);
                        unset($data['program_name'][$i]);
                        unset($data['institute_name'][$i]);
                        unset($data['passing_year'][$i]);
                        unset($data['education_is_current'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (isset($data['qualification_level']) && !empty($data['qualification_level'])) {
                    $this->createEducations($candidate, $data);
                }

                //for Experience
                if (isset($data['experiences_ref_id'])) {
                    for ($i = 0; $i < count($data['experiences_ref_id']); $i++) {
                        $experience = $this->experience->whereRefId($data['experiences_ref_id'][$i])->first();
                        $experienceData = [
                            'job_title' => $data['experience_job_title'][$i],
                            'company_name' => $data['company_name'][$i],
                            'description' => $data['experience_description'][$i],
                            'location_id' => $data['experience_location_id'][$i],
                            'company_category_id' => $data['company_category_id'][$i],
                            'candidate_category_id' => $data['candidate_category_id'][$i],
                            'job_level_id' => $data['experience_job_level_id'][$i],
                            'is_current' => $data['experience_is_current'][$i] ?? 'no',
                            'start_date' => $data['experience_start_date'][$i],
                            'end_date' => $data['experience_end_date'][$i]
                        ];
                        $experience->update($experienceData);
                        unset($data['experience_job_title'][$i]);
                        unset($data['company_name'][$i]);
                        unset($data['experience_description'][$i]);
                        unset($data['experience_location_id'][$i]);
                        unset($data['company_category_id'][$i]);
                        unset($data['candidate_category_id'][$i]);
                        unset($data['experience_job_level_id'][$i]);
                        unset($data['experience_is_current'][$i]);
                        unset($data['experience_start_date'][$i]);
                        unset($data['experience_end_date'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (isset($data['company_name']) && !empty($data['company_name'])) {
                    $this->createExperiences($candidate, $data);
                }

                //for Trainings
                if (isset($data['trainings_ref_id'])) {
                    for ($i = 0; $i < count($data['trainings_ref_id']); $i++) {
                        $training = $this->training->whereRefId($data['trainings_ref_id'][$i])->first();
                        $trainingData = [
                            'name' => $data['training_name'][$i],
                            'agency_name' => $data['training_agency_name'][$i],
                            'start_date' => $data['training_start_date'][$i],
                            'end_date' => $data['training_end_date'][$i]
                        ];
                        $training->update($trainingData);
                        unset($data['training_name'][$i]);
                        unset($data['training_agency_name'][$i]);
                        unset($data['training_start_date'][$i]);
                        unset($data['training_end_date'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (isset($data['training_name']) && !empty($data['training_name'])) {
                    $this->createTrainings($candidate, $data);
                }

                //for References
                if (isset($data['references_ref_id'])) {
                    for ($i = 0; $i < count($data['references_ref_id']); $i++) {
                        $reference = $this->reference->whereRefId($data['references_ref_id'][$i])->first();
                        $referenceData = [
                            'name' => $data['reference_name'][$i],
                            'designation' => $data['reference_designation'][$i],
                            'company_name' => $data['reference_company_name'][$i],
                            'phone' => $data['reference_phone'][$i],
                            'phone2' => $data['reference_phone2'][$i],
                            'email' => $data['reference_email'][$i]
                        ];
                        $reference->update($referenceData);
                        unset($data['reference_name'][$i]);
                        unset($data['reference_designation'][$i]);
                        unset($data['reference_company_name'][$i]);
                        unset($data['reference_phone'][$i]);
                        unset($data['reference_phone2'][$i]);
                        unset($data['reference_email'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (isset($data['reference_name']) && !empty($data['reference_name'])) {
                    $this->createReferences($candidate, $data);
                }

                //for Languages
                if (isset($data['languages_ref_id'])) {
                    for ($i = 0; $i < count($data['languages_ref_id']); $i++) {
                        $language = $this->language->whereRefId($data['languages_ref_id'][$i])->first();
                        $languageData = [
                            'name' => $data['language_name'][$i],
                            'reading' => $data['language_reading'][$i],
                            'writing' => $data['language_writing'][$i],
                            'speaking' => $data['language_speaking'][$i],
                            'listening' => $data['language_listening'][$i]
                        ];
                        $language->update($languageData);
                        unset($data['language_name'][$i]);
                        unset($data['language_reading'][$i]);
                        unset($data['language_writing'][$i]);
                        unset($data['language_speaking'][$i]);
                        unset($data['language_listening'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (isset($data['language_name']) && !empty($data['language_name'])) {
                    $this->createLanguages($candidate, $data);
                }

                //for Social Accounts
                if (isset($data['social_medias_ref_id'])) {
                    for ($i = 0; $i < count($data['social_medias_ref_id']); $i++) {
                        $socialMedia = $this->socialMedia->whereRefId($data['social_medias_ref_id'][$i])->first();
                        $socialMediaData = [
                            'media_key' => $data['social_media_key'][$i],
                            'media_value' => $data['social_media_value'][$i]
                        ];
                        $socialMedia->update($socialMediaData);
                        unset($data['social_media_key'][$i]);
                        unset($data['social_media_value'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (isset($data['social_media_key']) && !empty($data['social_media_key'])) {
                    $this->createSocialMedias($candidate, $data);
                }
            }

            //$this->logger->info(' created successfully', $data);

            return $candidate;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public
    function updateJobPreference($candidate, array $data)
    {
        try {
            $candidate = $this->findByRefId($candidate);

            if ($candidate->update($data)) {
                if (isset($data['job_types'])) {
                    foreach ($data['job_types'] as $jt) {
                        $candidate->job_types()->sync($jt);
                    }
                }
                if (isset($data['location_id'])) {
                    $candidate->preferred_locations()->sync($data['location_id']);
                }
                if (isset($data['skill_id'])) {
                    $candidate->known_skills()->sync($data['skill_id']);
                }
            }

            return $candidate;


        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeOthers($candidate, array $data)
    {
        try {
            $data['travel_outside'] = (isset($data['travel_outside']) ? $data['travel_outside'] : '') == 'on' ? 'yes' : 'no';
            $data['relocate_location'] = (isset($data['relocate_location']) ? $data['relocate_location'] : '') == 'on' ? 'yes' : 'no';
            $data['two_wheeler_license'] = (isset($data['two_wheeler_license']) ? $data['two_wheeler_license'] : '') == 'on' ? 'yes' : 'no';
            $data['four_wheeler_license'] = (isset($data['four_wheeler_license']) ? $data['four_wheeler_license'] : '') == 'on' ? 'yes' : 'no';
            $data['two_wheeler_vehicle'] = (isset($data['two_wheeler_vehicle']) ? $data['two_wheeler_vehicle'] : '') == 'on' ? 'yes' : 'no';
            $data['four_wheeler_vehicle'] = (isset($data['four_wheeler_vehicle']) ? $data['four_wheeler_vehicle'] : '') == 'on' ? 'yes' : 'no';

            $candidate = $this->candidate->whereRefId($candidate)->first();

            $candidate->update($data);


            return $candidate;


        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storePrivacy($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();
            unset($data['_token']);
            $privacy = '';

            if (isset($data['control_ref_id'])) {
                foreach ($data['control_ref_id'] as $key => $value) {
                    $privacy = $this->privacy->whereRefId($value)->first();
                    $privacyData = [
                        'control_value' => $data[$privacy->control_key]
                    ];
                    $privacy->update($privacyData);
                }
            } else {
                foreach ($data as $key => $value) {
                    $privacy = new $this->privacy([
                        'ref_id' => getRandomInt(),
                        'control_key' => $key,
                        'control_value' => $value
                    ]);
                    $candidate->privacyControl()->save($privacy);
                }
            }

            return $candidate;

        } catch (Exception $e) {
            return null;
        }
    }

    public
    function getContactDetails($candidate)
    {
        return $candidate->contact_details()->get();
    }

    public
    function getEducations($candidate)
    {
        return $candidate->education()->get();
    }

    public
    function getExperiences($candidate)
    {
        return $candidate->experience()->get();
    }

    public
    function getTrainings($candidate)
    {
        return $candidate->training()->get();
    }

    public
    function getReferences($candidate)
    {
        return $candidate->reference()->get();
    }

    public
    function getLanguages($candidate)
    {
        return $candidate->language()->get();
    }

    public
    function getSocialMedias($candidate)
    {
        return $candidate->social_medias()->get();
    }

    public
    function getPrivacyControls($candidate)
    {
        return $candidate->privacyControl()->get()->toArray();
    }

    public
    function storeBasicInfo($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

//            $basicData['nationality'] = $data['nationality'];
//            $basicData['gender'] = $data['gender'];
//            $basicData['birth_date'] = $data['birth_date'];
//            $basicData['marital_status'] = $data['marital_status'];
//            $basicData['religion'] = $data['religion'];
//            $basicData['current_address'] = $data['current_address'];
//            $basicData['permanent_address'] = $data['permanent_address'];

            if ($candidate->update($data)) {
                if (isset($data['contact_detail_ref_id'])) {
                    for ($i = 0; $i < count($data['contact_detail_ref_id']); $i++) {
                        $contactDetail = $this->contactDetail->whereRefId($data['contact_detail_ref_id'][$i])->first();

                        $contactDetailData = [
                            'detail_key' => $data['detail_key'][$i],
                            'detail_value' => $data['detail_value'][$i]
                        ];
                        $contactDetail->update($contactDetailData);

                        unset($data['detail_key'][$i]);
                        unset($data['detail_value'][$i]);
                    }
                    if (!empty(['detail_key'])) {
                        $this->createContactDetails($candidate, $data);

                    }
                } else {
                    if (isset($data['detail_key'])) {
                        foreach ($data['detail_key'] as $key => $value) {
                            $contact_detail = new $this->contactDetail([
                                'ref_id' => getRandomInt(),
                                'detail_key' => $value,
                                'detail_value' => $data['detail_value'][$key]
                            ]);
                            $candidate->contact_details()->save($contact_detail);
                        }
                    }
                }
                //                if (isset($data['resume']))
                //                {
                //                    $this->uploadAvatarFile($data['resume'], $candidate);
                //                }

                if (isset($data['avatar'])) {
                    $this->uploadAvatarFile($data['avatar'], $candidate);
                }

                if (isset($data['first_name'])) {
                    $this->user->where('id', $candidate->user_id)->update(
                        [
                            'first_name' => $data['first_name'],
                            'middle_name' => $data['middle_name'],
                            'last_name' => $data['last_name']
                        ]
                    );
                }

            }

            return $candidate;

        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeEducation($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

            if (isset($data['educations_ref_id'])) {
                for ($i = 0; $i < count($data['educations_ref_id']); $i++) {
                    $education = $this->education->whereRefId($data['educations_ref_id'][$i])->first();

                    $educationData = [
                        'qualification_level' => $data['qualification_level'][$i],
                        'program_name' => $data['program_name'][$i],
                        'education_board_id' => $data['education_board'][$i],
                        'institute_name' => $data['institute_name'][$i],
                        'passing_year' => $data['passing_year'][$i],
                        'is_current' => $data['education_is_current'][$i] ?? 'no',
                        'marks_obtained' => $data['marks_obtained'][$i],
                        'marks_type' => $data['marks_type'][$i]
                    ];

                    $education->update($educationData);

                    unset($data['qualification_level'][$i]);
                    unset($data['program_name'][$i]);
                    unset($data['institute_name'][$i]);
                    unset($data['passing_year'][$i]);
                    unset($data['education_is_current'][$i]);

                }
                //if extra fields are added on edit
                if (!empty(['qualification_level'])) {

                    $this->createEducations($candidate, $data);

                }

            } else {
                foreach ($data['qualification_level'] as $key => $value) {

                    $educationDetails[] = new $this->education([
                        'ref_id' => getRandomInt(),
                        'qualification_level' => $value,
                        'program_name' => $data['program_name'][$key],
                        'education_board_id' => $data['education_board'][$key],
                        'institute_name' => $data['institute_name'][$key],
                        'passing_year' => $data['passing_year'][$key],
                        'is_current' => $data['education_is_current'][$key] ?? 'no',
                        'marks_obtained' => $data['marks_obtained'][$key],
                        'marks_type' => $data['marks_type'][$key]
                    ]);

                    $candidate->education()->saveMany($educationDetails);
                }
            }

            return $candidate;

        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeTraining($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

            if (isset($data['trainings_ref_id'])) {
                for ($i = 0; $i < count($data['trainings_ref_id']); $i++) {
                    $training = $this->training->whereRefId($data['trainings_ref_id'][$i])->first();
                    $trainingData = [
                        'name' => $data['training_name'][$i],
                        'agency_name' => $data['training_agency_name'][$i],
                        'start_date' => $data['training_start_date'][$i],
                        'end_date' => $data['training_end_date'][$i]
                    ];

                    $training->update($trainingData);

                    unset($data['training_name'][$i]);
                    unset($data['training_agency_name'][$i]);
                    unset($data['training_start_date'][$i]);
                    unset($data['training_end_date'][$i]);

                }
                //if extra fields are added on edit
                if (!empty(['training_name'])) {
                    $this->createTrainings($candidate, $data);
                }

            } else {
                foreach ($data['training_name'] as $key => $value) {
                    $trainingDetails[] = new $this->training([
                        'ref_id' => getRandomInt(),
                        'name' => $value,
                        'agency_name' => $data['training_agency_name'][$key],
                        'start_date' => $data['training_start_date'][$key],
                        'end_date' => $data['training_end_date'][$key]
                    ]);
                    $candidate->training()->saveMany($trainingDetails);
                }
            }

            return $candidate;

        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeExperience($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

            if (isset($data['experiences_ref_id'])) {
                for ($i = 0; $i < count($data['experiences_ref_id']); $i++) {
                    $experience = $this->experience->whereRefId($data['experiences_ref_id'][$i])->first();
                    $experienceData = [
                        'job_title' => $data['experience_job_title'][$i],
                        'company_name' => $data['company_name'][$i],
                        'description' => $data['experience_description'][$i],
                        'location_id' => $data['experience_location_id'][$i],
                        'company_category_id' => $data['company_category_id'][$i],
                        'candidate_category_id' => $data['candidate_category_id'][$i],
                        'job_level_id' => $data['experience_job_level_id'][$i],
                        'is_current' => $data['experience_is_current'][$i] ?? 'no',
                        'start_date' => $data['experience_start_date'][$i],
                        'end_date' => $data['experience_end_date'][$i]
                    ];
                    $dd = $experience->update($experienceData);

                    unset($data['experience_job_title'][$i]);
                    unset($data['company_name'][$i]);
                    unset($data['experience_description'][$i]);
                    unset($data['experience_location_id'][$i]);
                    unset($data['company_category_id'][$i]);
                    unset($data['candidate_category_id'][$i]);
                    unset($data['experience_job_level_id'][$i]);
                    unset($data['experience_is_current'][$i]);
                    unset($data['experience_start_date'][$i]);
                    unset($data['experience_end_date'][$i]);
                }
                //if extra fields are added on edit
                if (!empty(['company_name'])) {
                    $this->createExperiences($candidate, $data);
                }

            } else {
                foreach ($data['company_name'] as $key => $value) {
                    $experienceDetails[] = new $this->experience([
                        'ref_id' => getRandomInt(),
                        'company_name' => $value,
                        'job_title' => $data['experience_job_title'][$key],
                        'description' => $data['experience_description'][$key] ?? '',
                        'location_id' => $data['experience_location_id'][$key],
                        'company_category_id' => $data['company_category_id'][$key],
                        'candidate_category_id' => $data['candidate_category_id'][$key],
                        'job_level_id' => $data['experience_job_level_id'][$key],
                        'is_current' => $data['experience_is_current'][$key] ?? 'no',
                        'start_date' => $data['experience_start_date'][$key],
                        'end_date' => $data['experience_end_date'][$key]
                    ]);

                    $candidate->experience()->saveMany($experienceDetails);
                }
            }

            return $candidate;

        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeLanguage($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

            if (isset($data['languages_ref_id'])) {
                for ($i = 0; $i < count($data['languages_ref_id']); $i++) {
                    $language = $this->language->whereRefId($data['languages_ref_id'][$i])->first();
                    $languageData = [
                        'name' => $data['language_name'][$i],
                        'reading' => $data['language_reading'][$i],
                        'writing' => $data['language_writing'][$i],
                        'speaking' => $data['language_speaking'][$i],
                        'listening' => $data['language_listening'][$i]
                    ];

                    $language->update($languageData);

                    unset($data['language_name'][$i]);
                    unset($data['language_reading'][$i]);
                    unset($data['language_writing'][$i]);
                    unset($data['language_speaking'][$i]);
                    unset($data['language_listening'][$i]);
                }
                //if extra fields are added on edit
                if (!empty(['language_name'])) {
                    $this->createLanguages($candidate, $data);
                }

            } else {
                foreach ($data['language_name'] as $key => $value) {
                    $languageDetails[] = new $this->language([
                        'ref_id' => getRandomInt(),
                        'name' => $value,
                        'reading' => $data['language_reading'][$key],
                        'writing' => $data['language_writing'][$key],
                        'speaking' => $data['language_speaking'][$key],
                        'listening' => $data['language_listening'][$key]
                    ]);
                    $candidate->language()->saveMany($languageDetails);
                }
            }

            return $candidate;
        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeSocialMedia($candidate, array $data)
    {
        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

            if (isset($data['social_medias_ref_id'])) {
                for ($i = 0; $i < count($data['social_medias_ref_id']); $i++) {
                    $socialMedia = $this->socialMedia->whereRefId($data['social_medias_ref_id'][$i])->first();

                    $socialMediaData = [
                        'media_key' => $data['social_media_key'][$i],
                        'media_value' => $data['social_media_value'][$i]
                    ];
                    $socialMedia->update($socialMediaData);
                    unset($data['social_media_key'][$i]);
                    unset($data['social_media_value'][$i]);
                }
                //if extra fields are added on edit
                if (!empty(['social_media_key'])) {
                    $this->createSocialMedias($candidate, $data);
                }
            } else {
                //                $socialMedias = [ $data['media_key'] => $data['media_value'] ];
                foreach ($data['social_media_key'] as $key => $value) {
                    $social_media = new $this->socialMedia([
                        'ref_id' => getRandomInt(),
                        'media_key' => $value,
                        'media_value' => $data['social_media_value'][$key]
                    ]);
                    $candidate->social_medias()->save($social_media);
                }
            }

            return $candidate;
        } catch (Exception $e) {
            return null;
        }
    }

    public
    function storeReference($candidate, array $data)
    {

        try {
            $candidate = $this->candidate->whereRefId($candidate)->first();

            if (isset($data['references_ref_id'])) {

                for ($i = 0; $i < count($data['references_ref_id']); $i++) {
                    $reference = $this->reference->whereRefId($data['references_ref_id'][$i])->first();

                    $referenceData = [
                        'name' => $data['reference_name'][$i],
                        'designation' => $data['reference_designation'][$i],
                        'company_name' => $data['reference_company_name'][$i],
                        'phone' => $data['reference_phone'][$i],
                        'phone2' => $data['reference_phone2'][$i],
                        'email' => $data['reference_email'][$i]
                    ];

                    $reference->update($referenceData);

                    unset($data['reference_name'][$i]);
                    unset($data['reference_designation'][$i]);
                    unset($data['reference_company_name'][$i]);
                    unset($data['reference_phone'][$i]);
                    unset($data['reference_phone2'][$i]);
                    unset($data['reference_email'][$i]);
                }
                //if extra fields are added on edit
                if (!empty(['reference_name'])) {
                    $this->createReferences($candidate, $data);
                }
            } else {
                foreach ($data['reference_name'] as $key => $value) {
                    $referenceDetails[] = new $this->reference([
                        'ref_id' => getRandomInt(),
                        'name' => $value,
                        'designation' => $data['reference_designation'][$key],
                        'company_name' => $data['reference_company_name'][$key],
                        'phone' => $data['reference_phone'][$key],
                        'phone2' => $data['reference_phone2'][$key],
                        'email' => $data['reference_email'][$key]
                    ]);
                    $candidate->reference()->saveMany($referenceDetails);
                }
            }

            //            $referenceDetails[]  = new $this->reference([
            //                'name'         => $data['name'],
            //                'designation'  => $data['designation'],
            //                'company_name' => $data['company_name'],
            //                'phone'        => $data['phone'],
            //                'phone2'       => $data['phone2'],
            //                'email'        => $data['email']
            //            ]);
            //            $candidateReferences = $candidate->reference()->saveMany($referenceDetails);

            return $candidate;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Paginate all User
     *
     * @param array $filter
     * @return Collection
     */
    public
    function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->candidate->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public
    function all($limit = null)
    {
        if ($limit) {
            return $this->candidate->whereIsDeleted('no')->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->paginate(30);
        } else {
            return $this->candidate->whereIsDeleted('no')->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->get();
        }
    }

    public
    function getByCountry($country)
    {
        if ($country == 'nepal') {
            $country = $this->jobCountry->whereSlug('nepal')->first();
            return $this->candidate->whereStatus('active')->whereIsDeleted('no')->whereJobCountryId($country->id)->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->paginate(30);
        } else {
            $country = $this->jobCountry->whereSlug('nepal')->first();
            return $this->candidate->whereStatus('active')->whereIsDeleted('no')->orderBy('order', 'ASC')->whereAvailability('available')->whereIsVerified('yes')->whereNotIn('job_country_id', [$country->id])->paginate(30);
        }
    }

    public
    function getCandidateBySearch($searchCategory, $searchKeyword)
    {
        $regNo = '';
        $candidateRejects = [];
        if (Auth::user() && Auth::user()->hasRole(['ROLE_COMPANY'])) {
            $regNo = auth()->user()->company->company_reg_no;
            $candidateRejects = PrivacyControl::where('control_key','company_pan')->where('control_value',$regNo)->pluck('controlable_id');
        }

        $category = $this->category->findBySlug($searchCategory);
        if ($searchCategory && empty($searchKeyword)) {
            return $this->candidate->whereStatus('active')
                ->whereIsDeleted('no')
                ->whereAvailability('available')
                ->whereCategoryId($category->id)
                ->whereIsVerified('yes')
                ->orderBy('order', 'ASC')
                ->whereNotIn('id',$candidateRejects)
                ->paginate(30);
        } elseif ($searchCategory && $searchKeyword) {
            return $this->candidate->whereStatus('active')
                ->whereIsDeleted('no')
                ->whereAvailability('available')
                ->whereIsVerified('yes')
                ->whereCategoryId($category->id)
                ->whereNotIn('id',$candidateRejects)
                ->orderBy('order', 'ASC')
                ->where(function ($query) use ($searchKeyword) {
                    $query->where('description', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('interest', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('specialization', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('current_address', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('permanent_address', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('nationality', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('marital_status', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('religion', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('keywords', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('availability', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('experience_period', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('exp_salary_amount', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('cur_salary_amount', 'LIKE', '%' . $searchKeyword . '%')
                        ->orWhere('gender', strtolower($searchKeyword))
                        ->orWhereHas('job_level', function ($q) use ($searchKeyword) {
                            $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                        })
                        ->orWhereHas('job_country', function ($q) use ($searchKeyword) {
                            $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                        })
                        ->orWhereHas('education', function ($q) use ($searchKeyword) {
                            $q->where('qualification_level', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('program_name', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('institute_name', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('passing_year', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('marks_obtained', 'LIKE', '%' . $searchKeyword . '%');
                        })
                        ->orWhereHas('experience', function ($q) use ($searchKeyword) {
                            $q->where('job_title', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('company_name', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhereHas('location', function ($q) use ($searchKeyword) {
                                    $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                                })
                                ->orWhereHas('company_category', function ($q) use ($searchKeyword) {
                                    $q->where('name', 'LIKE', '%' . $searchKeyword . '%');
                                })
                                ->orWhereHas('candidate_category', function ($q) use ($searchKeyword) {
                                    $q->where('name', 'LIKE', '%' . $searchKeyword . '%');
                                })
                                ->orWhereHas('job_level', function ($q) use ($searchKeyword) {
                                    $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                                });
                        })
                        ->orWhereHas('training', function ($q) use ($searchKeyword) {
                            $q->where('name', 'LIKE', '%' . $searchKeyword . '%')
                                ->orWhere('agency_name', 'LIKE', '%' . $searchKeyword . '%');
                        })
                        ->orWhereHas('language', function ($q) use ($searchKeyword) {
                            $q->where('name', 'LIKE', '%' . $searchKeyword . '%');
                        })
                        ->orWhereHas('preferred_locations', function ($q) use ($searchKeyword) {
                            $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                        })
                        ->orWhereHas('known_skills', function ($q) use ($searchKeyword) {
                            $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                        });
                })->paginate(30);
        } else {
            if (is_null($searchKeyword)) {
                return $this->candidate->whereStatus('active')
                    ->whereIsDeleted('no')
                    ->whereIsVerified('yes')
                    ->whereAvailability('available')
                    ->orderBy('order', 'ASC')
                    ->whereNotIn('id',$candidateRejects)
                    ->paginate(30);
            } else {
                return $this->candidate->whereStatus('active')
                    ->whereIsDeleted('no')
                    ->whereAvailability('available')
                    ->whereIsVerified('yes')
                    ->orderBy('order', 'ASC')
                    ->whereNotIn('id',$candidateRejects)
                    ->where(function ($query) use ($searchKeyword) {
                        $query->where('description', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('interest', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('specialization', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('current_address', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('permanent_address', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('nationality', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('marital_status', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('religion', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('keywords', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('availability', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('experience_period', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('exp_salary_amount', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('cur_salary_amount', 'LIKE', '%' . $searchKeyword . '%')
                            ->orWhere('gender', strtolower($searchKeyword))
                            ->orWhereHas('job_level', function ($q) use ($searchKeyword) {
                                $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                            })
                            ->orWhereHas('job_country', function ($q) use ($searchKeyword) {
                                $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                            })
                            ->orWhereHas('education', function ($q) use ($searchKeyword) {
                                $q->where('qualification_level', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('program_name', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('institute_name', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('passing_year', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('marks_obtained', 'LIKE', '%' . $searchKeyword . '%');
                            })
                            ->orWhereHas('experience', function ($q) use ($searchKeyword) {
                                $q->where('job_title', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('company_name', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('description', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhereHas('location', function ($q) use ($searchKeyword) {
                                        $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                                    })
                                    ->orWhereHas('company_category', function ($q) use ($searchKeyword) {
                                        $q->where('name', 'LIKE', '%' . $searchKeyword . '%');
                                    })
                                    ->orWhereHas('candidate_category', function ($q) use ($searchKeyword) {
                                        $q->where('name', 'LIKE', '%' . $searchKeyword . '%');
                                    })
                                    ->orWhereHas('job_level', function ($q) use ($searchKeyword) {
                                        $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                                    });
                            })
                            ->orWhereHas('training', function ($q) use ($searchKeyword) {
                                $q->where('name', 'LIKE', '%' . $searchKeyword . '%')
                                    ->orWhere('agency_name', 'LIKE', '%' . $searchKeyword . '%');
                            })
                            ->orWhereHas('language', function ($q) use ($searchKeyword) {
                                $q->where('name', 'LIKE', '%' . $searchKeyword . '%');
                            })
                            ->orWhereHas('preferred_locations', function ($q) use ($searchKeyword) {
                                $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                            })
                            ->orWhereHas('known_skills', function ($q) use ($searchKeyword) {
                                $q->where('title', 'LIKE', '%' . $searchKeyword . '%');
                            });
                    })->paginate(30);
            }
        }
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public
    function find($candidateId)
    {
        try {
            return $this->candidate->whereIsDeleted('no')->find($candidateId);
        } catch (Exception $e) {
            return null;
        }
    }


    public
    function findByRefId($candidateId)
    {
        try {
            return $this->candidate->whereIsDeleted('no')->whereRefId($candidateId)->first();
        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Delete a User
     *
     * @param Id
     * @return bool
     */
    public
    function delete($candidateId)
    {
        try {

            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at'] = Carbon::now();
            $candidate = $this->candidate->find($candidateId);
            $data['is_deleted'] = 'yes';

            return $candidate = $candidate->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public
    function getByName($name)
    {
        return $this->candidate->whereIsDeleted('no')->whereName($name);
    }

    public
    function getBySlug($slug)
    {
        return $this->candidate->whereIsDeleted('no')->whereSlug($slug)->first();
    }

    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/candidate/resume';

            return $fileName = $this->uploadFromAjax($file);
        }
    }

    function uploadAvatar($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/user';

            return $fileName = $this->uploadFromAjax($file);
        }
    }

    public
    function __deleteImages($subCat)
    {
        try {
            if (is_file($subCat->image_path)) {
                unlink($subCat->image_path);
            }

            if (is_file($subCat->thumbnail_path)) {
                unlink($subCat->thumbnail_path);
            }
        } catch (\Exception $e) {

        }
    }

    public
    function updateImage($candidateId, array $data)
    {
        try {
            $candidate = $this->candidate->find($candidateId);
            $candidate = $candidate->update($data);

            return $candidate;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public
    function updateFrontResume($candidateRefId, array $data)
    {

        try {
            $candidate = $this->findByRefId($candidateRefId);
            $candidate = $candidate->update($data);

            return $candidate;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    function uploadAvatarFile($data, $candidate)
    {
        try {
            $file = $data;
            $fileName = $this->uploadAvatar($file);
            if (!empty($candidate->user)) {
                $user = $candidate->user->update(['avatar' => $fileName]);

                return $user;
            }

        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }

    }

    /*
     *
     * Get Clone Fields for Admin Panel
     *
     * */


//Education Form form
    public
    function getFrontContactDetailsFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput contactDetails" id="' . $varId . '">
            <div id="clonedInput">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contact Type*</label>
                            <select id="jb-level" class="form-control jb-minimal" name="detail_key[]">
                                <option value="mobile">Mobile</option>
                                <option value="home">Home</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" placeholder="Contact Number"
                                   name="detail_value[]"
                                   data-rule-url="true"
                                   value=""/>
                        </div>
                    </div>
                   <div class="form-group mrg-top-30">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }


    public
    function getEducationFields($fieldName, $divId)
    {
        $educationBoards = '';
        foreach ($this->educationBoard->getEducationBoardAdmin() as $board) {
            $educationBoards .= '<option value="' . $board->id . '">' . $board->title . '</option>';
        }
        $varId = $fieldName . $divId;

        $data = '
        <div class="clonedInput' . $fieldName . '" id="' . $varId . '">

            <div id="clonedInput">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select name="qualification_level[]" class="form-control"
                                    data-placeholder="Education Level">
                                    <option value="">Select the degree achieved</option>
                                <option
                                    value="phd">
                                    Ph.D.
                                </option>
                                <option
                                    value="master">
                                    Masters
                                </option>
                                <option
                                    value="diploma">
                                    Diploma
                                </option>
                                <option
                                    value="bachelor">
                                    Bachelor
                                </option>
                                <option
                                    value="intermediate">
                                    Intermediate
                                </option>
                                <option
                                    value="slc">
                                    SLC/SEE
                                </option>
                                <option
                                    value="other">
                                    Other
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input type="text" name="program_name[]" class="form-control" id="number2" placeholder="Enter the program name eg: BBA in case of SEE enter school"
                                   value=""/>
                            <label for="KeyWords">Education Program Name</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <select name="education_board[]" class="form-control select2-list"
                                data-placeholder="Education Board">
                                <option value="">Select education board of study</option>
                           ' . $educationBoards . '
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" name="institute_name[]" class="form-control" placeholder="Enter name of the institute/college"
                               value=""/>
                        <label for="Name">Institution Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class="checkbox checkbox-styled">
                            <label>
                                <input type="checkbox" name="education_is_current[]" value="yes" class="ifCheck" data-hide=".educationToggle' . $varId . '"/>
                                <span>Are you studying now?</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="educationToggle' . $varId . '">
                <div class="col-sm-4">
                    <div class="form-group control-width-normal">
                        <div class="input-group date" id="demo-date">
                            <div class="input-group-content">
                                <input type="text" name="passing_year[]" class="form-control" placeholder="YYYY" onkeydown="return false"
                                       value="">
                                <label>Graduation Year</label>
                            </div>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" name="marks_obtained[]" class="form-control" placeholder="Marks Secured"
                               value=""/>
                        <label for="Name">Marks Secured</label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <select name="marks_type[]" class="form-control"
                                data-placeholder="Education Board">
                                <option value="">Select Marks Type</option>
                            <option
                                value="cgpa">
                                CGPA
                            </option>
                            <option
                                value="percent">
                                %
                            </option>
                        </select>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

    public
    function getFrontEducationFields($fieldName, $divId)
    {
        $educationBoards = '';
        foreach ($this->educationBoard->getEducationBoardAdmin() as $board) {
            $educationBoards .= '<option value="' . $board->id . '">' . $board->title . '</option>';
        }
        $varId = $fieldName . $divId;
        $data = '
         <div class="clonedInput educations" id="' . $varId . '">
            <div id="clonedInput">
            <hr>
                <div class="row">
                  <div class="col-md-1" style="float: right;">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Degree*</label>
                                <select class="form-control input-lg jb-minimal" name="qualification_level[]" required>
                                <option value="">Select the degree achieved</option>
                                    <option
                                        value="phd">
                                        Ph.D.
                                    </option>
                                    <option
                                        value="master">
                                        Masters
                                    </option>
                                    <option
                                        value="diploma">
                                        Diploma
                                    </option>
                                    <option
                                        value="bachelor">
                                        Bachelor
                                    </option>
                                    <option
                                        value="intermediate">
                                        Intermediate
                                    </option>
                                    <option
                                        value="slc">
                                        SLC/SEE
                                    </option>
                                    <option
                                        value="other">
                                        Other
                                    </option>
                                </select>
                            </div>
                        </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Education Program*</label>
                            <input type="text" name="program_name[]" class="form-control" placeholder="Enter the program name eg: BBA in case of SEE enter school" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                          <div class="form-group">
                               <label>Education Board*</label>
                                <select class="form-control input-lg jb-minimal" name="education_board[]" required>
                                <option value="">Select education board of study</option>
                                    ' . $educationBoards . '
                                </select>
                          </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                       <div class="form-group">
                          <label>Name of Institute*</label>
                              <input type="text" class="form-control" name="institute_name[]" placeholder="Enter name of the institute/college"/>
                       </div>
                    </div>
                </div>
                <div class="row">
                 <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <div class="checkbox checkbox-styled">
                                <label>
                                    <input type="checkbox" name="education_is_current[]" value="yes" class="ifCheck" data-hide=".educationToggle' . $varId . '"/>
                                    <span>Are you studying now?</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="educationToggle' . $varId . '">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Graduation Year</label>
                                <input type="year" class="form-control graduation_year" name="passing_year[]" placeholder="YYYY" onkeydown="return false"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label>Marks Secured</label>
                                <input type="text" name="marks_obtained[]" class="form-control" placeholder="Marks Secured"
                                   value="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <div class="form-group" style="margin-top: 6px;">
                                    <label></label>
                                    <select name="marks_type[]" class="form-control jb-minimal">
                                    <option value="">Select Marks Type</option>
                                        <option
                                        value="cgpa">
                                            CGPA
                                        </option>
                                        <option
                                        value="percent">
                                             %
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div
        ';

        return json_encode($data);
    }

//Experience Form Fields

    public
    function getExperienceFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $companyCategories = '';
        foreach ($this->category->getCompanyCategories() as $category) {
            $companyCategories .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        $jobLocation = '';
        foreach ($this->jobLocation->getJobLocationAdmin() as $location) {
            $jobLocation .= '<option value="' . $location->id . '">' . $location->title . '</option>';
        }
        $jobLevel = '';
        foreach ($this->jobLevel->getJobLevelAdmin() as $level) {
            $jobLevel .= '<option value="' . $level->id . '">' . $level->title . '</option>';
        }
        $candidateCategories = '';
        foreach ($this->category->getCandidateCategories() as $category) {
            $candidateCategories .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        $data = '
        <div class="clonedInput' . $fieldName . '" id="' . $varId . '">
            <div id="clonedInput">
                            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <input type="text" name="company_name[]" class="form-control" id="number2"
                               value=""/>
                        <label for="Company">Company Name</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-content">
                                <select class="form-control select2-list" name="company_category_id[]"
                                        data-placeholder="Nature of Organisation">' . $companyCategories . '</select>
                                <label>Nature of Organisation</label>
                            </div>
                            <div class="input-group-btn">
                                <a href="' . route('category.create', 'company') . '">
                                    <button class="btn btn-default" type="button"><i class="fa fa-plus"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control select2-list" name="experience_location_id[]">
                            ' . $jobLocation . '
                        </select>
                        <label>Select Location</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control select2-list" name="experience_job_level_id[]"
                                data-placeholder="Select job level">' . $jobLevel . '</select>
                        <label>Job Level</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="experience_job_title[]" class="form-control"
                               value=""/>
                        <label for="Name">Job Title</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control select2-list" name="candidate_category_id[]"
                                data-placeholder="Job Category">' . $candidateCategories . '</select>
                        <label>Job Category</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="checkbox checkbox-styled">
                            <label>
                                <input type="checkbox" name="experience_is_current[]" class="ifCheck" value="yes"
                                       data-hide=".experienceToggle' . $varId . '"/>
                                <span>is Current Job?</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="experienceToggle' . $varId . '">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <div class="input-daterange date-range input-group" id="demo-date-range">
                                <div class="input-group-content">
                                    <input type="text" class="form-control" name="experience_start_date[]"
                                           value=""/>
                                    <label>Start Date</label>
                                </div>
                                <span class="input-group-addon">to</span>
                                <div class="input-group-content">
                                    <input type="text" class="form-control" name="experience_end_date[]"
                                           value=""/>
                                    <label for="Name">End Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <strong>Description</strong>
                        <textarea name="experience_description[]" id=""
                                  class="ckeditor"></textarea>
                    </div>
                </div>
            </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

    public
    function getFrontExperienceFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $companyCategories = '';
        foreach ($this->category->getCompanyCategories() as $category) {
            $companyCategories .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        $jobLocation = '';
        foreach ($this->jobLocation->getJobLocationAdmin() as $location) {
            $jobLocation .= '<option value="' . $location->id . '">' . $location->title . '</option>';
        }
        $jobLevel = '';
        foreach ($this->jobLevel->getJobLevelAdmin() as $level) {
            $jobLevel .= '<option value="' . $level->id . '">' . $level->title . '</option>';
        }
        $candidateCategories = '';
        foreach ($this->category->getCandidateCategories() as $category) {
            $candidateCategories .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }
        $data = '
        <div class="clonedInput experiences" id="' . $varId . '">
            <div id="clonedInput">
            <hr>
                <div class="row">
                  <div class="col-md-1" style="float: right;">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Organization name*</label>
                            <input type="text" name="company_name[]" class="form-control" placeholder="Enter name of the organization of experience"
                                   value="" required/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Nature of Organization*</label>
                            <select class="language form-control jb-minimal" name="company_category_id[]" required>
                            <option value="">Select the nature of the organization</option>
                            ' . $companyCategories . '
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Job Title*</label>
                            <input type="text" name="experience_job_title[]" class="form-control" placeholder="Enter the job title Eg: General Manager, Security Guard, Cashier etc"
                                   value="" required/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Job Categories*</label>
                            <select class="language form-control jb-minimal" name="candidate_category_id[]" required>
                            <option value="">Select the category of the work/job</option>
                            ' . $candidateCategories . '</select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Job level*</label>
                            <select class="language form-control jb-minimal" name="experience_job_level_id[]" required>
                            <option value="">Select Job Level</option>
                            ' . $jobLevel . '</select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Job location*</label>
                            <select class="language form-control jb-minimal" name="experience_location_id[]" required>
                            <option value="">Select the location of experience</option>
                            ' . $jobLocation . '
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-3 col-sm-3">
                        <div class="form-group">
                            <div class="checkbox checkbox-styled">
                                <label>
                                    <input type="checkbox" name="experience_is_current[]" class="ifCheck" value="yes"
                                        data-hide=".experienceToggle' . $varId . '"/>
                                    <span>Is Current Job ?</span>
                                </label>
                            </div>
                        </div>
                    </div>
                <div class="experienceToggle' . $varId . '">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="input-daterange form-group date-range" id="demo-date-range">
                            <label>Start Date (From)*</label>
                            <input type="text" class="form-control experience_period" name="experience_start_date[]" placeholder="DD Month YYYY" onkeydown="return false"
                                   value="" required/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="input-daterange form-group date-range" id="demo-date-range">
                            <label>End Date (To)*</label>
                            <input type="text" class="form-control experience_period" name="experience_end_date[]" placeholder="DD Month YYYY" onkeydown="return false"
                                   value="" required/>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="experience_description[]" class="form-control about height-120" placeholder="Duties and responsibilities to highlight your work experience"></textarea>
                        </div>
                    </div>
                </div>
            </div>
         </div
        ';

        return json_encode($data);
    }


//Training Form Fields

    public
    function getTrainingFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput' . $fieldName . '" id="' . $varId . '">
            <div id="clonedInput">
                <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <input type="text" name="training_name[]" class="form-control"
                               value=""/>
                        <label for="Title">Training</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" name="training_agency_name[]" class="form-control"
                               value=""/>
                        <label for="Title">Agency Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="input-daterange input-group date-range" id="demo-date-range">
                            <div class="input-group-content">
                                <input type="text" class="form-control" name="training_start_date[]"
                                       value=""/>
                                <label>Start Date</label>
                            </div>
                            <span class="input-group-addon">to</span>
                            <div class="input-group-content">
                                <input type="text" class="form-control" name="training_end_date[]"
                                       value=""/>
                                <label for="Name">End Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

    public
    function getFrontTrainingFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
         <div class="clonedInput trainings" id="' . $varId . '">
            <div id="clonedInput">
            <hr>
                <div class="row">
                  <div class="col-md-1" style="float: right;">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Name of Training*</label>
                            <input type="text" name="training_name[]" class="form-control" placeholder="Enter the training achieved Eg: Computer Course"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Institution Name*</label>
                            <input type="text" name="training_agency_name[]" class="form-control" placeholder="Enter name of the institute the training was achieved"
                                   value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="input-daterange form-group date-range" id="demo-date-range">
                            <label>Start Date (From)*</label>
                            <input type="text" class="form-control training_period" name="training_start_date[]" placeholder="DD Month YYYY" onkeydown="return false"
                                   value=""/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="input-daterange form-group date-range" id="demo-date-range">
                            <label>End Date (To)*</label>
                            <input type="text" class="form-control training_period" name="training_end_date[]" placeholder="DD Month YYYY" onkeydown="return false"
                                   value=""/>
                        </div>
                    </div>
                </div>
            </div>
         </div>
        ';

        return json_encode($data);
    }


//Reference Form Fields

    public
    function getReferenceFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput' . $fieldName . '" id="' . $varId . '">

            <div id="clonedInput">
                <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <input type="text" name="reference_name[]" class="form-control" required
                               value=""/>
                        <label for="Name">Name</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="text" name="reference_company_name[]" class="form-control"
                               value=""/>
                        <label for="Name">Company Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="reference_designation[]" class="form-control" id="number2"
                               value=""/>
                        <label for="KeyWords">Designation</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="reference_email[]" class="form-control"
                               value=""/>
                        <label for="Name">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="reference_phone[]" class="form-control"
                               value=""/>
                        <label for="Name">Phone</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="reference_phone2[]" class="form-control"
                               value=""/>
                        <label for="Name">Alternate Phone</label>
                    </div>
                </div>
            </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

    public
    function getFrontReferenceFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput references" id="' . $varId . '">
            <div id="clonedInput">
            <hr>
                <div class="row">
                  <div class="col-md-1" style="float: right;">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Reference\'s Name*</label>
                            <input type="text" name="reference_name[]" class="form-control" required
                                   value="" placeholder="Full name of the reference"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Organization Name*</label>
                            <input type="text" name="reference_company_name[]" class="form-control" placeholder="Name of Organization"
                                   value="" required/>
                        </div>
                    </div>
                </div>
                    <!-- row -->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Designation*</label>
                            <input type="text" name="reference_designation[]" placeholder="Designation of reference" class="form-control" id="number2"
                                   value="" required/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="text" name="reference_email[]" class="form-control" placeholder="Email of reference"
                                   value="" required/>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Contact Number*</label>
                            <input type="text" name="reference_phone[]" class="form-control" placeholder="Contact number of reference Eg:98xxxxxxxx"
                                   value="" required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Alternate Number</label>
                            <input type="text" name="reference_phone2[]" class="form-control" placeholder="Contact number of reference Eg:98xxxxxxxx"
                                   value=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

//Language form fields

    public
    function getLanguageFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput' . $fieldName . '" id="' . $varId . '">
            <div id="clonedInput">
                <div class="row">
    <div class="col-sm-11">
        <div class="form-group">
            <input type="text" name="language_name[]" class="form-control"
                   value=""/>
            <label for="Title">Known Language</label>
        </div>
    </div>
    <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <select id="jb-level" class="form-control" name="language_reading[]">
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
            <label for="Title">Reading</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
                   <select id="jb-level" class="form-control" name="language_writing[]">
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
            <label for="Title">Writing</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
                   <select id="jb-level" class="form-control" name="language_speaking[]">
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
            <label for="Title">Speaking</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
                   <select id="jb-level" class="form-control" name="language_listening[]">
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
            <label for="Title">Listening</label>
        </div>
    </div>
</div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

    public
    function getFrontLanguageFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput languages" id="' . $varId . '" >
            <div id="clonedInput">
            <hr>
                <div class="row">
                  <div class="col-md-1" style="float: right;">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Known Language*</label>
                            <input type="text" name="language_name[]" class="form-control" placeholder="Enter the language you know Eg: Chinese"
                                   value=""/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Title">Reading</label>
                            <select class="form-control" name="language_reading[]">
                                        <option
                                            value="poor">
                                            Poor
                                        </option>
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Title">Writing</label>
                                   <select class="form-control" name="language_writing[]">
                                        <option
                                            value="poor">
                                            Poor
                                        </option>
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Title">Speaking</label>
                                   <select class="form-control" name="language_speaking[]">
                                        <option
                                            value="poor">
                                            Poor
                                        </option>
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
                     </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="Title">Listening</label>
                                   <select class="form-control" name="language_listening[]">
                                        <option
                                            value="poor">
                                            Poor
                                        </option>
                                        <option
                                            value="good">
                                            Good
                                        </option>
                                        <option
                                            value="better">
                                            Better
                                        </option>
                                        <option
                                            value="best">
                                            Best
                                        </option>
                                        <option
                                            value="excellent">
                                            Excellent
                                        </option>
        </select>
                        </div>
                    </div>
                </div>
            </div>
         </div
        ';

        return json_encode($data);
    }

//Social Media form fields

    public
    function getSocialMediaFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput' . $fieldName . '" id="' . $varId . '">
        <div id="clonedInput">
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <select name="social_media_key[]" class="form-control select2-list"
                                data-placeholder="Company Size">
                            <option value="">Select Media Type</option>
                            <option
                                value="facebook">
                                Facebook
                            </option>
                            <option
                                value="twitter">
                                Twitter
                            </option>
                            <option
                                value="linkedin">
                                LinkedIn
                            </option>
                            <option
                                value="youtube">
                                Youtube
                            </option>
                            <option
                                value="instagram">
                                Instagram
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="social_media_value[]" class="form-control" data-rule-url="true"
                               value=""/>
                        <label for="Title">Media URL</label>
                        <p class="help-block">Starts with http://</p>
                    </div>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }

    public
    function getFrontSocialMediaFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput social_medias" id="' . $varId . '">
            <div class="row" id="clonedInput">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                    <label>Media Type*</label>
                        <select id="jb-level" name="social_media_key[]" class="form-control select2-list">
                            <option value="">Select Media Type</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="youtube">Youtube</option>
                            <option value="instagram">Instagram</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Media URL</label>
                        <input type="text" class="form-control" name="social_media_value[]" id="number2"
                               data-rule-url="true" placeholder="Starts with https://facebook.com/yourusername"
                               value="">
                    </div>
                            </div>
                <div class="col-lg-1 col-md-1 col-sm-1">
                    <a class="btn btn-danger" onClick="removedCandidateClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
        ';

        return json_encode($data);
    }


    /*end clone fields for admin panel*/


    /*
     *
     * Remove Company Fields for Admin Panel
     *
     * */

    public
    function removeFields($itemName, $refid)
    {
        switch ($itemName) {
            case 'contact_details':
                try {
                    $contactDetail = $this->contactDetail->whereRefId($refid);

                    return $candidate = $contactDetail->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'educations':
                try {
                    $education = $this->education->whereRefId($refid);

                    return $candidate = $education->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'trainings':
                try {
                    $training = $this->training->whereRefId($refid);

                    return $candidate = $training->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'experiences':
                try {
                    $experience = $this->experience->whereRefId($refid);

                    return $candidate = $experience->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'languages':
                try {
                    $language = $this->language->whereRefId($refid);

                    return $candidate = $language->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'social_medias':
                try {
                    $socialMedia = $this->socialMedia->whereRefId($refid);

                    return $candidate = $socialMedia->delete();
                } catch (Exception $e) {
                    return false;
                }
        }
    }


    public
    function registerCandidate($user, array $data)
    {
        try {
            $category_id = $this->category->findBySlug($data['job_type']);
            $candidateData['category_id'] = $category_id->id;

            $candidateData['username'] = $category_id->id;
            $candidateData['ref_id'] = getRandomInt();
            $candidateData['user_id'] = $user->id;
            $candidateData['user_id'] = $user->id;
            $candidate = $this->candidate->create($candidateData);

            $contact_detail = new $this->contactDetail([
                'ref_id' => getRandomInt(),
                'detail_key' => 'mobile',
                'detail_value' => $data['contact_number']
            ]);
            $candidate->contact_details()->save($contact_detail);
            return $candidate;
        } catch (Exception $e) {
            return false;
        }
    }

}
