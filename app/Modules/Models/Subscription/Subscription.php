<?php

namespace App\Modules\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['email','status','is_deleted','deleted_at'];

    protected $appends = [
        'status_text'
    ];

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }
}
