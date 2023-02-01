<?php

namespace App\Http\Controllers\Admin\JobService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobService\JobServiceRequest;
use App\Modules\Service\JobService\JobServicesService;
use Kamaln7\Toastr\Facades\Toastr;

class JobServiceController extends Controller
{
    protected $JobService;

    function __construct(JobServicesService $JobService)
    {
        $this->JobService = $JobService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $JobServices = $this->JobService->paginate();
        return view('admin.jobservice.index',compact('JobServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobservice.create');
    }
    public function getAllData()
    {
        return $this->JobService->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobServiceRequest $request)
    {
        if($JobService = $this->JobService->create($request->all()))
        {
            Toastr::success('Job Service created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-service.index');
        }
        Toastr::error('Job Service cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-service.index');
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
        $jobService = $this->JobService->find($id);
        return view('admin.jobservice.edit',compact('jobService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobServiceRequest $request, $id)
    {
        if($this->JobService->update($id,$request->all()))
        {
            Toastr::success('Job Service updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-service.index');
        }
        Toastr::error('Job Service cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->JobService->delete($id))
        {
            Toastr::success('Job Service deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-service.index');
        }
        Toastr::error('Job Service cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-service.index');
    }
}
