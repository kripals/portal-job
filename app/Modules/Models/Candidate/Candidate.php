<?php

namespace App\Modules\Models\Candidate;

use App\Modules\Models\Category\Category;
use App\Modules\Models\ContactDetail\ContactDetail;
use App\Modules\Models\Education\Education;
use App\Modules\Models\Experience\Experience;
use App\Modules\Models\CandidateJob\CandidateJob;
use App\Modules\Models\Job\Job;
use App\Modules\Models\JobCountry\JobCountry;
use App\Modules\Models\JobLevel\JobLevel;
use App\Modules\Models\JobLocation\JobLocation;
use App\Modules\Models\JobSkill\JobSkill;
use App\Modules\Models\JobType\JobType;
use App\Modules\Models\Language\Language;
use App\Modules\Models\Reference\Reference;
use App\Modules\Models\SocialMedia\SocialMedia;
use App\Modules\Models\Training\Training;
use App\Modules\Models\User\User;
use App\Modules\Models\UserDetail\UserDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Candidate extends Model
{
    protected $path = 'uploads/candidate';

    protected $fillable = [
        'ref_id', 'category_id', 'user_id', 'user_detail_id', 'job_level_id', 'job_country_id', 'experience_period', 'description',
        'exp_salary_currency', 'exp_salary_type', 'exp_salary_amount', 'exp_salary_rate', 'cur_salary_currency', 'cur_salary_type', 'cur_salary_amount',
        'cur_salary_rate', 'interest', 'specialization', 'current_address', 'nationality', 'marital_status', 'religion', 'birth_date', 'gender', 'permanent_address', 'travel_outside', 'relocate_location',
        'two_wheeler_license', 'four_wheeler_license', 'two_wheeler_vehicle', 'four_wheeler_vehicle', 'resume', 'views', 'keywords', 'visibility', 'status', 'availability', 'is_verified', 'is_deleted', 'order',
        'deleted_at', 'created_by', 'last_updated_by', 'last_deleted_by'
    ];

    protected $appends = [
        'visibility_text', 'status_text', 'availability_text', 'expected_salary', 'current_salary', 'experience_text', 'resume_path', 'candidate_age', 'filter_current_address',
        'filter_permanent_address', 'filter_dob', 'filter_contact_details'
    ];

    public function getRouteKeyName()
    {
        return 'ref_id';
    }

    function getVisibilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->visibility));
    }

    public function setNationalityAttribute($value)
    {
        $this->attributes['nationality'] = ucfirst(strtolower($value));
    }

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function getAvailabilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->availability));
    }

    function getExperienceTextAttribute()
    {
        return $this->experience_period ? $this->experience_period . ' Year(s)' : 'N/A';
    }

    function getCandidateAgeAttribute()
    {
        if (!empty($this->birth_date)) {
            $date = date('Y-m-d', strtotime($this->birth_date));
            return Carbon::parse($date)->age . ' Years';
        } else {
            return "N/A";
        }
    }

    function getResumePathAttribute()
    {
        return $this->path . '/resume/' . $this->resume;
    }

    function getFilterCurrentAddressAttribute()
    {
        $addressControl = '';
        $privacyControl = $this->privacyControl->where('control_key', 'address')->first();
        if(!is_null($privacyControl)) {
            $addressControl = $privacyControl->control_value;

            if (!empty($addressControl) && $addressControl == 'on') {
                return '[Address Protected]';
            }
        }else {
            return ucwords($this->current_address);
        }
    }

    function getFilterPermanentAddressAttribute()
    {
        $addressControl = '';
        $privacyControl = $this->privacyControl->where('control_key', 'address')->first();
        if(!is_null($privacyControl)) {
            $addressControl = $privacyControl->control_value;

            if (!empty($addressControl) && $addressControl == 'on') {
                return '[Address Protected]';
            }

        } else {
            return ucwords($this->permanent_address);
        }
    }

    function getFilterDobAttribute()
    {
        $dobControl = '';
        $privacyControl = $this->privacyControl->where('control_key', 'dob_age')->first();
        if(!is_null($privacyControl)) {
            $dobControl = $privacyControl->control_value;

            if (!empty($dobControl) && $dobControl == 'on') {
                return '[Date Protected]';
            }
        }else {
            return prettyDate($this->birth_date);
        }
    }

    function getFilterContactDetailsAttribute()
    {
        $dobControl = '';
        $privacyControl = $this->privacyControl->where('control_key', 'contact_number')->first();
        if(!is_null($privacyControl)) {
            $contactControl = $privacyControl->control_value;

            if (!empty($contactControl) && $contactControl == 'on') {
                $details = array();
                foreach ($this->contact_details()->get() as $key => $contactDetail) {
                    array_push($details, array('detail_key' => $contactDetail->detail_key,
                        'detail_value' => '[Contact Protected]'));
                }
//            dd($details);
                return $details;
            }
        }else {
            return $this->contact_details()->get()->toArray();
        }

    }

    function getExpectedSalaryAttribute()
    {
        $rate = $this->exp_salary_rate;
        if ($rate == 'hourly') {
            $rate = 'hr';
        } elseif ($rate == 'monthly') {
            $rate = 'mnt';
        } else {
            $rate = $rate;
        }
        return $this->exp_salary_amount ? ucwords($this->exp_salary_currency) . ' ' . $this->exp_salary_amount . ' / ' . $rate : 'N/A';
    }

    function getCurrentSalaryAttribute()
    {
        $rate = $this->cur_salary_rate;
        if ($rate == 'hourly') {
            $rate = 'hr';
        } elseif ($rate == 'monthly') {
            $rate = 'mnt';
        } else {
            $rate = $rate;
        }
        return ucwords($this->cur_salary_currency) . $this->cur_salary_amount . '/' . $rate;
    }

    function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }

    public function reference()
    {
        return $this->hasMany(Reference::class);
    }

    public function language()
    {
        return $this->hasMany(Language::class);
    }

    public function contact_details()
    {
        return $this->morphMany(ContactDetail::class, 'contactable');
    }

    public function job_level()
    {
        return $this->belongsTo(JobLevel::class, 'job_level_id');
    }

    public function job_types()
    {
        return $this->belongsToMany(JobType::class);
    }

    public function job_country()
    {
        return $this->belongsTo(JobCountry::class, 'job_country_id');
    }

    public function preferred_locations()
    {
        return $this->belongsToMany(JobLocation::class);
    }

    public function known_skills()
    {
        return $this->belongsToMany(JobSkill::class);
    }

    public function social_medias()
    {
        return $this->morphMany(SocialMedia::class, 'socialable');
    }

    public function privacyControl()
    {
        return $this->morphMany(PrivacyControl::class, 'controlable');
    }

    public function job_applications()
    {
        return $this->belongsToMany(Job::class)->withPivot('ref_id', 'status')
            ->withTimestamps();
    }

}
