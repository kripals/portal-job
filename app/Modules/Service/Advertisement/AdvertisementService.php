<?php namespace

App\Modules\Service\Advertisement;

use App\Modules\Models\Advertisement\Advertisement;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class AdvertisementService extends Service
{
    protected $advertisement;

    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->advertisement->whereIsDeleted('no');

        return DataTables::of($query)
            ->addIndexColumn()
             ->editColumn('image', function (Advertisement $advertisement) {
                return getTableHtml($advertisement, 'image');
            })
             ->editColumn('type', function (Advertisement $advertisement) {
                return ucwords(str_replace('-',' ',$advertisement->type));
            })
            ->editColumn('status', function (Advertisement $advertisement) {
                return getTableHtml($advertisement, 'status');
            })->editColumn('actions', function (Advertisement $advertisement) {
                $editRoute       = route('advertisement.edit', $advertisement->id);
                $deleteRoute     = route('advertisement.destroy', $advertisement->id);
                $uploadRoute     = false;
                $optionRoute     = '';
                $optionRouteText = '';

                return getTableHtml($advertisement, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText, $uploadRoute);
            })->rawColumns([ 'status', 'actions' ])->make(true);
    }

    public function create(array $data)
    {
        try
        {
            $data['status']     = ( isset($data['status']) ? $data['status'] : '' ) == 'on' ? 'active' : 'in_active';
            $data['created_by'] = Auth::user()->id;
            $data['expiry'] = Carbon::parse($data['expiry'])->toDateTimeString();

            $advertisement = $this->advertisement->create($data);

            return $advertisement;

        } catch (Exception $e)
        {
            return null;
        }
    }

    /**
     * Paginate all User
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->advertisement->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->advertisement->whereIsDeleted('no')->get();
    }

    public function getAds($type)
    {
        return $this->advertisement->whereIsDeleted('no')->whereType($type)->get();
    }


    public function getAdvertisementAdmin()
    {
        return $this->advertisement->whereIsDeleted('no')->where('status', 'active')->get();
    }

    public function advertisementFront()
    {
        return $this->advertisement->whereIsDeleted('no')->where('status', 'active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($advertisementId)
    {
        try
        {
            return $this->advertisement->whereIsDeleted('no')->find($advertisementId);
        } catch (Exception $e)
        {
            return null;
        }
    }


    public function update($advertisementId, array $data)
    {
        try
        {

            $data['status']          = ( isset($data['status']) ? $data['status'] : '' ) == 'on' ? 'active' : 'in_active';
            $data['last_updated_by'] = Auth::user()->id;
            $advertisement                 = $this->advertisement->find($advertisementId);

            $advertisement = $advertisement->update($data);

            //$this->logger->info(' created successfully', $data);

            return $advertisement;
        } catch (Exception $e)
        {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a User
     *
     * @param Id
     * @return bool
     */
    public function delete($advertisementId)
    {
        try
        {

            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at']      = Carbon::now();
            $advertisement                 = $this->advertisement->find($advertisementId);
            $data['is_deleted']      = 'yes';

            return $advertisement = $advertisement->update($data);

        } catch (Exception $e)
        {
            return false;
        }
    }

    /**
     * write brief description
     * @param $title
     * @return mixed
     */
    public function getByTitle($title)
    {
        return $this->advertisement->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug)
    {
        return $this->advertisement->whereIsDeleted('no')->whereSlug($slug)->first();
    }

    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/advertisement';
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

    public function updateImage($advertisementId, array $data)
    {
        try {
            $advertisement = $this->advertisement->find($advertisementId);
            $advertisement = $advertisement->update($data);
            return $advertisement;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }
}
