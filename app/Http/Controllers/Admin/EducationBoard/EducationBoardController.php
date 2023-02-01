<?php

namespace App\Http\Controllers\Admin\EducationBoard;

use App\Http\Controllers\Controller;
use App\Modules\Service\EducationBoard\EducationBoardService;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\EducationBoard\EducationBoardRequest;

class EducationBoardController extends Controller
{
    protected $educationBoard;

    function __construct(EducationBoardService $educationBoard)
    {
        $this->educationBoard = $educationBoard;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educationBoards = $this->educationBoard->paginate();
        return view('admin.educationboard.index',compact('educationBoards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.educationboard.create');
    }
    public function getAllData()
    {
        return $this->educationBoard->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationBoardRequest $request)
    {
        if($educationBoard = $this->educationBoard->create($request->all()))
        {
            Toastr::success('Education Board created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('education-board.index');
        }
        Toastr::error('Education Board cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('education-board.index');
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
        $educationBoard = $this->educationBoard->find($id);
        return view('admin.educationboard.edit',compact('educationBoard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EducationBoardRequest $request, $id)
    {
        if($this->educationBoard->update($id,$request->all()))
        {
            Toastr::success('Education Board updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('education-board.index');
        }
        Toastr::error('Education Board cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('education-board.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->educationBoard->delete($id))
        {
            Toastr::success('Education Board deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('education-board.index');
        }
        Toastr::error('Education Board cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('education-board.index');
    }
}
