<?php

namespace App\Http\Controllers\Admin\Company;

use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Company\CompanyService;
use App\Http\Requests\Admin\Company\CompanyRequest;
use App\Modules\Service\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class CompanyController extends Controller
{
    protected $company;
    protected $category;
    protected $user;

    function __construct(CompanyService $company, CategoryService $category, UserService $user)
    {
        $this->company = $company;
        $this->category = $category;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->company->paginate();
        return view('admin.company.index', compact('companies'));
    }

    public function getAllData()
    {
        return $this->company->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $refId = getRandomInt();
        $categories = $this->category->getCompanyCategories();
        $users = $this->user->companyUsers();
        return view('admin.company.create', compact('categories', 'refId', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        if ($company = $this->company->create($request->all())) {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $company);
            }
            Toastr::success('Company created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.index');
        }
        Toastr::error('Company cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->company->find($id);
        $contactPersons = $this->company->getContactPersons($company);
        $contactDetails = $this->company->getContactDetails($company);
        $socialMedias = $this->company->getSocialMedias($company);
        $jobs = $this->company->getAllJobs($company);
        $activeJobs = $this->company->getActiveJobs($company);
        $candidates = $this->company->getJobApplicants($company);
        $recentJobs = $this->company->getRecentJobs($company);
        return view('admin.company.detail', compact('company', 'contactDetails', 'contactPersons', 'socialMedias', 'jobs', 'activeJobs','candidates','recentJobs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $refId = getRandomInt();
        $company = $this->company->find($id);
        $categories = $this->category->getCompanyCategories();
        $users = $this->user->companyUsers();
        $contactPersons = $this->company->getContactPersons($company);
        $contactDetails = $this->company->getContactDetails($company);
        $socialMedias = $this->company->getSocialMedias($company);


        return view('admin.company.edit', compact('company', 'categories', 'refId', 'users', 'contactPersons', 'contactDetails', 'socialMedias'));
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
        if ($this->company->update($id, $request->all())) {
            if ($request->hasFile('image')) {
                $company = $this->company->find($id);
                $this->uploadFile($request, $company);
            }
            Toastr::success('Company updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.index');
        }
        Toastr::error('Company cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->company->deleteFromAdmin($id)) {
            Toastr::success('Company deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.index');
        }
        Toastr::error('Company cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.index');
    }

    function uploadFile(Request $request, $company)
    {
        $file = $request->file('image');
        $fileName = $this->company->uploadFile($file);
        if (!empty($company->image))
            $this->company->__deleteImages($company);


        $data['image'] = $fileName;
        $this->company->updateImage($company->id, $data);

    }

    public function getCompanyJobs(Request $request, $company = null)
    {
        if (isset($request->type) && $request->type == 'active') {
            $type = 'active';
        } else {
            $type = '';
        }

        $company = $this->company->find($company);
        return view('admin.company.job.index', compact('company','type'));
    }

    public function getAllCompanyJobs($company = null,$type = null)
    {
        $company = $this->company->find($company);
        return $this->company->getAllJobData($company,$type);
    }

    public function getCompanyCandidates($company = null)
    {
        $company = $this->company->find($company);
        return view('admin.company.candidate.index', compact('company','type'));
    }

    public function getAllCompanyCandidates($company = null)
    {
        $company = $this->company->find($company);
        return $this->company->getAllCandidateData($company);
    }

    function getCloneFields(Request $request)
    {
        $fieldName = $request->field_name;
        $divCount = $request->div_count;
        if ($fieldName == 'contact_details') {
            return $this->company->getContactDetailFields($fieldName, $divCount);
        }
        if ($fieldName == 'contact_persons') {
            return $this->company->getContactPersonFields($fieldName, $divCount);
        }
        if ($fieldName == 'social_medias') {
            return $this->company->getSocialMediaFields($fieldName, $divCount);
        }
    }

    function removeFields(Request $request)
    {
        $itemName = $request->item_name;
        $refID = $request->ref_id;
        return $this->company->removeFields($itemName, $refID);
    }
}
