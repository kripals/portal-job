<?php

namespace App\Modules\Models\UserDetail;

use App\Modules\Models\Company\Company;
use App\Modules\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

    protected $fillable = [
        'user_id','father_name','mother_name','grand_father_name','spouse_name','nationality','citizenship_no','passport_no','issue_place',
        'date_of_birth','gender','marital_status','contact_home','contact_office','personal_mobile_1','personal_mobile_2','permanent_house_no',
        'permanent_tole','permanent_ward_no','permanent_city','permanent_district','permanent_state','permanent_country', 'permanent_mailing_address',
        'temporary_house_no','temporary_tole','temporary_city','temporary_ward_no','temporary_district','temporary_state','temporary_country','temporary_mailing_address',
        'website','fax','is_deleted``deleted_at','created_by','last_updated_by','last_deleted_by','status','availability','exit_date','facebook','twitter','instagram','google_plus',
        'language', 'linkdin', 'youtube'
    ];

    protected $appends = [
        'visibility_text','status_text', 'availability_text', 'thumbnail_path', 'image_path'
    ];

    function getVisibilityTextAttribute(){
        return ucwords(str_replace('_', ' ', $this->visibility));
    }

    function getStatusTextAttribute(){
        return ucwords(str_replace('_', ' ', $this->status));
    }
    function getAvailabilityTextAttribute(){
        return ucwords(str_replace('_', ' ', $this->availability));
    }

    function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
