<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
include 'admin.php';

Auth::routes(['verify' => true]);

Route::get('sign-up', 'Front\FrontEndController@signUp')->name('signup');
Route::post('company/register', 'Front\Company\CompanyController@register')->name('company.register');
Route::post('candidate/register', 'Front\Candidate\CandidateController@register')->name('candidate.register');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('mailview', 'Front\FrontEndController@mailview')->name('mailview');


Route::group(['middleware' => ['auth']], function ($router) {
    Route::group(['as' => 'candidate.', 'middleware' => ['role:ROLE_CANDIDATE'], 'prefix' => 'candidate'
    ], function ($router) {
//    $router->get('/{candidateId}/dashboard', 'Front\Candidate\CandidateController@dashboard')->name('dashboard');
        $router->get('/dashboard', 'Front\Candidate\CandidateController@dashboard')->name('dashboard');
        $router->get('/my-profile', 'Front\Candidate\CandidateController@candidateProfile')->name('profile');
        $router->get('/applied-jobs', 'Front\Candidate\CandidateController@appliedJobs')->name('applied.jobs');

        $router->post('/fetch/locations', 'Front\Candidate\CandidateController@fetchLocation')->name('fetch.location');
        $router->get('/account-settings', 'Front\Candidate\CandidateController@accountSetting')->name('account-setting');
        $router->post('/change-password', 'Front\Candidate\CandidateController@storeChangePassword')->name('store.change-password');

        $router->get('/edit-profile', 'Front\Candidate\CandidateController@JobPreference')->name('edit-profile');
        $router->put('/update/{candidate}', 'Front\Candidate\CandidateController@updateJobPreference')->name('update.job-pref');

        $router->get('/basic-information', 'Front\Candidate\CandidateController@basicInfo')->name('basic-information');
        $router->post('/store-basic-information/{candidate}', 'Front\Candidate\CandidateController@storeBasicInfo')->name('store.basic.info');

        $router->get('/education', 'Front\Candidate\CandidateController@education')->name('education');
        $router->post('/store-education/{candidate}', 'Front\Candidate\CandidateController@storeEducation')->name('store.education');

        $router->get('/training', 'Front\Candidate\CandidateController@training')->name('training');
        $router->post('/store-training/{candidate}', 'Front\Candidate\CandidateController@storeTraining')->name('store.training');

        $router->get('/work-experience', 'Front\Candidate\CandidateController@workExperience')->name('work-experience');
        $router->post('/store-experience/{candidate}', 'Front\Candidate\CandidateController@storeExperience')->name('store.experience');

        $router->get('/language', 'Front\Candidate\CandidateController@language')->name('language');
        $router->post('/store-language/{candidate}', 'Front\Candidate\CandidateController@storeLanguage')->name('store.language');

        $router->get('/social-account', 'Front\Candidate\CandidateController@socialMedia')->name('social-account');
        $router->post('/store-social-account/{candidate}', 'Front\Candidate\CandidateController@storeSocialMedia')->name('store.social.media');

        $router->get('/reference', 'Front\Candidate\CandidateController@reference')->name('reference');
        $router->post('/store-reference/{candidate}', 'Front\Candidate\CandidateController@storeReference')->name('store.reference');

        $router->get('/others', 'Front\Candidate\CandidateController@others')->name('others');
        $router->post('/store-others/{candidate}', 'Front\Candidate\CandidateController@storeOthers')->name('store.others');

        $router->get('/privacy-control', 'Front\Candidate\CandidateController@privacyControl')->name('privacy-control');
        $router->post('/store-privacy/{candidate}', 'Front\Candidate\CandidateController@storePrivacy')->name('store.privacy');

        $router->post('clone-fields', 'Front\Candidate\CandidateController@getCloneFields')->name('front.cloneFields');
        $router->post('remove-fields', 'Front\Candidate\CandidateController@removeFields')->name('front.removeFields');

        Route::group(['prefix' => 'job', 'as' => 'job.'], function ($router) {
            $router->get('/apply/process/{refId}', 'Front\Job\JobController@jobApply')->name('apply.process');
            $router->get('/apply/{refId}', 'Front\Job\JobController@jobApplicationPost')->name('apply');
        });
    });

    Route::group(['middleware' => ['role:ROLE_COMPANY'], 'prefix' => 'company', 'as' => 'company.'], function ($router) {
        $router->get('/dashboard', 'Front\Company\CompanyController@companyDashboard')->name('dashboard');
        $router->get('/account-settings', 'Front\Company\CompanyController@accountSetting')->name('account-setting');
        $router->post('/change-password', 'Front\Company\CompanyController@storeChangePassword')->name('store.change-password');
        $router->post('/change-display', 'Front\Company\CompanyController@changeDisplayPicture')->name('store.display-picture');
        $router->get('/package', 'Front\Company\CompanyController@packageList')->name('package.list');
        $router->post('/package/purchase', 'Front\Company\CompanyController@packagePurchase')->name('package.purchase');
        $router->post('/package/store', 'Front\Company\CompanyController@packageStore')->name('package.store');
        $router->get('/history', 'Front\Company\CompanyController@purchaseList')->name('purchase.list');

        Route::group(['prefix' => 'profile'], function ($router) {
            $router->get('', 'Front\Company\CompanyController@companyProfile')->name('profile');
            $router->get('edit-profile', 'Front\Company\CompanyController@basicInfo')->name('edit-profile');
            $router->post('/edit-profile/store/{company}', 'Front\Company\CompanyController@updateBasicInfo')->name('update.edit-profile');
            $router->get('/contact-detail', 'Front\Company\CompanyController@contactDetail')->name('contact-detail');
            $router->post('/contact-detail/store/{company}', 'Front\Company\CompanyController@storeContactDetail')->name('store.contact-detail');
            $router->get('/contact-person', 'Front\Company\CompanyController@contactPerson')->name('contact-person');
            $router->post('/contact-person/store/{company}', 'Front\Company\CompanyController@storeContactPerson')->name('store.contact-person');
            $router->get('/service', 'Front\Company\CompanyController@service')->name('service');
            $router->get('/social-media', 'Front\Company\CompanyController@socialMedia')->name('social-media');
            $router->post('/social-media/store/{company}', 'Front\Company\CompanyController@storeSocialMedia')->name('store.social-media');
            $router->post('clone-fields', 'Front\Company\CompanyController@getCloneFields')->name('front.cloneFields');
            $router->post('remove-fields', 'Front\Company\CompanyController@removeFields')->name('front.removeFields');
        });

        Route::group(['prefix' => 'job', 'as' => 'job.'], function ($router) {
            $router->get('/create-job', 'Front\Job\JobController@createJob')->name('create');
            $router->post('/create-job/store', 'Front\Job\JobController@storeUpdateJob')->name('store');
            $router->get('/edit-job/{id}', 'Front\Job\JobController@editJob')->name('edit');
//        $router->post('/update-job/{id}', 'Front\Job\JobController@storeUpdateJob')->name('update');
            $router->post('/update-job/{id}', 'Front\Job\JobController@updateJob')->name('update');
            $router->get('/destroy-job/{id}', 'Front\Job\JobController@destoryJob')->name('destroy');
            $router->get('/specification/{id?}', 'Front\Job\JobController@jobSpecification')->name('specification');
            $router->get('/description/{id?}', 'Front\Job\JobController@jobDescription')->name('description');
            $router->get('/vacancy-setting/{id?}', 'Front\Job\JobController@vacancySetting')->name('vacancy-setting');
            $router->get('/all-jobs', 'Front\Job\JobController@allJobs')->name('all-jobs');
            $router->get('/applications/{id}', 'Front\Job\JobController@applications')->name('applications');
            $router->get('view-resume/{id}', 'Front\Job\JobController@candidateResume')->name('candidate-resume');
            $router->get('/manage-applications/{id}/{action}', 'Front\Job\JobController@manageApplication')->name('action');
        });
    });
    $router->get('/resume/download/{id?}', 'Front\Candidate\CandidateController@downloadResume')->name('candidate.download.resume');
});

