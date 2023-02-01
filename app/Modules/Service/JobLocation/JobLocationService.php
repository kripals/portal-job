<?php namespace

App\Modules\Service\JobLocation;

use App\Modules\Models\JobLocation\JobLocation;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class JobLocationService extends Service
{
    protected $jobLocation;

    public function __construct(
        JobLocation $jobLocation
    ){
        $this->jobLocation = $jobLocation;
    }

    /*For DataTable*/
    public function getAllData($jobCountry)

    {
        $query = $this->jobLocation->whereJobCountryId($jobCountry->id)->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status',function(JobLocation $jobLocation){
                return getTableHtml($jobLocation,'status');
            })
            ->editColumn('actions', function(JobLocation $jobLocation) {
                $editRoute = route('country.job-location.edit',[$jobLocation->country->slug,$jobLocation->id]);
                $deleteRoute = route('job-location.destroy',[$jobLocation->country->slug,$jobLocation->id]);
                $uploadRoute = false;
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($jobLocation,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['status','actions'])
            ->make(true);
    }

    public function create(array $data,$countryId)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['job_country_id'] = $countryId;
            $data['created_by']= Auth::user()->id;
            $jobLocation = $this->jobLocation->create($data);
            return $jobLocation;

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

        return $this->jobLocation->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->jobLocation->whereIsDeleted('no')->get();
    }


    public function getJobLocationAdmin()
    {
        return $this->jobLocation->whereIsDeleted('no')->where('status','active')->get();
    }

    public function jobLocationFront()
    {
        return $this->jobLocation->whereIsDeleted('no')->where('status','active')->get();
    }


    public function getLocationByCountry($countryId)
    {
        return $this->jobLocation->whereIsDeleted('no')->whereJobCountryId($countryId)->where('status','active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($jobLocationId)
    {
        try {
            return $this->jobLocation->whereIsDeleted('no')->find($jobLocationId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($jobLocationId, array $data,$countryId)
    {
        try {

            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['job_country_id'] = $countryId;
            $data['last_updated_by']= Auth::user()->id;
            $jobLocation= $this->jobLocation->find($jobLocationId);

            $jobLocation = $jobLocation->update($data);
            //$this->logger->info(' created successfully', $data);

            return $jobLocation;
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
    public function delete($jobLocationId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $jobLocation = $this->jobLocation->find($jobLocationId);
            $data['is_deleted']='yes';
            return $jobLocation = $jobLocation->update($data);

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
        return $this->jobLocation->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug){
        return $this->jobLocation->whereIsDeleted('no')->whereSlug($slug)->first();
    }


}
