<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Company\CompanyService;
use App\Modules\Service\Job\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $company;
    protected $candidate;
    protected $job;

    function __construct(CandidateService $candidate,CompanyService $company,JobService $job)
    {
        $this->middleware('admin');
        $this->candidate = $candidate;
        $this->company = $company;
        $this->job = $job;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->job->all();
        $employers = $this->company->all();
        $candidates = $this->candidate->all();
        $applications = $this->job->getAllApplications();
        return view('admin.dashboard.index',compact('jobs','employers','candidates','applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
