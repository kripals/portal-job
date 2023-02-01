<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use App\Modules\Models\JobLevel\JobLevel;
use App\Modules\Models\Subscription\Subscription;
use Kamaln7\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
{
    protected $subscribe;

    function __construct(Subscription $subscribe)
    {
        $this->subscribe = $subscribe;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribes = $this->subscribe->paginate();
        return view('admin.subscription.index',compact('subscribes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscribe.create');
    }
    public function getAllData()
    {
        $query = $this->subscribe->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status',function(Subscription $subscribe){
                return getTableHtml($subscribe,'status');
            })->rawColumns(['status'])
            ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeRequest $request)
    {
        if($subscribe = $this->subscribe->create($request->all()))
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
        $subscribe = $this->subscribe->find($id);
        return view('admin.subscribe.edit',compact('subscribe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscribeRequest $request, $id)
    {
        if($this->subscribe->update($id,$request->all()))
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
        if($this->subscribe->delete($id))
        {
            Toastr::success('Job Level deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('job-level.index');
        }
        Toastr::error('Job Level cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('job-level.index');
    }
}
