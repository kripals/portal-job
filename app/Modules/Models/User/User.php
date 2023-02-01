<?php

namespace App\Modules\Models\User;

use App\Modules\Models\Candidate\Candidate;
use App\Modules\Models\Company\Company;
use App\Modules\Models\Role\Role;
use App\Modules\Models\UserDetail\UserDetail;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     *
     */

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }

    protected $path = 'uploads/user';
    protected $fillable = [
        'first_name', 'slug',
        'middle_name', 'last_name',
        'username', 'email',
        'password',
        'email_verified_at',
        'status', 'last_logged_in',
        'no_of_logins',
        'avatar', 'last_deleted_by', 'deleted_at', 'is_deleted'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['last_login', 'full_name', 'thumbnail_path', 'image_path', 'status_text'];

    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middle_name'] = ucfirst(strtolower($value));
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }

    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }

    function getLastLoginAttribute()
    {
        $now = Carbon::now();
        if (!empty($this->last_logged_in))
            return Carbon::createFromTimeStamp(strtotime($this->last_logged_in))->diffForHumans();

    }

    function getFullNameAttribute()
    {
        return ucfirst(strtolower($this->first_name)) . " " . ucfirst(strtolower($this->middle_name)) . " " . ucfirst(strtolower($this->last_name));
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class);
    }


    function getImagePathAttribute()
    {
        if (!empty($this->avatar)) {
            return $this->path . '/' . $this->avatar;
        } else {
            if ($this->hasRole('ROLE_CANDIDATE')) {
                if ($this->candidate->gender == 'female') {
                    return 'resources/frontend/assets/img/female-avatar.jpg';
                } else {
                    return 'resources/frontend/assets/img/user.png';
                }
            } else {
                return 'resources/frontend/assets/img/user.png';
            }
        }
    }

    function getThumbnailPathAttribute()
    {
        $imageControl = '';
        if ($this->hasRole('ROLE_CANDIDATE')) {
            foreach ($this->candidate->privacyControl as $privacyControl) {
                if ($privacyControl->control_key == 'profile_image') {
                    $imageControl = $privacyControl->control_value;
                }
            }
            if (!empty($this->avatar)) {
                if (!empty($imageControl) && $imageControl == 'on') {
                    if ($this->candidate->gender == 'female') {
                        return 'resources/frontend/assets/img/female-avatar.jpg';
                    } else {
                        return 'resources/frontend/assets/img/user.png';
                    }
                } else {
                    return $this->path . '/thumb/' . $this->avatar;
                }
            } else {
                if ($this->candidate->gender == 'female') {
                    return 'resources/frontend/assets/img/female-avatar.jpg';
                } else {
                    return 'resources/frontend/assets/img/user.png';
                }
            }
        } elseif (!empty($this->avatar)) {
            return $this->path . '/thumb/' . $this->avatar;
        } else {
            return 'resources/frontend/assets/img/noimage.png';
        }
    }

    function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    function company()
    {
        return $this->hasOne(Company::class);
    }

    function candidate()
    {
        return $this->hasOne(Candidate::class);
    }

}
