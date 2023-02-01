<?php

namespace App\Http\Controllers\Admin\JobLevel;

use App\Http\Controllers\Controller;
use App\Modules\Service\JobLevel\JobLevelService;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\JobLevel\JobLevelRequest;

class JobLevelController extends Controller
{
    protected $jobLevel;

    function __construct(JobLevelService $jobLevel)
    {
        $this->jobLevel = $jobLevel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobLevels = $this->jobLevel->paginate();
        return view('admin.joblevel.index',compact('jobLevels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.joblevel.create');
    }
    public function getAllData()
    {
        return $this->jobLevel->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobLevelRequest $request)
    {
        if($jobLevel = $this->jobLevel->create($request->all()))
        {
            Toastr::success('Job Level created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-level.index');
        }
        Toastr::error('Job Level cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-level.index');
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
        $jobLevel = $this->jobLevel->find($id);
        return view('admin.joblevel.edit',compact('jobLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobLevelRequest $request, $id)
    {
        if($this->jobLevel->update($id,$request->all()))
        {
            Toastr::success('Job Level updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-level.index');
        }
        Toastr::error('Job Level cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->jobLevel->delete($id))
        {
            Toastr::success('Job Level deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-level.index');
        }
        Toastr::error('Job Level cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-level.index');
    }
}
