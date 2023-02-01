<?php

namespace App\Modules\Service\SiteSetting;
use App\Modules\Models\SiteSetting\SiteSetting;
use Carbon\Carbon;
use App\Modules\Service\Service;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SiteSettingService extends Service
{
  protected $siteSetting;

  public function __construct(SiteSetting $siteSetting){
    $this->siteSetting = $siteSetting;
  }

  public function find($siteSettingId)
  {
    try {
      return $this->siteSetting->find($siteSettingId);
    } catch (Exception $e) {
      return null;
    }
  }

  public function update($siteSettingId, array $data)
  {
    try {
      $siteSetting= $this->siteSetting->find($siteSettingId);
      $siteSetting = $siteSetting->update($data);
      return $siteSetting;
    } catch (Exception $e) {
      //$this->logger->error($e->getMessage());
      return false;
    }
  }
  function uploadFile($file)
  {
    if (!empty($file)) {
      $this->uploadPath = 'uploads/siteSetting';
      return $fileName = $this->uploadFromAjax($file);
    }
  }

  public function __deleteImages($subCat)
  {
    try {
      if (is_file($subCat->image_path))
      unlink($subCat->image_path);

      if (is_file($subCat->thumbnail_path))
      unlink($subCat->thumbnail_path);
    } catch (\Exception $e) {

    }
  }

  public function updateImage($siteSettingId, array $data)
  {
    try {

      $siteSetting = $this->siteSetting->find(1);
      $siteSetting = $siteSetting->update($data);

      return $siteSetting;
    } catch (Exception $e) {
      //$this->logger->error($e->getMessage());
      return false;
    }
  }
  /**
  * Get all User
  *
  * @return Collection
  */
  public function all()
  {
      return $this->siteSetting->all();
  }


}
