<?php

namespace App\Modules\Models\Package;

use Illuminate\Database\Eloquent\Model;

class CompanyPackage extends Model
{

    protected $fillable = [
        'order_id', 'company_id', 'package_id', 'quantity','discount'
    ];

}
