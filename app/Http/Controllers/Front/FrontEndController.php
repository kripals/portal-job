<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\UserSignInRequest;
use App\Mail\ContactFormMailNotifiable;
use App\Mail\InquiryNotifiable;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Subscription\Subscription;
use App\Modules\Service\Advertisement\AdvertisementService;
use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\Company\CompanyService;
use App\Modules\Service\Job\JobService;
use App\Modules\Service\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Service\FrontEnd\GeneralService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Kamaln7\Toastr\Facades\Toastr;

class FrontEndController extends Controller
{
    protected $generalService;
    protected $category;
    protected $userService;
    protected $job;
    protected $candidate;
    protected $company;
    protected $subscribe;
    protected $advertisement;

    function __construct(
        GeneralService $generalService,
        CategoryService $category,
        UserService $userService,
        JobService $job,
        CandidateService $candidate,
        Subscription $subscribe,
        CompanyService $company,
        AdvertisementService $advertisement
    )
    {
        $this->generalService = $generalService;
        $this->category = $category;
        $this->userService = $userService;
        $this->job = $job;
        $this->candidate = $candidate;
        $this->company = $company;
        $this->subscribe = $subscribe;
        $this->advertisement = $advertisement;
    }

    public function home()
    {
        $categories = $this->generalService->getFeaturedCategories(6);
        $searchCategories = $this->generalService->getSearchCategory();
        $testimonials = $this->generalService->getTestimonials();
        $candidates = $this->generalService->getHomeTopCandidates();
        $companies = $this->generalService->getCompanies();
        $featuredJobs = $this->generalService->getJobsByType('featured');
        $hotJobs = $this->generalService->getJobsByType('hot');
        $newspaperJobs = $this->generalService->getJobsByType('newspaper');
        return view('frontend.index', compact(  'categories', 'testimonials','candidates','companies','hotJobs','featuredJobs','searchCategories','newspaperJobs'));
    }

    public function signUp()
    {
        $ads = $this->advertisement->getAds('register');
        $companyCategories = $this->category->companyCategoriesFront();
        $candidateCategories = $this->category->candidateCategoriesFront();
        $ads = $this->advertisement->getAds('register');
        return view('frontend.signup', compact('companyCategories', 'candidateCategories','ads'));
    }

    public function signIn()
    {
        return view('frontend.signin');
    }

    public function userSignIn(UserSignInRequest $request)
    {

    }

    public function logIn()
    {
        return view('frontend.login');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetail()
    {
        return view('frontend.blog-detail');
    }

    public function candidateDashboard()
    {
        return view('frontend.candidate.candidate-dashboard');
    }

    public function browseCandidateList()
    {
        return view('frontend.candidate.browse-candidate-list');
    }


    public function jobPreference()
    {
        return view('frontend.candidate.candidate-details.job-preference');
    }

    public function basicInfo()
    {
        return view('frontend.candidate.candidate-details.basicinfo');
    }

    public function education()
    {
        return view('frontend.candidate.candidate-details.education');
    }

    public function training()
    {
        return view('frontend.candidate.candidate-details.training');
    }

    public function language()
    {
        return view('frontend.candidate.candidate-details.language');
    }

    public function workExperience()
    {
        return view('frontend.candidate.candidate-details.work-experience');
    }

    public function reference()
    {
        return view('frontend.candidate.candidate-details.reference');
    }

    public function socialAccount()
    {
        return view('frontend.candidate.candidate-details.social-account');
    }

    public function companyList()
    {
        return view('frontend.company.company-listing');
    }

    public function pricing()
    {
        return view('frontend.pricing');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactMail(Request $request)
    {
        $mailParam = [
            'full_name' => $request->full_name,
            'email_address' => $request->email_address,
            'phone_number' => $request->phone_number,
            'subject' => $request->subject,
            'inquiry_message' => $request->inquiry_message
        ];

        Mail::to('info@legendszone.com.np')->send(new ContactFormMailNotifiable($mailParam));
        Toastr::success('Contact Inquiry Send Successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $searchCategories = $this->generalService->getSearchCategory();
        $featuredCategories = $this->generalService->getFeaturedCategories(12);
        $featuredCompanies = $this->generalService->getFeaturedCompanies();

        $searchFor = $request->search_for;
        $searchCategory = $request->search_category;
        $searchKeyword = $request->search_keyword;
        if($searchFor == 'job'){
            $ads = $this->advertisement->getAds('job-list');
            $jobs = $this->job->getJobBySearch($searchCategory,$searchKeyword);
            return view('frontend.jobs.job-listing', compact('jobs','searchCategories','featuredCategories','featuredCompanies','ads'));
        }

        if($searchFor == 'candidate'){

            $ads = $this->advertisement->getAds('candidate-list');
            $candidates = $this->candidate->getCandidateBySearch($searchCategory, $searchKeyword);

            if (Auth::guard('web')->check() && Auth::user()->hasRole(['ROLE_COMPANY'])) {
                return view('frontend.candidate.candidate-list', compact('candidates', 'searchCategories','featuredCategories','featuredCompanies','ads'));
            }else{
                return view('frontend.validate', compact('candidates','searchCategories','featuredCategories'));
            }
        }

    }

    public function subscribe(Request $request)
    {
        $email = $request->email;
        $check = $this->subscribe->whereEmail($email)->first();
        if($check === null){
            $subscribe = $this->subscribe->create(['email'=>$email]);
            if($subscribe){
                return "Email subscription successful.";
            }
            else{
                return "Email subscription failed.";
            }
        }else{
            return "This email is already subscribed.";
        }
    }

    public function inquiry(Request $request)
    {
        $mailParam = [
            'name' => $request->full_name,
            'email' => $request->email_address,
            'message' => $request->message
        ];

        Mail::to('info@legendszone.com.np')->send(new InquiryNotifiable($mailParam));
        Toastr::success('Inquiry Send Successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);

        return redirect()->back();

    }

    public function mailview()
    {
        $candidate = $this->candidate->find(3);
        $company = $this->company->find(2);
        $job = $this->job->find(42);
        return view('frontend.mail.application-mail',compact('candidate','company','job'));
    }
}
