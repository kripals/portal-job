<?php namespace

App\Modules\Service\Company;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Company\CompanyContact;
use App\Modules\Models\ContactDetail\ContactDetail;
use App\Modules\Models\Job\Job;
use App\Modules\Models\SocialMedia\SocialMedia;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\File;
use Yajra\DataTables\Facades\DataTables;


class CompanyService extends Service
{
    protected $category;
    protected $company;
    protected $companyContacts;
    protected $contactDetail;
    protected $socialMedia;
    protected $job;
    protected $candidate;

    public function __construct(
        Company $company,
        CategoryService $category,
        CompanyContact $companyContacts,
        ContactDetail $contactDetail,
        SocialMedia $socialMedia,
        Job $job,
        Candidate $candidate
    )
    {
        $this->category = $category;
        $this->company = $company;
        $this->companyContacts = $companyContacts;
        $this->contactDetail = $contactDetail;
        $this->socialMedia = $socialMedia;
        $this->job = $job;
        $this->candidate = $candidate;
    }

    public function getCompanyJobs($companyId, $limit = null)
    {
        $company = $this->find($companyId);
        if ($limit) {
            return $this->job->whereCompanyId($company->id)->orderBy('created_at', 'DESC')->whereIsDeleted('no')->take($limit)->get();
        } else {
            return $this->job->whereCompanyId($company->id)->orderBy('created_at', 'DESC')->whereIsDeleted('no')->paginate(10);
        }
    }

    public function getCompanyDetailJobs($companyId)
    {
        return $this->job->whereCompanyId($companyId)->orderBy('created_at', 'DESC')->whereIsDeleted('no')->where('status', 'active')->where('availability', 'available')->where('is_verified', 'yes')->get();
    }

    /*For DataTable*/
    public function getAllData()
    {
        $query = $this->company->whereIsDeleted('no')->with('user')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('company_name', function (Company $company) {
                if ($company->visibility == 'visible')
                    return "<a href='" . route('company.show', $company->id) . "'>" . $company->company_name . "</a> <span class='label label-danger'>Top</span>";
                else
                    return "<a href='" . route('company.show', $company->id) . "'>" . $company->company_name . "</a>";
            })
            ->addColumn('associated_user', function (Company $company) {
                return getTableHtml($company, 'associated_user');
            })
            ->addColumn('company_category', function (Company $company) {
                return $company->category->name;
            })
            ->addColumn('company_email', function (Company $company) {
                return $company->user->email;
            })
            ->addColumn('contact_person', function (Company $company) {
                if (!$company->contact_persons->isEmpty()) {
                    return $company->contact_persons()->first()->person_name;
                } else {
                    return "N/A";
                }
            })
            ->editColumn('company_logo', function (Company $company) {
                return getTableHtml($company, 'image');
            })
            ->addColumn('contact_number', function (Company $company) {
                if (!$company->contact_persons->isEmpty()) {
                    return $company->contact_persons()->first()->person_number;
                } else {
                    return "N/A";
                }
            })
            ->addColumn('jobs', function (Company $company) {
                if (!$company->jobs->isEmpty()) {
                    return "<a href='" . route('company.job', $company->id) . "'>" . $company->jobs()->count() . "</a>";
                } else {
                    return "0";
                }
            })
            ->editColumn('visibility', function (Company $company) {
                return getTableHtml($company, 'visibility');
            })
            ->editColumn('availability', function (Company $company) {
                return getTableHtml($company, 'availability');
            })
            ->editColumn('is_verified', function (Company $company) {
                return getTableHtml($company, 'is_verified');
            })
            ->editColumn('status', function (Company $company) {
                return getTableHtml($company, 'status');
            })
            ->editColumn('actions', function (Company $company) {
                $editRoute = route('company.edit', $company->id);
                $deleteRoute = route('company.destroy', $company->id);
                $optionRoute = route('company.show', $company->id);
                $optionRouteText = '';

                return getTableHtml($company, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText);
            })->rawColumns(['associated_user', 'company_logo', 'company_name', 'jobs', 'visibility', 'availability', 'is_verified', 'status', 'actions'])
            ->make(true);
    }

