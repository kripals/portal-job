<?php

namespace App\Http\Controllers\Admin\JobLocation;

use App\Http\Controllers\Controller;
use App\Modules\Service\JobCountry\JobCountryService;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\JobLocation\JobLocationRequest;
use App\Modules\Service\JobLocation\JobLocationService;

class JobLocationController extends Controller
{
    protected $jobLocation;
    protected $jobCountry;

    function __construct(JobCountryService $jobCountry,JobLocationService $jobLocation)
    {
        $this->jobLocation = $jobLocation;
        $this->jobCountry = $jobCountry;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($countrySlug)
    {
        $jobCountry = $this->jobCountry->getBySlug($countrySlug);
        $jobLocations = $this->jobLocation->paginate();
        return view('admin.joblocation.index',compact('jobLocations','jobCountry'));
    }

    public function getAllData($countrySlug)
    {
        $jobCountry = $this->jobCountry->getBySlug($countrySlug);
        return $this->jobLocation->getAllData($jobCountry);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($countrySlug = null)
    {
        $jobCountry = $this->jobCountry->getBySlug($countrySlug);
        return view('admin.joblocation.create',compact('jobCountry'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobLocationRequest $request,$countryId)
    {
        $jobCountry=$this->jobCountry->find($countryId);
        if($jobLocation = $this->jobLocation->create($request->all(),$jobCountry->id))
        {
            Toastr::success('Job Location created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('country.job-location.index',$jobCountry->slug);
        }
        Toastr::error('Job Location cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('country.job-location.index',$jobCountry->slug);
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
    public function edit($countrySlug,$id)
    {
        $jobCountry = $this->jobCountry->getBySlug($countrySlug);
        $jobLocation = $this->jobLocation->find($id);
        return view('admin.joblocation.edit',compact('jobLocation','jobCountry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobLocationRequest $request,$countryId, $id)
    {
        $jobCountry=$this->jobCountry->find($countryId);
        if($this->jobLocation->update($id,$request->all(),$jobCountry->id))
        {
            Toastr::success('Job Location updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('country.job-location.index',$jobCountry->slug);
        }
        Toastr::error('Job Location cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('country.job-location.index',$jobCountry->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($countrySlug,$id)
    {
        $jobCountry = $this->jobCountry->getBySlug($countrySlug);
        if($this->jobLocation->delete($id))
        {
            Toastr::success('Job Location deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('country.job-location.index',$jobCountry->slug);
        }
        Toastr::error('Job Location cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('country.job-location.index',$jobCountry->slug);
    }
}
