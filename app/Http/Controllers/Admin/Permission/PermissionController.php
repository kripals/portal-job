<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Requests\Admin\Permission\PermissionRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use App\Modules\Service\Permission\PermissionService;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $permissionService;
        function  __construct(PermissionService $permissionSer)
        {
            $this->permissionService = $permissionSer;
        }

    public function index()
    {
        $permissions = $this->permissionService->paginate();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        if($this->permissionService->create(request()->all())){
            Toastr::success('Permission created successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('permission.index');
        }else{
            Toastr::error('Permission cannot be created', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('permission.create');
        }
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
        $permission= $this->permissionService->find($id);
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, PermissionUpdateRequest $request)
    {
        $role = $this->permissionService->update($id, $request->all());
        if($role){
            Toastr::success('Permission updated successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('permission.index');
        }else{
            Toastr::error('Permission cannot be updated', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('permission.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->permissionService->delete($id)){
            Toastr::success('Permission deleted successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('permission.index');
        }else{
            Toastr::error('Permission cannot be deleted', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('permission.index');
        }


    }
}
