<?php

use App\Modules\Models\User\User;
use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Job\Job;
use \App\Modules\Models\JobCountry\JobCountry;
use Illuminate\Support\Facades\Auth;
use \App\Modules\Models\Candidate\PrivacyControl;

/**
 * Created by PhpStorm.
 * User: Sujit
 * Date: 12/30/2018
 * Time: 7:20 PM
 */

function monthsDays($year, $month)
{
    $list = [];

    for ($d = 1; $d <= 31; $d++) {
        $time = mktime(12, 0, 0, $month, $d, $year);
        if (date('m', $time) == $month)
            $list[] = date('d', $time);
    }

    return $list;
}

function getLabel($status)
{

    $label = '';
    switch ($status) {
        case 'yes' :
            $label = 'label label-success';
            break;

        case 'no' :
            $label = 'label label-danger';
            break;

        case 'active' :
            $label = 'label label-success';
            break;

        case 'in_active' :
            $label = 'label label-danger';
            break;

        case 'shortlisted' :
            $label = 'label label-success';
            break;

        case 'pending' :
            $label = 'label label-warning';
            break;

        case 'rejected' :
            $label = 'label label-danger';
            break;

        case 'visible' :
            $label = 'label label-success';
            break;

        case 'invisible' :
            $label = 'label label-danger';
            break;

        case 'available' :
            $label = 'label label-success';
            break;

        case 'not_available' :
            $label = 'label label-danger';
            break;

    }

    return $label;
}

function getStatusIcons($status)
{

    $label = '';
    switch ($status) {
        case 'Active' :
            $label = 'check';
            break;

        case 'In Active' :
            $label = 'times';
            break;

        case 'yes' :
            $label = 'check';
            break;

        case 'no' :
            $label = 'times';
            break;

        case 'visible' :
            $label = 'visibility';
            break;

        case 'invisible' :
            $label = 'visibility_off';
            break;

        case 'available' :
            $label = 'label label-success';
            break;

        case 'not_available' :
            $label = 'label label-danger';
            break;

    }

    return $label;
}

function delete_form($url, $label = 'Delete', $class = '', $title = '', $isButton = true)
{
    $form = Form::open(['method' => 'DELETE', 'url' => $url, 'class' => 'deleteContentForm']);
    if ($isButton) {
        $form .= "<button type='submit' style='border: none; background: none; cursor: pointer;' class='' data-toggle='confirmation' data-title='Confirm delete?' class='$class  deleteContentButton' title='$title' data-toggle='tooltip' data-placement='top' data-original-title='$title'>";

        $form .= '<i class="uk-icon-trash-o uk-icon-small"> delete</i>  </button> ';
    } else {
        $form .= "<span class='deleteContentButton'><i
                                        class='glyph-icon icon-trash'
                                        aria-hidden='true'></i> $label </span>";
    }
    return $form .= Form::close();
}

function printr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
//    die;
}

function prettyDate($data)
{
    return date('d M Y', strtotime($data));
}

function defaultDateFormat($date, $format = 'Y-m-d')
{
    if ($date == '0000-00-00' || empty($date))
        return '-';

    return date($format, strtotime($date));
}

function formatDate($date, $format = 'Y-m-d', $onlyMonthYear = false)
{
    if ($date == '0000-00-00' || empty($date))
        return '-';
    $formatOption = getOptions('date_format');
    $format = $formatOption ? $formatOption : $format;

    return date($format, strtotime($date));
}

function getYear($date)
{
    $parse = \Carbon\Carbon::parse($date);
    $year = $parse->year;
    return $year;
}

function formatDateTime($dateTime, $requestedFormat = '')
{
    if ($dateTime == '0000-00-00 00:00:00' || empty($dateTime))
        return '-';
    $formatOption = getOptions('date_format') ? getOptions('date_format') . ' h:i a' : 'Y-m-d H:i:s';
    $format = $requestedFormat ? $requestedFormat : $formatOption;

    return date($format, strtotime($dateTime));
}


