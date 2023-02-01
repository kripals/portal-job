<?php

namespace App\Modules\Models\Language;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\User\User;
use App\Modules\Models\Candidate\Candidate;
use Cviebrock\EloquentSluggable\Sluggable;

class Language extends Model
{
    protected $fillable= [
        'ref_id','candidate_id', 'name', 'reading','writing','speaking','listening'
    ];


    function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    function candidate(){
        return $this->belongsTo(Candidate::class,'candidate_id');
    }
}
