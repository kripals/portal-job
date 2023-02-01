<?php

namespace App\Modules\Models\User;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'user_id', 'role_id'
    ];
}
