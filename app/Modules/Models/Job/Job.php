<?php

namespace App\Modules\Models\Job;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Category\Category;
use App\Modules\Models\Company\Company;
use App\Modules\Models\JobCountry\JobCountry;
use App\Modules\Models\JobLevel\JobLevel;
use App\Modules\Models\JobService\JobService;
use App\Modules\Models\JobSkill\JobSkill;
use App\Modules\Models\JobType\JobType;
use App\Modules\Models\SubCategory\SubCategory;
use App\Modules\Models\User\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class   Job extends Model
{
    use Sluggable;

    protected $path = 'uploads/job';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'ref_id','title', 'slug','company_id','job_service_id','vacancy_number','job_level_id','job_country_id','job_type_id','category_id','end_date','location',
        'min_salary_currency','min_salary_type','min_salary_amount','min_salary_rate','max_salary_currency','max_salary_type','max_salary_amount','max_salary_rate',
        'education_requirement','education_level','experience_requirement','experience_type','experience_value','skill_requirement','specification',
        'description','apply_online','gender_specific','gender','age_specific','age_type','age_value','show_company',
        'status', 'visibility', 'availability', 'is_verified','is_deleted','order','deleted_at', 'created_by', 'last_updated_by','image','company_name','source','apply_procedure',
        'last_deleted_by', 'created_by', 'last_updated_by', 'last_deleted_by'];

    protected $appends = [
       'visibility_text', 'status_text', 'availability_text', 'verified_text','experience_text','job_age','job_expiry','minimum_salary','maximum_salary','expiry_date','offered_salary', 'image_path', 'thumbnail_path', 'check_expiry'
    ];


    function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    function getTitleAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    function getVisibilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->visibility));
    }

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function getAvailabilityTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->availability));
    }

    function getVerifiedTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->is_verified));
    }

    function getImagePathAttribute()
    {
        if (!empty($this->image)) {
            return $this->path . '/' . $this->image;
        } else {
            return 'resources/admin/img/noimage.png';
        }

    }

    function getThumbnailPathAttribute()
    {
        if (!empty($this->image)) {
            return $this->path . '/thumb/' . $this->image;
        } else {
            return 'resources/admin/img/avatar7.jpg';
        }
    }

    function getExperienceTextAttribute()
    {
        if($this->experience_type == 'more-than-equal'){
            $experienceText = 'More than or equals to';
        }elseif ($this->experience_type == 'less-than-equal'){
            $experienceText = 'Less than or equals to';
        }else{
            $experienceText = str_replace('-',' ',$this->experience_type);
        }
        return ucwords($experienceText.' '.$this->experience_value.' year(s)');
    }

    function getExpiryDateAttribute()
    {
        return Carbon::parse($this->end_date)->format('d M Y g:i');
    }

    function getMinimumSalaryAttribute()
    {
        $rate = $this->min_salary_rate;
        if($rate == 'hourly'){
            $rate = 'hr';
        }elseif($rate == 'monthly'){
            $rate = 'mnt';
        }else{
            $rate = $rate;
        }
        return ucwords($this->min_salary_currency).$this->min_salary_amount.'/'.$rate;
    }

    function getMaximumSalaryAttribute()
    {
        $rate = $this->max_salary_rate;
        if($rate == 'hourly'){
            $rate = 'hr';
        }elseif($rate == 'monthly'){
            $rate = 'mnt';
        }else{
            $rate = $rate;
        }
        return ucwords($this->max_salary_currency).$this->max_salary_amount.'/'.$rate;
    }

    function getOfferedSalaryAttribute()
    {
        if(!empty($this->min_salary_amount) && !empty($this->max_salary_amount)) {
            $minRate = $this->min_salary_rate;
            $maxRate = $this->max_salary_rate;
            if ($minRate == 'hourly') {
                $minRate = 'hr';
            } elseif ($minRate == 'monthly') {
                $minRate = 'mnt';
            } else {
                $minRate = $minRate;
            }

            if ($maxRate == 'hourly') {
                $maxRate = 'hr';
            } elseif ($maxRate == 'monthly') {
                $maxRate = 'mnt';
            } else {
                $maxRate = $maxRate;
            }

            if ($this->min_salary_type != 'equals') {
                $minSalType = ucwords($this->min_salary_type);
            } else {
                $minSalType = '';
            }

            if ($this->max_salary_type != 'equals') {
                $maxSalType = ucwords($this->max_salary_type);
            } else {
                $maxSalType = '';
            }

            if ($this->min_salary_amount === $this->max_salary_amount) {
                return $minSalType . ' ' . ucwords($this->min_salary_currency) . ' ' . number_format($this->min_salary_amount) . ' / ' . ucwords($minRate);
            }

            if (empty($this->min_salary_amount)) {
                return $minSalType . ' ' . ucwords($this->max_salary_currency) . ' ' . number_format($this->max_salary_amount) . ' / ' . ucwords($maxRate);
            }

            if (empty($this->max_salary_amount)) {
                return $minSalType . ' ' . ucwords($this->min_salary_currency) . ' ' . number_format($this->min_salary_amount) . ' / ' . ucwords($minRate);
            }
        }else{

            return "Negotiable";
        }

        return $minSalType.' '.ucwords($this->min_salary_currency).' '.number_format($this->min_salary_amount).' / '.ucwords($minRate).' - '.$maxSalType.' '.ucwords($this->max_salary_currency).' '.number_format($this->max_salary_amount).' / '.ucwords($maxRate);
    }

    function getJobAgeAttribute()
    {
        $dt     = Carbon::parse($this->created_at);
        return $dt->diffForHumans();
    }

    function getJobExpiryAttribute()
    {
        $dt     = Carbon::parse($this->end_date);
        $now = Carbon::now();
        $diff = $dt->diffInDays($now);
//        $days = $diff->d;
        if($diff == 0 || $dt->lt($now)){
            return "Expired";
        }
        return $diff.' Day(s)';
    }

    function getCheckExpiryAttribute()
    {
        $dt     = Carbon::parse($this->end_date);
        $now = Carbon::now();
        $diff = $dt->diffInDays($now);
//        $days = $diff->d;
        if($diff == 0 || $dt->lt($now)){
            return true;
        }
        return false;
    }

    function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    function job_service()
    {
        return $this->belongsTo(JobService::class,'job_service_id');
    }

    function job_level()
    {
        return $this->belongsTo(JobLevel::class,'job_level_id');
    }

    function job_type()
    {
        return $this->belongsTo(JobType::class,'job_type_id');
    }

    function job_country()
    {
        return $this->belongsTo(JobCountry::class,'job_country_id');
    }

    function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    function sub_categories()
    {
        return $this->belongsToMany(SubCategory::class);
    }

    function skills()
    {
        return $this->belongsToMany(JobSkill::class);
    }

    function applicants()
    {
        return $this->belongsToMany(Candidate::class)->withPivot('ref_id','status')
            ->withTimestamps();
    }
}
