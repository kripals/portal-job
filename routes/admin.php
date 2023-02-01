<?php
/**
 * Created by PhpStorm.
 * User: Sujit
 * Date: 12/27/2018
 * Time: 11:35 PM
 */

Route::get('admin/login', 'CustomAuth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'CustomAuth\AdminLoginController@login')->name('admin.login');
Route::get('admin/logout', 'CustomAuth\AdminLoginController@logout')->name('admin.logout');

Route::group(['middleware' => ['admin','role:ROLE_SUPERADMIN'], 'prefix' => 'admin'], function ($router) {

    $router->get('dashboard', 'Admin\Dashboard\DashboardController@index')->name('admin.dashboard');

    //user, roles and permission route
    $router->resource('role', 'Admin\Role\RoleController');
    $router->get('role-data', 'Admin\Role\RoleController@getAllData')->name('role.data');
    $router->get('role/{id}/destroy', 'Admin\Role\RoleController@destroy')->name('role.delete');

    $router->resource('permission', 'Admin\Permission\PermissionController');
    $router->resource('user', 'Admin\User\UserController');
    $router->post('user/update-password/{id}', 'Admin\User\UserController@updatePassword')->name('user.update.password');
    $router->get('user-data', 'Admin\User\UserController@getAllData')->name('user.data');
//    $router->resource('user.detail', 'Admin\UserDetail\UserDetailController');

    $router->get('user/{id}/roles', 'Admin\User\UserController@getUserRole')->name('user.role');
    $router->post('user/{id}/role-assign', 'Admin\User\UserController@assignRole')->name('user-role.assign');
    $router->post('user/{id}/details', 'Admin\UserDetail\UserDetailController@assignRole')->name('user-detail.role.assign');
    $router->get('user/{userId}/role/{roleId}/delete', 'Admin\User\UserController@deleteUserRole')->name('user-role.delete');
    $router->get('user/{id}/edit-profile', 'Admin\User\UserController@userProfile')->name('user.edit-profile');
    $router->get('user/{id}/destroy', 'Admin\User\UserController@destroy')->name('user.delete');
    $router->post('user-upload-image', 'Admin\User\UserController@uploadFile')->name('user.upload-image');
    $router->post('user-with-specific-role', 'Admin\User\UserController@specificRoleUser')->name('user-with-specific-role');
    $router->get('site-setting', 'Admin\UserDetail\UserDetailController@siteSettingView')->name('site-setting');

    $router->get('role/{roleId}/permissions', 'Admin\Role\RoleController@getPermissionOfRole')->name('role.permission');
    $router->post('role/{roleId}/permission-assign', 'Admin\Role\RoleController@assignPermission')->name('role-permission.assign');
    $router->get('role/{roleId}/permission/{perId}/delete', 'Admin\Role\RoleController@deletePermission')->name('role-permission .delete');


    //Company And Candidate Category
    $router->get('{type}/category', 'Admin\Category\CategoryController@index')->name('category.index');
    $router->get('{type}/category-data', 'Admin\Category\CategoryController@getAllData')->name('category.data');
    $router->get('{type}/category/create', 'Admin\Category\CategoryController@create')->name('category.create');
    $router->post('{type}/category/store', 'Admin\Category\CategoryController@store')->name('category.store');
    $router->get('{type}/category/{category}/edit', 'Admin\Category\CategoryController@edit')->name('category.edit');
    $router->post('{type}/category/{category}/update', 'Admin\Category\CategoryController@update')->name('category.update');
    $router->get('{type}/category/{id}/destroy', 'Admin\Category\CategoryController@destroy')->name('category.destroy');
    $router->post('category-upload-image', 'Admin\Category\CategoryController@uploadFile')->name('category.upload-image');

    $router->resource('category.subcategory', 'Admin\SubCategory\SubCategoryController');
    $router->post('subcategory-upload-image', 'Admin\SubCategory\SubCategoryController@uploadFile')->name('subcategory.upload-image');
    $router->get('category/{slug}/subcategory/{id}/destroy', 'Admin\SubCategory\SubCategoryController@destroy')->name('category.subcategory.destroy');
    $router->get('sub-category-data/{slug}', 'Admin\SubCategory\SubCategoryController@getAllData')->name('subcategory.data');


    //Company resources route
    $router->resource('company', 'Admin\Company\CompanyController');
    $router->get('company/{id}/destroy', 'Admin\Company\CompanyController@destroy')->name('company.destroy');
    $router->get('company-data', 'Admin\Company\CompanyController@getAllData')->name('company.data');
    $router->post('company-upload-image', 'Admin\Company\CompanyController@uploadFile')->name('company.upload-image');
    $router->post('company-clone-fields', 'Admin\Company\CompanyController@getCloneFields')->name('company.cloneFields');
    $router->post('company-remove-fields', 'Admin\Company\CompanyController@removeFields')->name('remove.companyFields');
    $router->get('company/job/{company}', 'Admin\Company\CompanyController@getCompanyJobs')->name('company.job');
    $router->get('company/job-data/{company}/{type?}', 'Admin\Company\CompanyController@getAllCompanyJobs')->name('company.job.data');
    $router->get('company/candidate/{company}', 'Admin\Company\CompanyController@getCompanyCandidates')->name('company.candidate');
    $router->get('company/candidate-data/{company}', 'Admin\Company\CompanyController@getAllCompanyCandidates')->name('company.candidate.data');

    //Job Resources route
    $router->resource('job', 'Admin\Job\JobController');
    $router->get('job/{id}/destroy', 'Admin\Job\JobController@destroy')->name('job.destroy');
    $router->get('job/applicants/list', 'Admin\Job\JobController@listApplicants')->name('job.applicant.list');
    $router->get('job-data', 'Admin\Job\JobController@getAllData')->name('job.data');
    $router->get('job-applicant-data', 'Admin\Job\JobController@getAllApplicantData')->name('job.applicant.data');
    $router->get('job/candidate/{job}', 'Admin\Job\JobController@getJobCandidates')->name('job.candidate');
    $router->get('job/candidate-data/{job}', 'Admin\Job\JobController@getAllJobCandidates')->name('job.candidate.data');


    //Candidate resources route
    $router->resource('candidate', 'Admin\Candidate\CandidateController');
    $router->get('candidate/{id}/destroy', 'Admin\Candidate\CandidateController@destroy')->name('candidate.destroy');
    $router->get('candidate-data', 'Admin\Candidate\CandidateController@getAllData')->name('candidate.data');
    $router->get('candidate-resume/{id}', 'Admin\Candidate\CandidateController@viewResume')->name('candidate.view-resume');
    $router->post('candidate-clone-fields', 'Admin\Candidate\CandidateController@getCloneFields')->name('candidate.cloneFields');
    $router->post('candidate-remove-fields', 'Admin\Candidate\CandidateController@removeFields')->name('remove.candidateFields');
    $router->get('candidate/job/{candidate}', 'Admin\Candidate\CandidateController@getCandidateJobs')->name('candidate.job');
    $router->get('candidate/job-data/{candidate}', 'Admin\Candidate\CandidateController@getAllCandidateJobs')->name('candidate.job.data');

    //Settings Control Routes
    $router->group(['prefix' => 'setting'], function ($router) {
        $router->resource('job-level', 'Admin\JobLevel\JobLevelController');
        $router->get('job-level/{id}/destroy', 'Admin\JobLevel\JobLevelController@destroy')->name('job-level.destroy');
        $router->get('job-level-data', 'Admin\JobLevel\JobLevelController@getAllData')->name('job-level.data');

        $router->resource('country.job-location', 'Admin\JobLocation\JobLocationController');
        $router->get('country/{slug}/job-location/{id}/destroy', 'Admin\JobLocation\JobLocationController@destroy')->name('job-location.destroy');
        $router->get('job-location-data/{slug}', 'Admin\JobLocation\JobLocationController@getAllData')->name('job-location.data');

        $router->resource('job-country', 'Admin\JobCountry\JobCountryController');
        $router->get('job-country/{id}/destroy', 'Admin\JobCountry\JobCountryController@destroy')->name('job-country.destroy');
        $router->get('job-country-data', 'Admin\JobCountry\JobCountryController@getAllData')->name('job-country.data');

        $router->resource('job-skill', 'Admin\JobSkill\JobSkillController');
        $router->get('job-skill/{id}/destroy', 'Admin\JobSkill\JobSkillController@destroy')->name('job-skill.destroy');
        $router->get('job-skill-data', 'Admin\JobSkill\JobSkillController@getAllData')->name('job-skill.data');

        $router->resource('job-type', 'Admin\JobType\JobTypeController');
        $router->get('job-type/{id}/destroy', 'Admin\JobType\JobTypeController@destroy')->name('job-type.destroy');
        $router->get('job-type-data', 'Admin\JobType\JobTypeController@getAllData')->name('job-type.data');

        $router->resource('job-service', 'Admin\JobService\JobServiceController');
        $router->get('job-service/{id}/destroy', 'Admin\JobService\JobServiceController@destroy')->name('job-service.destroy');
        $router->get('job-service-data', 'Admin\JobService\JobServiceController@getAllData')->name('job-service.data');

        $router->resource('{type}/package', 'Admin\Package\PackageController');
        $router->get('package/{id}/destroy', 'Admin\Package\PackageController@destroy')->name('package.destroy');
        $router->get('package-data/{type}', 'Admin\Package\PackageController@getAllData')->name('package.data');

        $router->resource('education-board', 'Admin\EducationBoard\EducationBoardController');
        $router->get('education-board/{id}/destroy', 'Admin\EducationBoard\EducationBoardController@destroy')->name('education-board.destroy');
        $router->get('education-board-data', 'Admin\EducationBoard\EducationBoardController@getAllData')->name('education-board.data');

        $router->resource('advertisement', 'Admin\Advertisement\AdvertisementController');
        $router->get('advertisement/{id}/destroy', 'Admin\Advertisement\AdvertisementController@destroy')->name('advertisement.destroy');
        $router->get('advertisement-data', 'Admin\Advertisement\AdvertisementController@getAllData')->name('advertisement.data');
    });


    //FrontControl Routes
    $router->resource('testimonial', 'Admin\Testimonial\TestimonialController');
    $router->get('testimonial/{id}/destroy', 'Admin\Testimonial\TestimonialController@destroy')->name('testimonial.destroy');
    $router->get('testimonial-data', 'Admin\Testimonial\TestimonialController@getAllData')->name('testimonial.data');
    $router->post('testimonial-upload-image', 'Admin\Testimonial\TestimonialController@uploadFile')->name('testimonial.upload-image');

    $router->resource('subscriber', 'Admin\Subscription\SubscriptionController');
    $router->get('subscribe-data', 'Admin\Subscription\SubscriptionController@getAllData')->name('subscribe.data');

    $router->resource('sitesetting', 'Admin\SiteSetting\SiteSettingController');
});