//Route::group(['middleware' => ['auth', 'role:ROLE_COMPANY']], function ($router) {
//Candidate Routes
Route::get('/candidate-list/{country?}', 'Front\Candidate\CandidateController@candidateList')->name('candidate.list');
Route::get('/candidate-detail/{id}', 'Front\Candidate\CandidateController@candidateDetail')->name('candidate.detail');
//});
//Job Routes
Route::get('/job-list/{country?}/{type?}', 'Front\Job\JobController@jobList')->name('job.list');
Route::get('/job-detail/{id}', 'Front\Job\JobController@jobDetail')->name('job.detail');

//Company Routes
Route::get('/company-listing', 'Front\Company\CompanyController@companyList')->name('company.listing');
Route::get('/company-detail/{id}', 'Front\Company\CompanyController@companyDetail')->name('company.detail');

Route::get('job/category/{category}', 'Front\Job\JobController@jobByCategory')->name('category.job');

Route::get('/', 'Front\FrontEndController@home')->name('home');
Route::get('/pages/login', 'Front\FrontEndController@logIn')->name('page.login');
Route::get('/blog', 'Front\FrontEndController@blog')->name('blog');
Route::get('/search', 'Front\FrontEndController@search')->name('search');
Route::get('/blog-detail', 'Front\FrontEndController@blogDetail')->name('blog-detail');
Route::get('/browse-candidate-list', 'Front\FrontEndController@browseCandidateList')->name('browse-candidate-list');
Route::get('/pricing', 'Front\FrontEndController@pricing')->name('pricing');
Route::get('/contact', 'Front\FrontEndController@contact')->name('contact');
Route::post('/contact', 'Front\FrontEndController@contactMail')->name('contact.mail');
Route::get('/subscribe', 'Front\FrontEndController@subscribe')->name('newsletter.subscribe');
Route::post('/inquiry', 'Front\FrontEndController@inquiry')->name('contact.inquiry');




