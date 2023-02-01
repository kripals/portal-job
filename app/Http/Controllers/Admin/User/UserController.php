<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests\Admin\User\UserPasswordUpdateRequest;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Modules\Service\Role\RoleService;
use App\Modules\Service\User\UserService;
use App\Modules\Service\UserRole\UserRoleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;
    protected $role;
    protected $userRole;
    function  __construct(
        UserService $userSer,
        RoleService $roleSer,
        UserRoleService $userRoleSer
    )
    {
        $this->user = $userSer;
        $this->role = $roleSer;
        $this->userRole = $userRoleSer;
    }
    public function index()
    {
        $users = $this->user->getAllUser();
        return view('admin.user.index', compact('users'));
    }

    public function getAllData()
    {
        return $this->user->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($this->user->create($request->all())) {
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
        $user = $this->user->find($id);
        $data = $this->getUserRoles($user->id);

        $savedRoles = $data[1];
//dd($data);
        return view('admin.user.profile', compact('user','savedRoles'));

//        if($user->userDetails){
//            $userDetail = $user->userDetails;
//            return view('admin.user.detail.index', compact('user','userDetail', 'userId', 'userRoles', 'roles', 'savedRoles'));
//        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        return view('admin.user.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if ($this->user->update($id, $request->all())) {
            Toastr::success('User updated successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);

            return redirect()->route('user.index')->with('success', 'Category updated successfully.');
        }
        Toastr::error('User cannot be updated', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('user.edit', [$id]);

    }

    public function updatePassword(UserPasswordUpdateRequest $request, $id)
    {
        if ($this->user->updatePassword($id, $request->all())) {
            Toastr::success('User updated successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);

            return redirect()->route('user.show',$id)->with('success', 'Category updated successfully.');
        }
        Toastr::error('User cannot be updated', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);

        return redirect()->route('user.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->user->delete($id)) {
            Toastr::success('User deleted successfully', 'Success !!!', ['positionClass' => 'toast-bottom-right']);
            return redirect()->route('user.index');
        }
        Toastr::error('User cannot be deleted', 'Oops !!!', ['positionClass' => 'toast-bottom-right']);
        return redirect()->route('user.index');

    }

    public function getUserRole($userId){
        $user = $this->user->find($userId);
        $userRoles = $this->user->getUserRole($userId);
        $roles = $this->role->getAllRole();
        $savedRoles = [];
        foreach ($userRoles as $userRole)
            array_push($savedRoles,$userRole->id);
        return view('admin.user.role.role-index', compact( 'user', 'userRoles', 'roles', 'savedRoles'));
    }

    public function getUserRoles($userId){
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


    public function assignRole(Request $request, $id){
        $roleId = $request->get('role');
        $assignedRoles= $this->user->getUserRole($id);
        $savedaRoles = [];
        foreach ($assignedRoles as $role)
            array_push($savedaRoles,$role->id);

        $nonSavedROlesId = array_diff($roleId,$savedaRoles);
        if($this->role->assignRole($nonSavedROlesId, $id)){
            Toastr::success('successfully assigned role to user ', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('user.index');
        }else{
            Toastr::error('Role cannot be assingned to user ', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('user.index');
        }
    }

    public function deleteUserRole($userId, $roleId){
        if($this->userRole->deleteUserRoleByRoleId($roleId)){
            Toastr::success("User's role deleted successfully", 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('user.role', [$userId]);
        }else{
            Toastr::error("User's role cannot be deleted ", 'Error !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('user.role', [$userId]);
        }
    }

    function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = $this->user->uploadFile($file);
        $user = $this->user->find($request->get('id'));
        if(!empty($user->avatar))
            $this->user->__deleteImages($user);


        $data['avatar'] = $fileName;
        $this->user->updateImage($user->id,$data);
        Toastr::success('Image uploaded successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
        return response()->json(['route'=>route('user.index')]);
    }

    public function specificRoleUser(Request $request){
        $filterVal = $request->get('filter');
        $val = $filterVal['filters'][0]['value'];
        $users = $this->user->getspecificUser($val);
        return $users;
    }
}