function moneyFormat($amount, $showFormat = true)
{

    if (!$showFormat)
        return round($amount, 2);

    if ($amount < 0) {
        return '(' . number_format($amount * -1, 2) . ')';
    } else {
        return number_format($amount, 2);
    }
}


function randomPassword()
{
    $str = "";
    $characters = array_merge(range('A', 'C'), range('a', 'c'), range('1', '3'));
    $max = count($characters) - 1;
    for ($i = 0; $i < 8; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}


function numberToRoman($number)
{
    $map = array('m' => 1000, 'cm' => 900, 'd' => 500, 'cd' => 400, 'c' => 100, 'xc' => 90, 'l' => 50, 'xl' => 40, 'x' => 10, 'ix' => 9, 'v' => 5, 'iv' => 4, 'i' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if ($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}

function numberToAlpha($data)
{
    $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    $alpha_flip = array_flip($alphabet);
    if ($data <= 25) {
        return $alphabet[$data];
    } elseif ($data > 25) {
        $dividend = ($data + 1);
        $alpha = '';
        $modulo = '';
        while ($dividend > 0) {
            $modulo = ($dividend - 1) % 26;
            $alpha = $alphabet[$modulo] . $alpha;
            $dividend = floor((($dividend - $modulo) / 26));
        }
        return $alpha;
    }

}

function jobCount()
{
    return Job::whereStatus('active')->count();
}

function companyCount()
{
    return Company::whereStatus('active')->count();
}

function candidateCount()
{
    return Candidate::whereStatus('active')->count();
}


function compareInfo($old, $new)
{
    if ($old == '0')
        return true;

    if ($old == $new)
        return true;
    else
        return false;
}


function getMonths()
{
    $months = array('01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',

    );
    return $months;

}

function getImageRatio($name)
{
    $option = \App\Modules\Models\Option\Option::where('name', '=', $name)->first();
    if (!empty($option))
        return explode('/', $option->value);
    else {
        $option = \App\Modules\Models\Option\Option::where('name', '=', 'default_image_ratio')->first();
        return explode('/', $option->value);
    }

}

function candidateAll($country = null, $limit = null)
{
//    dd(auth()->user()->roles()->first()->name);
    if (Auth::user() && Auth::user()->hasRole(['ROLE_COMPANY'])) {
        $regNo = auth()->user()->company->company_reg_no;
        $candidateRejects = PrivacyControl::where('control_key','company_pan')->where('control_value',$regNo)->pluck('controlable_id');
        if ($country) {
            if ($country == 'nepal') {
                $country = JobCountry::whereSlug('nepal')->first();
                $candidate = Candidate::whereStatus('active')->whereIsDeleted('no')->whereJobCountryId($country->id)->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->whereNotIn('id',$candidateRejects)->paginate(30);
                return $candidate;
            } else {
                $country = JobCountry::whereSlug('nepal')->first();
                return Candidate::whereStatus('active')->whereIsDeleted('no')->orderBy('order', 'ASC')->whereAvailability('available')->whereIsVerified('yes')->whereNotIn('job_country_id', [$country->id])->paginate(30);
            }
        } elseif ($limit) {
            return Candidate::whereIsDeleted('no')->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->paginate(30);
        } else {
            return Candidate::whereIsDeleted('no')->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->get();
        }
    } else {
        return Candidate::whereIsDeleted('no')->whereAvailability('available')->whereIsVerified('yes')->orderBy('order', 'ASC')->get();
    }
}

function getRandomInt()
{
    $pin = mt_rand(1000, 9999)
        . mt_rand(1000, 9999);
    $string = str_shuffle($pin);
    return $string;
}

function getRandomOrderInt()
{
    $pin = mt_rand(10, 99)
        . mt_rand(10, 99);
    $string = str_shuffle($pin);
    return $string;
}

function getUsername($id)
{
    $user = \App\Modules\Models\User\User::find($id)->name;
    dd($user);

}

function explodeString($delimeter, $string)
{

    if (str_contains($string, $delimeter))
        return explode($delimeter, $string);

    return false;
}

function getTableHtml($object, $type, $editRoute = null, $deleteRoute = null, $optionalMenuRoute = null, $optionalMenuText = null, $optional2MenuRoute = null, $optional2MenuText = null, $uploadRoute = null, $details = null)
{
    switch ($type) {
        case 'visibility':
            return '<span class="' . getLabel($object->visibility) . '">' . $object->visibility_text . '</span>';
            break;
        case 'availability':
            return '<span class="' . getLabel($object->availability) . '">' . $object->availability_text . '</span>';
            break;
        case 'has_subcategory':
            return '<span data-uk-tooltip title="' . $object->has_subcategory_text . '" class="' . getLabel($object->has_subcategory) . '"><i class="material-icons" style="color: white;">' . getStatusIcons($object->has_subcategory) . '</i></span>';
            break;
        case 'job_types':
            return '<span class="label">' . $object->jobtypes->name . '</span>';
            break;
        case 'position':
            return '<span class="label">' . $object->positions->name . '</span>';
            break;
        case 'status':
            return '<span data-uk-tooltip title="' . $object->status_text . '" class="' . getLabel($object->status) . '">' . $object->status_text . '</span>';
            break;
        case 'is_verified':
            return '<span data-uk-tooltip title="' . $object->is_verified . '" class="' . getLabel($object->is_verified) . '">' . $object->is_verified . '</span>';
            break;
        case 'created_by':
            if (str_contains($object->creator->thumbnail_path, '.')) {
                return '<span class=""><a href="' . route('user.detail.index', $object->creator->slug) . '" class="user_action_image">
                    <img data-uk-tooltip title="' . $object->creator->full_name . '" class="md-user-image " src=' . asset($object->creator->thumbnail_path) . ' alt=""/></a>';
                break;
            } else {
                return '<span class=""><a href="' . route('user.detail.index', $object->creator->slug) . '" class="user_action_image">
                    <img data-uk-tooltip title="' . $object->creator->full_name . '" class="md-user-image " src=' . asset('resources/admin/assets/img/avatars/user.png') . ' alt=""/></a>';
                break;
            }

        case 'associated_user':
            if (!empty($object->user->id)) {
                return '<a href="' . route('user.show', $object->user->id) . '" class="user_action_image">
                    <img data-uk-tooltip title="' . $object->user->full_name . '" class="md-user-image " src=' . asset($object->user->thumbnail_path) . ' alt=""/>
                    </a>';
            } else {
                return '<a href="#" class="user_action_image">
                    <img class="md-user-image" src=' . asset("resources/admin/img/user.png") . ' alt=""/>
                    </a>';
            }
        case 'actions':
            return view('admin.general.table-actions', compact('object', 'editRoute', 'deleteRoute', 'uploadRoute', 'optionalMenuRoute', 'optionalMenuText', 'optional2MenuRoute', 'optional2MenuText', 'details'));
            break;

        case 'image':
            return view('admin.general.lightbox', compact('object'));
            break;

        case 'roles':
            $role = '';
            foreach ($object->roles as $k => $v) {
                $role = $role . ' <span class="label label-success">' . $v->display_name . '</span>';
            }
            return $role;
            break;

        case 'username':
            $username = '<a href="' . route('user.detail.index', $object->slug) . '">' . $object->username . '</a>';
            return $username;
            break;

        case 'user_name':
            if (!empty($object->user->id)) {
                $username = '<a href="' . route('user.detail.index', $object->user->id) . '">' . $object->user->full_name . '</a>';
                return $username;
            } else {
                return "N/A";
            }
            break;
        case 'candidate_skills':
            if (!empty($object->known_skills)) {
                $skills = '';
                foreach ($object->known_skills as $skill) {
                    $skills .= "<span class=\"label label-info\">" . $skill->title . "</span>";
                }
                return $skills;
            } else {
                return 'N/A';
            }
    }
}