    public function getAllJobData($company, $type)
    {
        if (!empty($type) && $type == 'active') {
            $query = $this->job->whereCompanyId($company->id)->whereDate('end_date', '>', Carbon::now());
        } else {
            $query = $this->job->whereCompanyId($company->id);
        }
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
            ->editColumn('applicants', function (Job $job) {
                return "<a href='" . route('job.candidate', $job->id) . "'>" . $job->applicants()->count() . "</a>";
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
            })->rawColumns(['title', 'job_expiry', 'applicants', 'status', 'actions'])
            ->make(true);
    }

    public function getAllCandidateData($company)
    {
        $query = $this->getJobApplicants($company);

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

    public function create(array $data)
    {
        try {
            $contactDetails = [];
            $socialMedias = [];
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['is_verified'] = (isset($data['is_verified']) ? $data['is_verified'] : '') == 'on' ? 'yes' : 'no';
            $data['created_by'] = Auth::user()->id;
//            dd($data);
            if ($company = $this->company->create($data)) {
                $this->createContactPersons($company, $data);
                $this->createContactDetails($company, $data);
                $this->createSocialMedias($company, $data);
            }
            return $company;
        } catch (Exception $e) {
            return null;
        }
    }

    public function createContactPersons($company, array $data)
    {
        foreach ($data['person_name'] as $key => $value) {
            $company_contacts[] = new $this->companyContacts([
                'ref_id' => getRandomInt(),
                'person_name' => $value,
                'person_designation' => $data['person_designation'][$key],
                'person_email' => $data['person_email'][$key],
                'person_number' => $data['person_number'][$key],
                'contact_type' => $data['person_contact_type'][$key],
            ]);
            $company->contact_persons()->saveMany($company_contacts);
        }
    }

    public function createContactDetails($company, array $data)
    {
        foreach ($data['detail_contact_type'] as $key => $value) {
            $contact_detail = new $this->contactDetail([
                'ref_id' => getRandomInt(),
                'detail_key' => $value,
                'detail_value' => $data['detail_contact_number'][$key]
            ]);
            $company->contact_details()->save($contact_detail);
        }
    }

    public function createSocialMedias($company, array $data)
    {
        foreach ($data['media_key'] as $key => $value) {
            $social_media = new $this->socialMedia([
                'ref_id' => getRandomInt(),
                'media_key' => $value,
                'media_value' => $data['media_value'][$key]
            ]);
            $company->social_medias()->save($social_media);
        }
    }

    public function update($companyId, array $data)
    {
        try {
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['is_verified'] = (isset($data['is_verified']) ? $data['is_verified'] : '') == 'on' ? 'yes' : 'no';
            $data['last_updated_by'] = Auth::user()->id;
            $company = $this->company->find($companyId);
            $companyUpdate = $company->update($data);
            if ($companyUpdate) {

                //for Updating Existing Contact Details
                if (isset($data['contact_details_ref_id'])) {
                    for ($i = 0; $i < count($data['contact_details_ref_id']); $i++) {
                        $contactDetails = $this->contactDetail->whereRefId($data['contact_details_ref_id'][$i])->first();
                        $contactDetailData = [
                            'detail_key' => $data['detail_contact_type'][$i],
                            'detail_value' => $data['detail_contact_number'][$i]
                        ];
                        $contactDetails->update($contactDetailData);
                        unset($data['detail_contact_type'][$i]);
                        unset($data['detail_contact_number'][$i]);
                    }
                }

                //if extra fields are added on edit
                if (!empty(['detail_contact_type'] && ['detail_contact_number'])) {
                    $this->createContactDetails($company, $data);
                }

                //for Contact Persons
                //updating existing data
                if (isset($data['contact_persons_ref_id'])) {
                    for ($i = 0; $i < count($data['contact_persons_ref_id']); $i++) {
                        $contactPersons = $this->companyContacts->whereRefId($data['contact_persons_ref_id'][$i])->first();
                        $contactPersonData = [
                            'person_name' => $data['person_name'][$i],
                            'person_designation' => $data['person_designation'][$i],
                            'person_email' => $data['person_email'][$i],
                            'person_number' => $data['person_number'][$i],
                            'contact_type' => $data['person_contact_type'][$i],
                        ];
                        $contactPersons->update($contactPersonData);
                        unset($data['person_name'][$i]);
                        unset($data['person_designation'][$i]);
                        unset($data['person_email'][$i]);
                        unset($data['person_number'][$i]);
                        unset($data['person_contact_type'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (!empty(['person_name'])) {
                    $this->createContactPersons($company, $data);
                }

                //for Social Accounts
                if (isset($data['social_medias_ref_id'])) {
                    for ($i = 0; $i < count($data['social_medias_ref_id']); $i++) {
                        $socialMedia = $this->socialMedia->whereRefId($data['social_medias_ref_id'][$i])->first();
                        $socialMediaData = [
                            'media_key' => $data['media_key'][$i],
                            'media_value' => $data['media_value'][$i]
                        ];
                        $socialMedia->update($socialMediaData);
                        unset($data['media_key'][$i]);
                        unset($data['media_value'][$i]);
                    }
                }
                //if extra fields are added on edit
                if (!empty(['media_key'])) {
                    $this->createSocialMedias($company, $data);
                }
            }

            //$this->logger->info(' created successfully', $data);

            return $company;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }


    /**
     * Paginate all User
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->company->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
//        $this->company->with('user_details')->get();
        return $this->company->whereIsDeleted('no')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($companyId)
    {
        try {
            return $this->company->whereIsDeleted('no')->find($companyId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function findWithType($companyId, $type)
    {
        try {
            return $this->company->whereIsDeleted('no')->whereId($companyId)->whereDate;
        } catch (Exception $e) {
            return null;
        }
    }

    public function findByRefId($companyId)
    {
        try {
            return $this->company->whereIsDeleted('no')->whereRefId($companyId)->first();
        } catch (Exception $e) {
            return null;
        }
    }

    public function findWithUser($userId)
    {
        try {

        } catch (Excpetion $e) {

        }
    }


    public function updateBasicInfo($companyId, array $data)
    {
        try {
            $category_id = $this->category->findBySlug($data['industry']);
            $companyData['category_id'] = $category_id->id;
            $companyData['company_name'] = $data['organization_name'];
//            $companyData['company_reg_no'] = $data['reg_no'];
            $companyData['ownership'] = $data['ownership'];
            $companyData['company_size'] = $data['organization_size'];
            $companyData['website'] = $data['website'];
            $companyData['description'] = $data['description'];
            $company = $this->company->whereRefId($companyId)->first();

            $company = $company->update($companyData);
            return $company;
        } catch (Exception $e) {
            return null;
        }
    }

    public function storeContactDetail($companyId, array $data)
    {
        try {

            $company = $this->company->whereRefId($companyId)->first();
            $company->update($data);
            if (isset($data['contact_details_ref_id'])) {
                //for Updating Existing Contact Details
                for ($i = 0; $i < count($data['contact_details_ref_id']); $i++) {
                    $contactDetails = $this->contactDetail->whereRefId($data['contact_details_ref_id'][$i])->first();
                    $contactDetailData = [
                        'detail_key' => $data['detail_contact_type'][$i],
                        'detail_value' => $data['detail_contact_number'][$i]
                    ];
                    $contactDetails->update($contactDetailData);
                    unset($data['detail_contact_type'][$i]);
                    unset($data['detail_contact_number'][$i]);
                }

                //if extra fields are added on edit
                if (!empty(['detail_contact_type'] && ['detail_contact_number'])) {
                    $this->createContactDetails($company, $data);
                }
            } else {
                $this->createContactDetails($company, $data);
            }
            return $company;
        } catch (Exception $e) {
            return null;
        }
    }

    public function storeContactPerson($companyId, array $data)
    {
        try {
            //for Contact Persons
            $company = $this->company->whereRefId($companyId)->first();

            if (isset($data['contact_persons_ref_id'])) {
                //updating existing data
                for ($i = 0; $i < count($data['contact_persons_ref_id']); $i++) {
                    $contactPersons = $this->companyContacts->whereRefId($data['contact_persons_ref_id'][$i])->first();
                    $contactPersonData = [
                        'person_name' => $data['person_name'][$i],
                        'person_designation' => $data['person_designation'][$i],
                        'person_email' => $data['person_email'][$i],
                        'person_number' => $data['person_number'][$i],
                        'contact_type' => $data['person_contact_type'][$i],
                    ];
                    $contactPersons->update($contactPersonData);
                    unset($data['person_name'][$i]);
                    unset($data['person_designation'][$i]);
                    unset($data['person_email'][$i]);
                    unset($data['person_number'][$i]);
                    unset($data['person_contact_type'][$i]);
                }

                //if extra fields are added on edit
                if (!empty(['person_name'])) {
                    $this->createContactPersons($company, $data);
                }
            } else {
                $this->createContactPersons($company, $data);
            }

            return $company;
        } catch (Exception $e) {
            return null;
        }
    }

    public function storeSocialMedia($companyId, array $data)
    {
        try {
            $company = $this->company->whereRefId($companyId)->first();

            if (isset($data['social_medias_ref_id'])) {
                //for update Social Accounts
                for ($i = 0; $i < count($data['social_medias_ref_id']); $i++) {
                    $socialMedia = $this->socialMedia->whereRefId($data['social_medias_ref_id'][$i])->first();

                    $socialMediaData = [
                        'media_key' => $data['media_key'][$i],
                        'media_value' => $data['media_value'][$i]
                    ];
                    $socialMedia->update($socialMediaData);
                    unset($data['media_key'][$i]);
                    unset($data['media_value'][$i]);
                }
                //if extra fields are added on edit
                if (!empty(['media_key'])) {
                    $this->createSocialMedias($company, $data);
                }
            } else {
                $this->createSocialMedias($company, $data);
            }

            return $company;
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
    public function delete($companyId)
    {
        try {

            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at'] = Carbon::now();
            $company = $this->company->whereRefId($companyId)->first();
            $data['is_deleted'] = 'yes';
            return $company = $company->update($data);

        } catch (Exception $e) {
            return false;
        }
    }
    public function deleteFromAdmin($companyId)
    {
        try {
            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at'] = Carbon::now();
            $company = $this->company->find($companyId);
            $data['is_deleted'] = 'yes';
            return $company = $company->update($data);

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
        return $this->company->whereIsDeleted('no')->whereName($name);
    }

    public function getBySlug($slug)
    {
        return $this->company->whereIsDeleted('no')->whereSlug($slug)->first();
    }


    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/company';
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

    public function updateImage($companyId, array $data)
    {
        try {
            $company = $this->company->find($companyId);
            $company = $company->update($data);
            return $company;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function updateFrontImage($companyId, array $data)
    {
        try {
            $company = $this->company->whereRefId($companyId)->first();
            $company = $company->update($data);
            return $company;
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


    //contact details form

    public function getContactDetailFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput ' . $fieldName . '" id="' . $varId . '">
            <div class="row" id="clonedInput">
                <div class="col-sm-5">
                <div class="form-group">
                    <select name="detail_contact_type[]" id="contact_type" class="form-control"
                            data-placeholder="Contact Type">
                        <option value="work">Work</option>
                        <option value="mobile">Mobile</option>
                        <option value="personal">Personal</option>
                    </select>
                    <label for="Name">Contact Type</label>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="detail_contact_number[]" class="form-control" id="contact_number' . $divId . '"
                           value=""/>
                    <label for="KeyWords">Contact number</label>
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

    public function getFrontContactDetailFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput contact_details" id="' . $varId . '">
            <hr>
            <div class="row" id="clonedInput">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="detail_contact_type">Contact Type</label>
                        <select id="jb-level contact_type" name="detail_contact_type[]" class="form-control"
                                data-placeholder="Contact Type">
                            <option value="work">Work</option>
                            <option value="mobile">Mobile</option>
                            <option value="personal">Personal</option>
                        </select>
                    </div>
                </div>
                <div  class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="detail_contact_number">Contact number</label>
                        <input type="text" name="detail_contact_number[]" id="contact_number' . $divId . '" class="form-control"
                               value=""/>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                     <div class="form-group mrg-top-30">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        ';
        return json_encode($data);
    }

    //Contact Persons form

    public function getContactPersonFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput" id="' . $varId . '">
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <input type="text" name="person_name[]" class="form-control"
                               value=""/>
                        <label for="Name">Contact Person Name</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="person_designation[]" class="form-control"
                               value=""/>
                        <label for="Name">Contact Person Designation </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="email" name="person_email[]" id="Email1" class="form-control"
                               value=""/>
                        <label for="Name">Contact Person Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <select name="person_contact_type[]" class="form-control select2-list"
                                data-placeholder="Company Size">
                            <option value="work">Work</option>
                            <option value="mobile">Mobile</option>
                            <option value="personal">Personal</option>
                        </select>
                        <label for="Name">Contact Type</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="person_number[]" class="form-control" id="number2"
                               data-rule-number="true"
                               value=""/>
                        <label for="Name">Contact Person Number</label>
                    </div>
                </div>
            </div>
        </div>
        ';
        return json_encode($data);
    }

    public function getFrontContactPersonFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput contact_persons" id="' . $varId . '">
            <div id="clonedInput">
                <hr>
                <div class="row">
                    <div class="col-lg-11 col-md-11 col-sm-11">
                        <div class="form-group">
                            <label for="person_name">Person Name*</label>
                            <input type="text" class="form-control"  name="person_name[]" required>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        <div class="form-group mrg-top-30">
                            <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Designation*</label>
                            <input type="text" class="form-control" name="person_designation[]" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="person_email[]" class="form-control" required>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Contact Type</label>
                            <select id="jb-level" name="person_contact_type[]" class="form-control">
                                <option value="work">Work</option>
                                <option value="mobile">Mobile</option>
                                <option value="personal">Personal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="person_number[]" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
        return json_encode($data);
    }


    //Social Media form

    public function getSocialMediaFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput" id="' . $varId . '">
            <div class="row" id="clonedInput">
                <div class="col-sm-5">
                    <div class="form-group">
                        <select name="media_key[]" class="form-control select2-list">
                            <option value="">Select Media Type</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="youtube">Youtube</option>
                            <option value="instagram">Instagram</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="media_value[]" class="form-control" id="number2"
                               data-rule-url="true"
                               value=""/>
                        <label for="Name">Media URL</label>
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

    public function getFrontSocialMediaFields($fieldName, $divId)
    {
        $varId = $fieldName . $divId;
        $data = '
        <div class="clonedInput social_medias" id="' . $varId . '">
            <div class="row" id="clonedInput">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="social_media">Social Media Type</label>
                        <select name="media_key[]" class="form-control select2-list" required>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="youtube">Youtube</option>
                            <option value="instagram">Instagram</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label for="media_url">Media URL</label>
                        <input type="text" name="media_value[]" class="form-control" id="number2"
                               data-rule-url="true"
                               value="" required/>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <div class="form-group mrg-top-30">
                        <a class="btn btn-danger" onClick="removedClone(' . $varId . ');"><i class="fa fa-trash"></i></a>
                    </div>
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

    public function removeFields($itemName, $refid)
    {
        switch ($itemName) {
            case 'contact_details':
                try {
                    $contactDetail = $this->contactDetail->whereRefId($refid);
                    return $company = $contactDetail->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'contact_persons':
                try {
                    $contactPerson = $this->companyContacts->whereRefId($refid);
                    return $company = $contactPerson->delete();
                } catch (Exception $e) {
                    return false;
                }
            case 'social_medias':
                try {
                    $socialMedia = $this->socialMedia->whereRefId($refid);
                    return $company = $socialMedia->delete();
                } catch (Exception $e) {
                    return false;
                }
        }
    }

    public function getContactDetails($company)
    {
        $contactDetails = $company->contact_details()->get();
        return $contactDetails;
    }

    public function getContactPersons($company)
    {
        $contactPersons = $company->contact_persons()->get();
        return $contactPersons;
    }

    public function getSocialMedias($company)
    {
        $socialMedias = $company->social_medias()->get();
        return $socialMedias;
    }


    public function getAllJobs($company)
    {
        $jobs = $company->jobs()->get();
        return $jobs;
    }

    public function getActiveJobs($company)
    {
        $jobs = $company->jobs()->whereDate('end_date', '>', Carbon::now())->get();
        return $jobs;
    }

    public function getRecentJobs($company)
    {
        $jobs = $company->jobs()->orderBy('id', 'desc')->take(5)->get();
        return $jobs;
    }

    public function getJobApplicants($company)
    {
//        DB::enableQueryLog();
//        $applicants = $this->candidate->whereHas('job_applications',function ($q) use($company){
//            $q->where('company_id',$company->id);
////            $q->whereHas('company',function ($q) use($company){
////            });
//        })->get();
//$query = DB::getQueryLog();
//
//dd($query);
//        dd($applicants->job_applications->id);
//        return $applicants;
//        $candidates = [];

//        return $this->candidate->job_applications()->each(function ($job, $key) use ($company) {
////            $job->whereHas('company',function($q) use ($company){
//                $q->where('company_id',$company->id);
////            });
//        });

        $company->jobs()->each(function ($job, $key) use (&$candidates) {
            $job->applicants()->each(function ($candidate, $key) use (&$candidates) {
                $candidates[] = $candidate;
            });
        });
        $applicants = collect($candidates);

//        dd($applicants);
        return $this->customPaginate($applicants);
    }

    public function getExpiredJobs($company)
    {
        return $this->job->whereIsDeleted('no')->where('end_date', '<', Carbon::now())->whereCompanyId($company->id)->get();
    }

    public function customPaginate($items, $perPage = 10, $page = null, $options = [])
    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $paginate = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        return $paginate->withPath('/company/job/applications');

    }

    public function getMatchingCandidates($company)
    {
        $jobCategoriesIds = [];
        $company->jobs()->each(function ($job, $key) use (&$jobCategoriesIds) {
            array_push($jobCategoriesIds, $job->category_id);
        });
        $jobCategories = array_unique($jobCategoriesIds);
        $candidates = $this->candidate->whereIn('category_id', $jobCategories)->whereIsDeleted('no')->inRandomOrder()->get()->take(6);
        return $candidates;
    }

    public function registerCompany($user, array $data)
    {
        try {
            $category_id = $this->category->findBySlug($data['organization_type']);
            $companyData['category_id'] = $category_id->id;
            $companyData['company_name'] = $data['organization_name'];
            $companyData['ref_id'] = getRandomInt();
            $companyData['company_reg_no'] = $data['reg_id'];
            $companyData['user_id'] = $user->id;
            $company = $this->company->create($companyData);

            $contact_detail = new $this->contactDetail([
                'ref_id' => getRandomInt(),
                'detail_key' => 'mobile',
                'detail_value' => $data['contact_number']
            ]);

            $company->contact_details()->save($contact_detail);

            return $company;
        } catch (Exception $e) {
            return false;
        }
    }

}
