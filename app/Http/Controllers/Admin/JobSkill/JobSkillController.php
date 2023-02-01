<?php

namespace App\Http\Controllers\Admin\JobSkill;

use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\JobSkill\JobSkillRequest;
use App\Modules\Service\JobSkill\JobSkillService;

class JobSkillController extends Controller
{
    protected $jobSkill;

    function __construct(JobSkillService $jobSkill)
    {
        $this->jobSkill = $jobSkill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobSkills = $this->jobSkill->paginate();
        return view('admin.jobskill.index',compact('jobSkills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobskill.create');
    }
    public function getAllData()
    {
        return $this->jobSkill->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobSkillRequest $request)
    {
        if($jobSkill = $this->jobSkill->create($request->all()))
        {
            Toastr::success('Job Skill created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-skill.index');
        }
        Toastr::error('Job Skill cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-skill.index');
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
        $jobSkill = $this->jobSkill->find($id);
        return view('admin.jobskill.edit',compact('jobSkill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobSkillRequest $request, $id)
    {
        if($this->jobSkill->update($id,$request->all()))
        {
            Toastr::success('Job Skill updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-skill.index');
        }
        Toastr::error('Job Skill cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-skill.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->jobSkill->delete($id))
        {
            Toastr::success('Job Skill deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-skill.index');
        }
        Toastr::error('Job Skill cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-skill.index');
    }
}
