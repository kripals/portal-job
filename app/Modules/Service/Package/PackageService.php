<?php namespace

App\Modules\Service\Package;

use App\Modules\Models\Package\Package;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class PackageService extends Service
{
    protected $package;

    public function __construct(
        Package $package
    ){
        $this->package = $package;
    }

    /*For DataTable*/
    public function getAllData($type)
    {
        $query = $this->package->whereIsDeleted('no')->whereType($type);
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('display_type',function(Package $package){
                return ucwords(str_replace('-',' ',$package->display_type));
            })
            ->editColumn('expiry',function(Package $package){
                return $package->expiry.' Day(s)';
            })
            ->editColumn('status',function(Package $package){
                return getTableHtml($package,'status');
            })
            ->editColumn('visibility',function(Package $package){
                return getTableHtml($package,'visibility');
            })
            ->editColumn('actions', function(Package $package) {
                $editRoute = route('package.edit',[$package->type,$package->id]);
                $deleteRoute = route('package.destroy',$package->id);
                $uploadRoute = false;
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($package,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['status','visibility','actions'])
            ->make(true);
    }

    public function create(array $data,$type)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['created_by']= Auth::user()->id;
            $data['type']= $type;
            //dd($data);
            $package = $this->package->create($data);
            return $package;

        } catch (Exception $e) {
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

        return $this->package->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->package->whereIsDeleted('no')->get();
    }

    public function getByType($type)
    {
        return $this->package->whereIsDeleted('no')->whereType($type)->get();
    }


    public function getPackageAdmin()
    {
        return $this->package->whereIsDeleted('no')->where('status','active')->get();
    }

    public function packageFront()
    {
        return $this->package->whereIsDeleted('no')->where('status','active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($packageId)
    {
        try {
            return $this->package->whereIsDeleted('no')->find($packageId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function findbySlug($packageSlug)
    {
        try {
            return $this->package->whereIsDeleted('no')->whereSlug($packageSlug)->first();
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($packageId, array $data)
    {
        try {

            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['last_updated_by']= Auth::user()->id;
            $package= $this->package->find($packageId);

            $package = $package->update($data);
            //$this->logger->info(' created successfully', $data);

            return $package;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function purchasePackage($company,$package,array $data)
    {
        try {
            $dataStore['order_id'] = getRandomOrderInt();
            $dataStore['quantity'] = $data['job_quantity'];
//            unset($data['_token']);
//            unset($data['submit']);
//            dd($data);
            $company->packages()->attach($package, $dataStore);

            return $package;
        } catch (Exception $e) {
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
    public function delete($packageId)
    {
        try {
            dd($packageId);
            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $package = $this->package->find($packageId);
            dd($package);
            $data['is_deleted']='yes';
            return $package = $package->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $title
     * @return mixed
     */
    public function getByTitle($title){
        return $this->package->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug){
        return $this->package->whereIsDeleted('no')->whereSlug($slug)->first();
    }


}
