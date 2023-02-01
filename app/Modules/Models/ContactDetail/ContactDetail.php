<?php

namespace App\Modules\Models\ContactDetail;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $fillable= [
        'ref_id','detail_key', 'detail_value', 'contactable_id','contactable_type'
    ];

    public function contactable()
    {
        return $this->morphTo();
    }
}
