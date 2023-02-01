<?php

namespace App\Modules\Models\SocialMedia;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Models\User\User;
use App\Modules\Models\Candidate\Candidate;

class SocialMedia extends Model
{
    protected $fillable= [
        'ref_id','media_key', 'media_value', 'socialable_id','socialable_type'
    ];

    protected $table = 'social_medias' ;

    public function socialable()
    {
        return $this->morphTo();
    }
}
