<?php

namespace App\Modules\Models\Permission;

use App\Modules\Models\Role\PermissionRole;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name', 'display_name', 'description', 'status', 'is_deleted', 'deleted_at','created_by','last_updated_by','last_deleted_by',
    ];

    protected $appends = [
        'status_text'
    ];

    function getStatusTextAttribute(){
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function permissionRoles(){
        return $this->hasMany(PermissionRole::class);
    }
}
