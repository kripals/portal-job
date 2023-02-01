<?php

namespace App\Modules\Models\Reference;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\Candidate\Candidate;

class Reference extends Model
{
    protected $fillable= [
        'ref_id','candidate_id', 'name', 'designation','company_name','address','phone','phone2','email'
    ];

    function candidate(){
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
