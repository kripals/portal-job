<?php

namespace App\Modules\Models\Training;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\Candidate\Candidate;

class Training extends Model
{
    protected $fillable= [
        'ref_id','candidate_id', 'name', 'agency_name','start_date','end_date'
    ];


    function candidate(){
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
