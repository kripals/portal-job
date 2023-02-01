<?php namespace

App\Modules\Service\JobCountry;


use App\Modules\Models\JobCountry\JobCountry;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class JobCountryService extends Service
{
    protected $jobCountry;

    public function __construct(
        JobCountry $jobCountry
    ){
        $this->jobCountry = $jobCountry;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->jobCountry->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status',function(jobCountry $jobCountry){
                return getTableHtml($jobCountry,'status');
            })
            ->editColumn('actions', function(jobCountry $jobCountry) {
                $editRoute = route('job-country.edit',$jobCountry->id);
                $deleteRoute = route('job-country.destroy',$jobCountry->id);
                $uploadRoute = false;
                $optionRoute = '';
                $optionRouteText = '';
                $optionRoute2 = '';
                $optionRouteText2 = '';
                if($jobCountry->has_location=='yes')
                {
                    $optionRoute2 = route('country.job-location.index',$jobCountry->slug);
                    $optionRouteText2 = 'Manage Location';
                }
                return getTableHtml($jobCountry,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$optionRoute2,$optionRouteText2,$uploadRoute);
            })->rawColumns(['status','actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['has_location'] = (isset($data['has_location']) ?  $data['has_location'] : '')=='on' ? 'yes' : 'no';
            $data['is_home'] = (isset($data['is_home']) ?  $data['is_home'] : '')=='on' ? 'yes' : 'no';
            $data['created_by']= Auth::user()->id;
            //dd($data);
            $jobCountry = $this->jobCountry->create($data);
            return $jobCountry;

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

        return $this->jobCountry->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->jobCountry->whereIsDeleted('no')->get();
    }


    public function getJobCountryAdmin()
    {
        return $this->jobCountry->whereIsDeleted('no')->where('status','active')->get();
    }

    public function jobCountryFront()
    {
        return $this->jobCountry->whereIsDeleted('no')->where('status','active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($jobCountryId)
    {
        try {
            return $this->jobCountry->whereIsDeleted('no')->find($jobCountryId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getBySlug($jobCountrySlug)
    {
        try {
            return $this->jobCountry->whereIsDeleted('no')->whereSlug($jobCountrySlug)->first();
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($jobCountryId, array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['has_location'] = (isset($data['has_location']) ?  $data['has_location'] : '')=='on' ? 'yes' : 'no';
            $data['is_home'] = (isset($data['is_home']) ?  $data['is_home'] : '')=='on' ? 'yes' : 'no';
            $data['last_updated_by']= Auth::user()->id;
            $jobCountry= $this->jobCountry->find($jobCountryId);
            $jobCountry = $jobCountry->update($data);
            //$this->logger->info(' created successfully', $data);

            return $jobCountry;
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
    public function delete($jobCountryId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $jobCountry = $this->jobCountry->find($jobCountryId);
            $data['is_deleted']='yes';
            return $jobCountry = $jobCountry->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

}
