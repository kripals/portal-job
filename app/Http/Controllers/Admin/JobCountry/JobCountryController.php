<?php

namespace App\Http\Controllers\Admin\JobCountry;

use App\Http\Controllers\Controller;
use App\Modules\Service\JobCountry\JobCountryService;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\JobCountry\JobCountryRequest;

class JobCountryController extends Controller
{
    protected $jobCountry;

    function __construct(JobCountryService $jobCountry)
    {
        $this->jobCountry = $jobCountry;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobCountrys = $this->jobCountry->paginate();
        return view('admin.jobcountry.index',compact('jobCountrys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobcountry.create');
    }
    public function getAllData()
    {
        return $this->jobCountry->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCountryRequest $request)
    {
        if($jobCountry = $this->jobCountry->create($request->all()))
        {
            Toastr::success('Job Country created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-country.index');
        }
        Toastr::error('Job Country cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-country.index');
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
        $jobCountry = $this->jobCountry->find($id);
        return view('admin.jobcountry.edit',compact('jobCountry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobCountryRequest $request, $id)
    {
        if($this->jobCountry->update($id,$request->all()))
        {
            Toastr::success('Job Country updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-country.index');
        }
        Toastr::error('Job Country cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->jobCountry->delete($id))
        {
            Toastr::success('Job Country deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-country.index');
        }
        Toastr::error('Job Country cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-country.index');
    }
}
