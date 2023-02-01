<?php

namespace App\Modules\Models\Company;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    protected $fillable= [
      'ref_id','company_id', 'person_name', 'person_designation','person_email','person_number','contact_type'
    ];

    public function setRefIdAttribute($value)
    {
        $this->attributes['ref_id'] = getRandomInt();
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
}
