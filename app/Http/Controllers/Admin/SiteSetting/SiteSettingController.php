<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Requests\Admin\SiteSetting\SiteSettingRequest;
use App\Modules\Service\SiteSetting\SiteSettingService;
use Kamaln7\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
  protected $siteSetting;

  function __construct(SiteSettingService $siteSetting)
  {
    $this->siteSetting = $siteSetting;
  }  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $siteSetting = $this->siteSetting->find(1);
    return view('admin.sitesetting.edit',compact('siteSetting'));
  }

    public function edit()
    {
        $siteSetting = $this->siteSetting->find(1);
        return view('admin.sitesetting.edit',compact('siteSetting'));
    }
  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {

    $siteSetting = $this->siteSetting->find($id);
  if($this->siteSetting->update($id,$request->all()))
  {

    if ($request->hasFile('image') || $request->hasFile('sub_image') ) {
      $this->uploadFile($request, $siteSetting);
    }
      Toastr::success('Site Content updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
      return redirect()->route('sitesetting.index');
    }
    Toastr::error('Site Content cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
    return redirect()->route('sitesetting.index');
  }

  function uploadFile(Request $request, $siteSetting)
  {
    $file = $request->file('image');
    $file2 = $request->file('sub_image');
    $fileName = $this->siteSetting->uploadFile($file);
    $fileName2 = $this->siteSetting->uploadFile($file2);
    if (!empty($siteSetting->image) || !empty($siteSetting->sub_image))
    $this->siteSetting->__deleteImages($siteSetting);


    $data['image'] = $fileName;
    $data['sub_image'] = $fileName2;

    $this->siteSetting->updateImage($siteSetting->id, $data);

  }
}
