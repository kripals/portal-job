<?php
/**
 * Created by PhpStorm.
 * User: aarrunyal
 * Date: 30/12/2018
 * Time: 23:44
 */

namespace App\Modules\Service\Permission;


use App\Modules\Models\Permission\Permission;
use App\Modules\Service\Role\RoleService;
use App\Modules\Service\UserRole\UserRoleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\This;

class PermissionService
{

    protected $permission;
    protected $roleService;
    protected $userRole;
    function __construct(
        Permission $permissionModel,
        RoleService $roleSer,
        UserRoleService $userRoleService
    ){
        $this->roleService = $roleSer;
        $this->permission = $permissionModel;
        $this->userRole = $userRoleService;
    }

    public function paginate(array $filter = [])
    {
        $filter['limit'] = 10;
        return $this->permission->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    public function create(array $data)
    {
        $data['created_by'] = Auth::user()->id;
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        try {
            $p = $this->permission->create($data);
            return $p;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return null;
        }
    }

    public  function delete($permissionId){
        try {
            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $data['is_deleted']='yes';
            $data['status']='in_active';
            $p = $this->permission->find($permissionId);
            if($p->update($data)){
                foreach ($p->permissionRoles as $perRole){
                    $this->userRole->deleteRolePermissionByRoleId($perRole->role_id);
                }
                return true;
            }
        } catch (Exception $e) {
            return false;
        }

    }

    public function find($permissionId){
        try {
            return $this->permission->whereIsDeleted('no')->find($permissionId);
        } catch (Exception $e) {
            return null;
        }

    }

    public function update($id, array $data)
    {
        $p = $this->permission->find($id);
        $data['last_updated_by'] = Auth::user()->id;
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        try {
            $p = $p->update($data);
            return $p;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return null;
        }
    }

    public function getAllPermissions(){
        $permissions= $this->permission->where('status','=', 'active')->get();
        return $permissions;
    }

    public function getById($id){
        return $this->role->whereId($id)->first();
    }

    public function assignPermission($permissionArray, $id){
        try{
            $role = $this->roleService->getById($id);
            $permissionArray = $permissionArray;
            foreach ($permissionArray as $p=>$per){
                $value = $this->permission->find($per);
                $role->attachPermission($value);
            }
            return true;
        }catch (Exception $e){
            return false;
        }
    }
}