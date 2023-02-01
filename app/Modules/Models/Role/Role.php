<?php

namespace App\Modules\Models\Role;

use App\Modules\Models\Permission\Permission;
use App\Modules\Models\User\RoleUser;
use App\Modules\Models\User\User;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name', 'display_name', 'description', 'status', 'is_deleted', 'deleted_at','created_by','last_updated_by','last_deleted_by',
    ];

    protected $appends = [
         'status_text'
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function roleUsers(){
        return $this->hasMany(RoleUser::class);
    }

    function getStatusTextAttribute(){
        return ucwords(str_replace('_', ' ', $this->status));
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
