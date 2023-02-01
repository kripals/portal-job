<?php

namespace App\Http\Controllers\Admin\JobType;

use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\JobType\JobTypeRequest;
use App\Modules\Service\JobType\JobTypeService;

class JobTypeController extends Controller
{protected $jobType;

    function __construct(JobTypeService $jobType)
    {
        $this->jobType = $jobType;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobTypes = $this->jobType->paginate();
        return view('admin.jobtype.index',compact('jobTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobtype.create');
    }
    public function getAllData()
    {
        return $this->jobType->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobTypeRequest $request)
    {
        if($jobType = $this->jobType->create($request->all()))
        {
            Toastr::success('Job Type created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-type.index');
        }
        Toastr::error('Job Type cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-type.index');
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
        $jobType = $this->jobType->find($id);
        return view('admin.jobtype.edit',compact('jobType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobTypeRequest $request, $id)
    {
        if($this->jobType->update($id,$request->all()))
        {
            Toastr::success('Job Type updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-type.index');
        }
        Toastr::error('Job Type cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->jobType->delete($id))
        {
            Toastr::success('Job Type deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-type.index');
        }
        Toastr::error('Job Type cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-type.index');
    }
}
