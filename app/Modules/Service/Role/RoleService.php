<?php
/**
 * Created by PhpStorm.
 * User: aarrunyal
 * Date: 30/12/2018
 * Time: 23:44
 */

namespace App\Modules\Service\Role;


use App\Modules\Models\Role\Role;
use App\Modules\Models\User\User;
use App\Modules\Service\User\UserDetailService;
use App\Modules\Service\User\UserService;
use App\Modules\Service\UserRole\UserRoleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RoleService
{

    protected $userService;
    protected $role;
    protected $userRole;
    function __construct(
        UserService $userSer,
        Role $roleModel,
        UserRoleService $userRoleSer
    ){
        $this->userService = $userSer;
        $this->role = $roleModel;
        $this->userRole = $userRoleSer;
    }

    public function paginate(array $filter = [])
    {
        $filter['limit'] = 10;
        return $this->role->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    public function getAllData()
    {
        $query = Role::where('is_deleted','=', 'no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status', function(Role $role) {
                return getTableHtml($role,'status');
            })
            ->editColumn('actions', function(Role $role) {
                $editRoute = route('role.edit',[$role->id]);
                $deleteRoute = route('role.delete',[$role->id]);
                $uploadRoute = false;
                $optionRoute = route('role.permission', $role->id);
                $optionRouteText = 'Assign Permission';

                return getTableHtml($role,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['status','actions'])
            ->order(function ($query) {

                $query->orderBy('id', 'desc');
            })
            ->make(true);
    }
    

    public function create(array $data)
    {
        $data['created_by'] = Auth::user()->id;
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        try {
            $r = $this->role->create($data);
            return $r;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return null;
        }
    }

    public  function delete($roleId){
        try {
            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $data['is_deleted']='yes';
            $data['status']='in_active';
            $r = $this->role->find($roleId);
            if($r->update($data)){
                foreach ($r->roleUsers as $userRole){
                    $this->userRole->deleteUserRoleByRoleId($userRole->role_id);
                }
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }


    public function find($roleId){
        try {
            return $this->role->whereIsDeleted('no')->find($roleId);
        } catch (Exception $e) {
            return null;
        }

    }

    public function update($id, array $data)
    {
        $r = $this->role->find($id);
        $data['last_updated_by'] = Auth::user()->id;
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        try {
            $r = $r->update($data);
            return $r;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return null;
        }
    }

    public function getAssignedPermission($id){
        try{
            $role = Role::with('permissions')->find($id);
            $per = $role->permissions;
            return $per;
        }catch (Exception $e){
            return false;
        }
    }

    public function getAllRole(){
        $roles = Role::where('status','=', 'active')->get();
        return $roles;
    }

    public function assignRole($roleArray, $id){
        try{
            $user  = $this->userService->getById($id);
            $roleArray = $roleArray;
            foreach ($roleArray as $r=>$ro){
                $user->roles()->attach($ro);
            }
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    public function getById($id){
        return $this->role->whereId($id)->first();
    }

}