<?php

namespace App\Http\Controllers\Front\Company;

use App\Http\Requests\Front\Company\CompanyBasicInfoRequest;
use App\Http\Requests\Front\Company\CompanyRegisterRequest;
use App\Http\Requests\Front\Company\CompanyContactDetailRequest;
use App\Http\Requests\Front\Company\CompanyContactPersonRequest;
use App\Http\Requests\Front\Company\CompanySocialMediaRequest;
use App\Http\Requests\Front\User\UserPasswordUpdateRequest;
use App\Modules\Models\User\User;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Company\CompanyService;
use App\Http\Requests\Admin\Company\CompanyRequest;
use App\Modules\Service\Package\PackageService;
use App\Modules\Service\User\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class CompanyController extends Controller
{
    protected $company;
    protected $category;
    protected $user;
    protected $userService;
    protected $package;

    function __construct(CompanyService $company, CategoryService $category, User $user, UserService $userService, PackageService $package)
    {
        $this->company = $company;
        $this->category = $category;
        $this->user = $user;
        $this->userService = $userService;
        $this->package = $package;
    }

    public function companyList()
    {
        $companies = $this->company->all();
        return view('frontend.company.company-listing',compact('companies'));
    }

    public function companyProfile()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        return view('frontend.company.profile',compact('company'));
    }

    public function companyDetail($id = null)
    {
        $company = $this->company->findByRefId($id);
        $company->increment('views');
        $companyJobs = $this->company->getCompanyDetailJobs($company->id);

        return view('frontend.company.company-detail',compact('company','companyJobs'));
    }

    public function register(CompanyRegisterRequest $request)
    {

        event(new Registered($user = $this->user->create($request->all())));
//        $user = $this->userService->create($request->all());
        if (!empty($user)) {
            $role = $this->userService->attachRegisterRole($user, 'company');
            $this->company->registerCompany($user, $request->all());
            Toastr::success('Company registration successful. Registration will be verified within 24hrs.', 'Success !!!', ['positionClass' => 'toast-bottom-right']);
            return redirect()->route('login');
        }
        Toastr::error('Company Registration process failed. Please try again.', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);
        return redirect()->route('signup');

    }

    public function companyDashboard()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $jobs = $this->company->getCompanyJobs($company->id);
        $recentJobs = $this->company->getCompanyJobs($company->id,5);
        $matchingCandidates = $this->company->getMatchingCandidates($company);
        $applicants = $this->company->getJobApplicants($company);
        $expiredJobs = $this->company->getExpiredJobs($company);
        return view('frontend.company.company-dashboard', compact('company','jobs','recentJobs','matchingCandidates','applicants','expiredJobs'));
    }

    public function accountSetting()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        return view('frontend.company.account-setting', compact('company'));
    }

    public function storeChangePassword(UserPasswordUpdateRequest $request)
    {
        $user = auth()->id();

        $this->userService->updateUserPassword($user, $request->all());

        Toastr::success('Password updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.account-setting');
    }

    public function changeDisplayPicture(Request $request)
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        if ($request->hasFile('image')) {
            $this->uploadFile($request, $company);
        }
        Toastr::success('Picture updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.account-setting');
    }

    public function basicInfo()
    {
        $user = auth()->id();
        $categories = $this->category->getCompanyCategories();
        $company = $this->userService->getCompany($user);
        return view('frontend.company.edit-profile.basic-profile-info', compact('categories', 'company'));
    }

    public function updateBasicInfo(CompanyBasicInfoRequest $request, $company)
    {
        if ($company = $this->company->updateBasicInfo($company, $request->all())) {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $company);
            }
            Toastr::success('Company updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.edit-profile');
        }
        Toastr::error('Company cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.edit-profile');
    }

    public function contactDetail()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $contactDetails = $this->company->getContactDetails($company);
        return view('frontend.company.edit-profile.contact-detail', compact('company', 'contactDetails'));
    }

    public function storeContactDetail(CompanyContactDetailRequest $request, $company)
    {
        if ($company = $this->company->storeContactDetail($company, $request->all())) {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $company);
            }
            Toastr::success('Company Contact Detail created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.contact-detail');
        }
        Toastr::error('Company Contact Detail cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.contact-detail');
    }

    public function contactPerson()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $contactPersons = $this->company->getContactPersons($company);
        return view('frontend.company.edit-profile.contact-person', compact('company','contactPersons'));
    }

    public function storeContactPerson(CompanyContactPersonRequest $request, $company)
    {
        if ($company = $this->company->storeContactPerson($company, $request->all())) {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $company);
            }
            Toastr::success('Company Contact Person created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.contact-person');
        }
        Toastr::error('Company Contact Person cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.contact-person');
    }

    public function service()
    {
        return view('frontend.company.edit-profile.service');
    }

    public function socialMedia()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $socialMedias = $this->company->getSocialMedias($company);
        return view('frontend.company.edit-profile.social-account', compact('company','socialMedias'));
    }

    public function storeSocialMedia(CompanySocialMediaRequest $request, $company)
    {
        if ($company = $this->company->storeSocialMedia($company, $request->all())) {
            Toastr::success('Company Socials updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.social-media');
        }
        Toastr::error('Company Socials cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('company.social-media');
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    function getCloneFields(Request $request)
    {
        $fieldName = $request->field_name;
        $divCount = $request->div_count;
        if ($fieldName == 'contact_details') {
            return $this->company->getFrontContactDetailFields($fieldName, $divCount);
        }
        if($fieldName == 'contact_persons'){
            return $this->company->getFrontContactPersonFields($fieldName,$divCount);
        }
        if($fieldName == 'social_medias'){
            return $this->company->getFrontSocialMediaFields($fieldName,$divCount);
        }
    }

    function removeFields(Request $request)
    {
//        dd($request);
        $itemName = $request->item_name;
        $refID = $request->ref_id;
        return $this->company->removeFields($itemName, $refID);
    }

    function packageList()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        $jobPackages = $this->package->getByType('job');
        $resumePackages = $this->package->getByType('resume');
        return view('frontend.company.package',compact('jobPackages','company','resumePackages'));
    }

    function packagePurchase(Request $request)
    {
        $packageDetail = $this->package->findBySlug($request->package);
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        if(isset($request->submit)){
            if($this->package->purchasePackage($company,$packageDetail,$request->all())){
                Toastr::success('Package purchased successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('company.purchase.list');
            }
            Toastr::error('Package purchase failed. Try Again', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('company.purchase.list');

        }

        return view('frontend.company.package-invoice',compact('packageDetail','company'));
    }

    function purchaseList()
    {
        $user = auth()->id();
        $company = $this->userService->getCompany($user);
        return view('frontend.company.package-history',compact('company'));
    }
}
