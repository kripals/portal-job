<?php

namespace App\Http\Controllers\Admin\UserDetail;

use App\Modules\Service\Role\RoleService;
use App\Modules\Service\User\UserService;
use App\Modules\Service\UserDetail\UserDetailService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class UserDetailController extends Controller
{
    protected $user;
    protected $userDetail;
    protected $role;

    function __construct(
        UserService $userService,
        UserDetailService $userDetailService,
        RoleService $roleService
    )
    {
        $this->user = $userService;
        $this->userDetail = $userDetailService;
        $this->role = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($userID)
    {
//        $user = $this->user->getBySlug($userID);
        $user = $this->user->find($userID);
        $data = $this->getUserRole($user->id);
        $userRoles = $data[1];
        $roles = $data[2];
        $savedRoles = $data[3];
        if($user->userDetails){
            $userDetail = $user->userDetails;
            return view('admin.user.detail.index', compact('user','userDetail', 'userId', 'userRoles', 'roles', 'savedRoles'));
        }
        else
            return view('admin.user.detail.create', compact('user'));
    }

    public function getUserRole($userId){
        $userRoles = $this->user->getUserRole($userId);
        $roles = $this->role->getAllRole();
        $data=[];
        $savedRoles = [];
        foreach ($userRoles as $userRole)
            array_push($savedRoles,$userRole->id);
        $data[1]= $userRoles;
        $data[2]= $roles;
        $data[3]= $savedRoles;
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.detail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->userDetail->create($request->all())) {
            Toastr::success('User created successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);
            return redirect()->route('user.index');
        }
        Toastr::error('User cannot be created', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);
        return redirect()->route('user.create');
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
    public function edit($userSlug, $userDetailSlug)
    {
        $user = $this->user->getBySlug($userSlug);
        $userDetail = $user->userDetails;
        return view('admin.user.detail.edit', compact('user', 'userDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userSlug, $userDetailId)
    {
        $user = $this->user->getBySlug($userSlug);
        if ($this->userDetail->update($userDetailId, $request->all())) {
            Toastr::success('User Detail updated successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);
            return redirect()->route('user.detail.index',[$user->slug])->with('success', 'Category updated successfully.');
        }
        Toastr::error('User Detail cannot be updated', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignRole(Request $request, $userId){
        $roleId = $request->get('role');
        $assignedRoles= $this->user->getUserRole($userId);
        $savedaRoles = [];
        $user = $this->user->getById($userId);
        $data = $this->getUserRole($userId);
        $userRoles = $data[1];
        $roles = $data[2];
        $savedRoles = $data[3];
        $userDetail = $user->userDetails;
        foreach ($assignedRoles as $role)
            array_push($savedaRoles,$role->id);

        $nonSavedROlesId = array_diff($roleId,$savedaRoles);
        if($this->role->assignRole($nonSavedROlesId, $userId)){
            Toastr::success('successfully assigned role to user ', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('user.detail.index', [$user->slug]);
        }else{
            Toastr::error('Role cannot be assingned to user ', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('user.detail.index', [$user->slug]);
        }
    }
}
