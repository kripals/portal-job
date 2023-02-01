<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Requests\Admin\Role\RoleRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Modules\Service\Permission\PermissionService;
use App\Modules\Service\Role\RoleService;
use App\Http\Controllers\Controller;
use App\Modules\Service\UserRole\UserRoleService;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $roleService;
    protected $permissionService;
    protected $userRoleService;
        function  __construct(
            RoleService $roleSer,
            PermissionService $permissionSer,
            UserRoleService $userRoleSer
        )
        {
            $this->roleService = $roleSer;
            $this->permissionService = $permissionSer;
            $this->userRoleService = $userRoleSer;
        }

    public function index()
    {
        $roles = $this->roleService->paginate();
        return view('admin.role.index', compact('roles'));
    }

    public function getAllData(){
            return $this->roleService->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if($this->roleService->create(request()->all())){
            Toastr::success('Role created successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.index');
        }else{
            Toastr::error('Role cannot be created', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.create');
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
        $role = $this->roleService->find($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, RoleUpdateRequest $request)
    {
        $role = $this->roleService->update($id, $request->all());
        if($role){
            Toastr::success('Role updated successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.index');
        }else{
            Toastr::error('Role cannot be created', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.edit');
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
        if($this->roleService->delete($id)){
            Toastr::success('Role deleted successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.index');
        }else{
            Toastr::error('Role cannot be deleted', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.index');
        }
    }


    //return all permission assingned to roles
    public function getPermissionOfRole($roleId){
        $assignedPermissions = $this->roleService->getAssignedPermission($roleId);
        $savedPermissions = [];
        foreach ($assignedPermissions as $per)
            array_push($savedPermissions,$per->id);

        $permissions = $this->permissionService->getAllPermissions();
        return view('admin.role.permission.permission-index', compact('roleId','assignedPermissions','permissions','savedPermissions'));
    }

    public function assignPermission(Request $request, $roleId){
        $permissionId = $request->get('permissions');
        $assignedPermissions = $this->roleService->getAssignedPermission($roleId);
        $savedPermissions = [];
        foreach ($assignedPermissions as $per)
            array_push($savedPermissions,$per->id);

        $nonSavedArrayIds = array_diff($permissionId,$savedPermissions);

        if($this->permissionService->assignPermission($nonSavedArrayIds, $roleId)){
            Toastr::success('Role assigned to user successfully', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.permission', [$roleId]);
        }else{
            Toastr::error('Role cannot be assingned to user ', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.permission', [$roleId]);
        }
    }


    public function deletePermission($roleId, $perId){
        if($this->userRoleService->deleteRolePermissionByPermissionId($perId)){
            Toastr::success("Role's permission deleted successfully", 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.permission', [$roleId]);
        }else{
            Toastr::error("Role's permission cannot be deleted ", 'Error !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('role.permission', [$roleId]);
        }
    }
}
