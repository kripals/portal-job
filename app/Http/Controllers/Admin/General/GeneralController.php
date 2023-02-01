<?php

namespace App\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    function getUploadForm(Request $request)
    {
        return view('admin.general.upload-form',compact('request'));
    }
}
