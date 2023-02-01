<?php

namespace App\Modules\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class PrivacyControl extends Model
{
    protected $fillable = [
        'ref_id','control_key', 'control_value', 'controlable_id','controlable_type'
        ];

    public function controlable()
    {
        return $this->morphTo();
    }
}
