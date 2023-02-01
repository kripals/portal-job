<?php namespace

App\Modules\Service\Job;

use App\Mail\CandidateJobNotify;
use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\CandidateJob\CandidateJob;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Job\Job;
use App\Modules\Models\JobCountry\JobCountry;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\JobSkill\JobSkillService;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;


class JobService extends Service
{
    protected $job;
    protected $company;
    protected $candidateJob;
    protected $category;
    protected $country;
    protected $jobSkill;
    protected $candidate;

    public function __construct(
        Job $job,
        JobSkillService $jobSkill,
        Company $company,
        CategoryService $category,
        JobCountry $country,
        CandidateJob $candidateJob,
        Candidate $candidate
    )
    {
        $this->job = $job;
        $this->company = $company;
        $this->category = $category;
        $this->country = $country;
        $this->candidateJob = $candidateJob;
        $this->jobSkill = $jobSkill;
        $this->candidate = $candidate;
    }

    public function getAllData()
    {
        $query = $this->job->whereIsDeleted('no')->with('company')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('company_logo', function (Job $job) {
                if (!empty($job->company_id)) {
                    return getTableHtml($job->company, 'image');
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('company_name', function (Job $job) {
                if (!empty($job->company_id)) {
                    return "<a href='" . route('company.show', $job->company->id) . "'>" . $job->company->company_name . "</a>";
                } else {
                    return 'N/A';
                }
            })
            ->editColumn('title', function (Job $job) {
                return "<a href='" . route('job.show', $job->id) . "'>" . $job->title . "</a>";
            })
            ->addColumn('job_category', function (Job $job) {
                if (!empty($job->category_id)) {
                    return $job->category->name;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('job_level', function (Job $job) {
                if (!empty($job->job_level_id)) {
                    return $job->job_level->title;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('job_type', function (Job $job) {
                if (!empty($job->job_type_id)) {
                    return $job->job_type->title;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('job_service', function (Job $job) {
                if (!empty($job->job_service_id)) {
                    return $job->job_service->title;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('applicants', function (Job $job) {
                return "<a href='" . route('job.candidate', $job->id) . "'>" . $job->applicants()->count() . "</a>";
            })
            ->editColumn('availability', function (Job $job) {
                return getTableHtml($job, 'availability');
            })
            ->editColumn('is_verified', function (Job $job) {
                return getTableHtml($job, 'is_verified');
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
            })->rawColumns(['company_logo', 'company_name', 'title', 'applicants', 'availability', 'is_verified', 'status', 'actions'])
            ->make(true);
    }

    public function getAllCandidateData($job)
    {
        $query = $job->applicants()->get();

        return DataTables::of($query)->addIndexColumn()
            ->editColumn('candidate_image', function (Candidate $candidate) {
                return getTableHtml($candidate->user, 'image');
            })
            ->editColumn('candidate_name', function (Candidate $candidate) {
                return $candidate->user->full_name;
            })
            ->editColumn('company_category', function (Candidate $candidate) {
                return $candidate->category->name;
            })
            ->editColumn('experience_period', function (Candidate $candidate) {
                if (!empty($candidate->experience_period))
                    return $candidate->experience_text;
                else
                    return 'N/A';
            })
            ->editColumn('job_level', function (Candidate $candidate) {
                if (!empty($candidate->job_level_id)) {
                    return $candidate->job_level->title;
                } else {
                    return "N/A";
                }
            })
            ->editColumn('candidate_skills', function (Candidate $candidate) {
                if (!$candidate->known_skills->isEmpty())
                    return getTableHtml($candidate, 'candidate_skills');
                else
                    return "N/A";
            })
            ->editColumn('contact_number', function (Candidate $candidate) {
                if (!$candidate->contact_details->isEmpty()) {
                    return $candidate->contact_details()->first()->detail_value;
                } else {
                    return "N/A";
                }
            })
            ->editColumn('jobs_applied', function (Candidate $candidate) {
                if (!$candidate->job_applications->isEmpty()) {
                    return "<a href='" . route('candidate.job', $candidate->id) . "'>" . $candidate->job_applications()->count() . "</a>";
                } else {
                    return "N/A";
                }
            })
            ->editColumn('visibility', function (Candidate $candidate) {
                return getTableHtml($candidate, 'visibility');
            })
            ->editColumn('availability', function (Candidate $candidate) {
                return getTableHtml($candidate, 'availability');
            })
            ->editColumn('is_verified', function (Candidate $candidate) {
                return getTableHtml($candidate, 'is_verified');
            })
            ->editColumn('status', function (Candidate $candidate) {
                return getTableHtml($candidate, 'status');
            })->editColumn('actions', function (Candidate $candidate) {
                $editRoute = route('candidate.edit', $candidate->id);
                $deleteRoute = route('candidate.destroy', $candidate->id);
                $optionRoute = route('candidate.show', $candidate->id);
                $optionRouteText = '';
                $optionRoute2 = route('candidate.view-resume', $candidate->id);
                $optionRouteText2 = 'resume';

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


    public function getAllApplicantData()
    {
        $query = $this->candidateJob->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('candidate_image', function (CandidateJob $cj) {
                return getTableHtml($cj->candidate->user, 'image');
            })
            ->editColumn('applicant_name', function (CandidateJob $cj) {
                return '<a href="'.route('candidate.show', $cj->candidate_id).'" target="_blank">'.$cj->candidate->user->full_name.'</a>';
            })
            ->editColumn('job_title', function (CandidateJob $cj) {
                return $cj->job->title ?? '';
            })
            ->editColumn('company_name', function (CandidateJob $cj) {
                return $cj->job->company->company_name ?? '';
            })
            ->editColumn('status', function (CandidateJob $cj) {
                return getTableHtml($cj, 'status');
            })->editColumn('actions', function (CandidateJob $candidate) {
                $editRoute = '';
                $deleteRoute = '';
                $optionRoute = route('candidate.show', $candidate->candidate_id);
                $optionRouteText = '';
                $optionRoute2 = '';
                $optionRouteText2 = '';

                return getTableHtml($candidate, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText, $optionRoute2, $optionRouteText2);
            })->rawColumns([
                'candidate_image',
                'candidate_name',
                'status',
                'actions',
                'applicant_name'
            ])->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['is_verified'] = (isset($data['is_verified']) ? $data['is_verified'] : '') == 'on' ? 'yes' : 'no';
            $data['education_requirement'] = (isset($data['education_requirement']) ? $data['education_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['experience_requirement'] = (isset($data['experience_requirement']) ? $data['experience_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['skill_requirement'] = (isset($data['skill_requirement']) ? $data['skill_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['apply_online'] = (isset($data['apply_online']) ? $data['apply_online'] : '') == 'on' ? 'yes' : 'no';
            $data['gender_specific'] = (isset($data['gender_specific']) ? $data['gender_specific'] : '') == 'on' ? 'yes' : 'no';
            $data['age_specific'] = (isset($data['age_specific']) ? $data['age_specific'] : '') == 'on' ? 'yes' : 'no';
            $data['created_by'] = Auth::user()->id;
            $data['end_date'] = Carbon::createFromTimeString($data['end_date']);
            $job = $this->job->create($data);
            if ($job) {
                $skills = [];
                $skillId = '';
                if(!empty($data['skills'])) {
                    foreach ($data['skills'] as $skill) {
                        $skillId = $this->jobSkill->findBySlug($skill)->id;
                        array_push($skills, $skillId);
                    }
                }
                $job->skills()->sync($skills);
            }
            return $job;
        } catch (Exception $e) {
            return null;
        }
    }

    public function update($jobId, array $data)
    {
        try {
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['is_verified'] = (isset($data['is_verified']) ? $data['is_verified'] : '') == 'on' ? 'yes' : 'no';
            $data['education_requirement'] = (isset($data['education_requirement']) ? $data['education_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['experience_requirement'] = (isset($data['experience_requirement']) ? $data['experience_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['skill_requirement'] = (isset($data['skill_requirement']) ? $data['skill_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['apply_online'] = (isset($data['apply_online']) ? $data['apply_online'] : '') == 'on' ? 'yes' : 'no';
            $data['gender_specific'] = (isset($data['gender_specific']) ? $data['gender_specific'] : '') == 'on' ? 'yes' : 'no';
            $data['age_specific'] = (isset($data['age_specific']) ? $data['age_specific'] : '') == 'on' ? 'yes' : 'no';
            $data['end_date'] = Carbon::createFromTimeString($data['end_date']);
            $data['last_updated_by'] = Auth::user()->id;
            $job = $this->job->find($jobId);
            $jobUpdate = $job->update($data);
            $skills = [];
            if(isset($data['skills'])) {
                foreach ($data['skills'] as $skill) {
                    $skillId = $this->jobSkill->findBySlug($skill)->id;
                    array_push($skills, $skillId);
                }
            }
            $job->skills()->sync($skills);
            return $jobUpdate;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getCompanyJobs($companyId)
    {
        return $this->job->whereCompanyId($companyId)->get();
    }

    public function fillSession($data)
    {
        return $this->job->fill($data);
    }

    public function storeJobFront($company, array $data)
    {
        try {
            $data['ref_id'] = getRandomInt();
            $company = $this->company->whereRefId($company->ref_id)->first();
            $data['company_id'] = $company->id;

            $this->create($data);

        } catch (Exception $e) {
            return null;
        }
    }

    public function updateJobFront(array $data, $jobId)
    {
        try {

            $data['ref_id'] = getRandomInt();
            $data['status'] = 'active';
            $data['end_date'] = Carbon::createFromTimeString($data['end_date']);
            $data['education_requirement'] = (isset($data['education_requirement']) ? $data['education_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['experience_requirement'] = (isset($data['experience_requirement']) ? $data['experience_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['skill_requirement'] = (isset($data['skill_requirement']) ? $data['skill_requirement'] : '') == 'on' ? 'yes' : 'no';
            $data['apply_online'] = (isset($data['apply_online']) ? $data['apply_online'] : '') == 'on' ? 'yes' : 'no';
            $data['gender_specific'] = (isset($data['gender_specific']) ? $data['gender_specific'] : '') == 'on' ? 'yes' : 'no';
            $data['age_specific'] = (isset($data['age_specific']) ? $data['age_specific'] : '') == 'on' ? 'yes' : 'no';
            $data['last_updated_by'] = Auth::user()->id;
            $job = $this->findByRefId($jobId);
            $jobUpdate = $job->update($data);
            return $jobUpdate;

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
    public function delete($jobId)
    {
        try {

            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at'] = Carbon::now();
            $job = $this->job->find($jobId);
            $data['is_deleted'] = 'yes';
            return $job = $job->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->job->whereIsDeleted('no')->whereName($name);
    }

    public function getBySlug($slug)
    {
        return $this->job->whereIsDeleted('no')->whereSlug($slug)->first();
    }

    public function getMatchingJobs($candidate)
    {
        $catId = $candidate->category->id;
        $jobIds = $candidate->job_applications->pluck('id');
        return $this->job->whereStatus('active')->whereCategoryId($catId)->whereNotIn('id', $jobIds)->take(5)->inRandomOrder()->whereDate('end_date','>=',Carbon::today()->toDateString())->get();
    }

    public function getHomeCountryJobs()
    {
        $country = $this->country->whereSlug('nepal')->whereStatus('active')->first();
        return $this->job->whereStatus('active')->whereJobCountryId($country->id)->whereIsDeleted('no')->whereAvailability('available')->whereDate('end_date','>=',Carbon::today()->toDateString())->whereIsVerified('yes')->paginate(30);
    }

    public function getJobsByCountryType($country = null, $type = null)
    {
        $country = $this->country->whereSlug($country)->whereStatus('active')->first();
        return $this->job->whereStatus('active')
        ->whereJobCountryId($country->id)
        ->whereIsDeleted('no')
        ->whereAvailability('available')
        ->whereDate('end_date','>=',Carbon::today()->toDateString())
        ->whereHas('job_service',function($q) use($type){
            $q->where('slug','like','%'.$type.'%');
        })
        ->whereIsVerified('yes')
        ->paginate(30);
    }

    public function getAbroadJobs()
    {
        $country = $this->country->whereSlug('nepal')->whereStatus('active')->first();
        return $this->job->whereStatus('active')->whereNotIn('job_country_id', [$country->id])->whereIsDeleted('no')->whereAvailability('available')->whereDate('end_date','>=',Carbon::today()->toDateString())->whereIsVerified('yes')->paginate(30);
    }

    public function getAllJobsFront()
    {
        return $this->job->whereStatus('active')->whereIsDeleted('no')->whereIsVerified('yes')->whereAvailability('available')->whereDate('end_date','>=',Carbon::today()->toDateString())->paginate(30);
    }

    public function getJobBySearch($jobCategory, $keyword)
    {
        $category = $this->category->findBySlug($jobCategory);
        if ($jobCategory && empty($keyword)) {
            return $this->job->whereStatus('active')
                ->whereIsDeleted('no')
                ->whereAvailability('available')
                ->whereIsVerified('yes')
                ->whereCategoryId($category->id)
                ->whereDate('end_date','>=',Carbon::today()->toDateString())
                ->paginate(30);
        } elseif ($jobCategory && $keyword) {
            return $this->job->whereStatus('active')
                ->whereIsDeleted('no')
                ->whereAvailability('available')
                ->whereIsVerified('yes')
                ->whereDate('end_date','>=',Carbon::today()->toDateString())
                ->whereCategoryId($category->id)
                ->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('location', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('education_level', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('min_salary_amount', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('max_salary_amount', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('experience_value', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('specification', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('gender', '=', strtolower($keyword))
                        ->orWhereHas('job_service', function ($q) use ($keyword) {
                            $q->where('title', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhereHas('job_level', function ($q) use ($keyword) {
                            $q->where('title', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhereHas('job_country', function ($q) use ($keyword) {
                            $q->where('title', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhereHas('job_type', function ($q) use ($keyword) {
                            $q->where('title', 'LIKE', '%' . $keyword . '%');
                        })
                        ->orWhereHas('category', function ($q) use ($keyword) {
                            $q->where('name', 'LIKE', '%' . $keyword . '%');
                        });
                })->paginate(30);
        } else {
            if (is_null($keyword)) {
                return $this->job->whereStatus('active')
                    ->whereIsDeleted('no')
                    ->whereAvailability('available')
                    ->whereIsVerified('yes')
                    ->whereDate('end_date','>=',Carbon::today()->toDateString())
                    ->paginate(30);
            } else {
                return $this->job->whereStatus('active')
                    ->whereIsDeleted('no')
                    ->whereAvailability('available')
                    ->whereIsVerified('yes')
                    ->whereDate('end_date','>=',Carbon::today()->toDateString())
                    ->where(function ($query) use ($keyword) {
                        $query->where('title', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('location', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('education_level', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('min_salary_amount', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('max_salary_amount', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('experience_value', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('specification', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('gender', '=', strtolower($keyword))
                            ->orWhereHas('job_service', function ($q) use ($keyword) {
                                $q->where('title', 'LIKE', '%' . $keyword . '%');
                            })
                            ->orWhereHas('job_level', function ($q) use ($keyword) {
                                $q->where('title', 'LIKE', '%' . $keyword . '%');
                            })
                            ->orWhereHas('job_country', function ($q) use ($keyword) {
                                $q->where('title', 'LIKE', '%' . $keyword . '%');
                            })
                            ->orWhereHas('job_type', function ($q) use ($keyword) {
                                $q->where('title', 'LIKE', '%' . $keyword . '%');
                            })
                            ->orWhereHas('category', function ($q) use ($keyword) {
                                $q->where('name', 'LIKE', '%' . $keyword . '%');
                            });
                    })->paginate(30);
            }
        }
    }

    public function getAppliedJobs($candidate, $limit = null)
    {
        if ($limit)
            return $candidate->job_applications()->take(5)->latest()->get();
        else
            return $candidate->job_applications()->get();
    }

    public function getShortlistedCount($candidate)
    {
        return $candidate->whereHas('job_applications', function ($q) {
            $q->where('candidate_job.status', 'shortlisted');
        })->get();
    }

    public function getAllApplications()
    {
        return $this->candidateJob->get();
    }


    public function getJobApplicants($job)
    {
        try {

            $applicant = $this->job->find($job);

//        dd($applicant->applicants()->get());
            return $applicant->applicants()->get()->toArray();
        } catch (Exception $e) {
            return null;
        }
    }

    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/job';
            return $fileName = $this->uploadFromAjax($file);
        }
    }

    public function __deleteImages($subCat)
    {
        try {
            if (is_file($subCat->image_path))
                unlink($subCat->image_path);

            if (is_file($subCat->thumbnail_path))
                unlink($subCat->thumbnail_path);
        } catch (\Exception $e) {

        }
    }

    public function updateImage($jobId, array $data)
    {
        try {
            $job = $this->job->find($jobId);
            $job = $job->update($data);
            return $job;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
//        $this->company->with('user_details')->get();
        return $this->job->whereIsDeleted('no')->get();
    }


    public function find($id)
    {
        try {
            return $this->job->find($id);
        } catch (Exception $e) {
            return null;
        }
    }

    public function findByRefId($refID)
    {
        try {
            return $this->job->whereRefId($refID)->first();
        } catch (Exception $e) {
            return null;
        }
    }

    public function findCompanyById($companyId)
    {
        try {
            return $this->company->whereStatus('active')->whereId($companyId)->first();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getRelatedJobs($job)
    {
        try {
            return $this->job->whereStatus('active')->whereAvailability('available')->inRandomOrder()->whereCategoryId($job->category_id)->whereDate('end_date','>=',Carbon::today()->toDateString())->whereIsVerified('yes')->whereNotIn('ref_id', [$job->ref_id])->get()->take(4);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getJobByCategory($category)
    {
        try {
            $category = $this->category->findBySlug($category);
            return $this->job->whereStatus('active')->whereCategoryId($category->id)->whereAvailability('available')->whereDate('end_date','>=',Carbon::today()->toDateString())->whereIsVerified('yes')->paginate(30);
        } catch (Exception $e) {
            return null;
        }
    }

    public function updateJobStatus($id, $status)
    {
        try {
            $application = $this->candidateJob->where('ref_id', $id)->update(['status' => $status]);
            $candidateJobData = $this->candidateJob->where('ref_id', $id)->first();
            $candidate = $this->candidate->find($candidateJobData->candidate_id);
            $job = $this->find($candidateJobData->job_id);
            $company = $job->company;

            Mail::to($candidate->user->email)->send(new CandidateJobNotify($candidate,$company,$job,$status));
            return $candidate;
        } catch (Exception $e) {
            return null;
        }
    }

    public function postJobApplication($job, $candidate)
    {
        try {
            $data = [];
            $data['ref_id'] = getRandomInt();
            $data['job_id'] = $job->id;
//            $data['candidate_id'] = $candidate->id;
//            $data['status'] = 'pending';
//            return $this->jobApplication->create($data);
            $job->applicants()->attach($candidate, $data);
            return true;

        } catch (Exception $e) {
            return null;
        }
    }
}
