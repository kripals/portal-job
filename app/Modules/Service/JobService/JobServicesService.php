<?php namespace

App\Modules\Service\JobService;

use App\Modules\Models\JobService\JobService;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class JobServicesService extends Service
{
    protected $jobService;

    public function __construct(
        JobService $jobService
    ){
        $this->jobService = $jobService;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->jobService->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status',function(JobService $jobService){
                return getTableHtml($jobService,'status');
            })
            ->editColumn('actions', function(JobService $jobService) {
                $editRoute = route('job-service.edit',$jobService->id);
                $deleteRoute = route('job-service.destroy',$jobService->id);
                $uploadRoute = false;
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($jobService,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['status','actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['created_by']= Auth::user()->id;
            //dd($data);
            $jobService = $this->jobService->create($data);
            return $jobService;

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

        return $this->jobService->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->jobService->whereIsDeleted('no')->get();
    }

    public function jobServiceAdmin()
    {
        return $this->jobService->whereIsDeleted('no')->where('status','active')->get();
    }

    public function jobServiceFront()
    {
        return $this->jobService->whereIsDeleted('no')->where('status','active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($jobServiceId)
    {
        try {
            return $this->jobService->whereIsDeleted('no')->find($jobServiceId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($jobServiceId, array $data)
    {
        try {

            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['last_updated_by']= Auth::user()->id;
            $jobService= $this->jobService->find($jobServiceId);

            $jobService = $jobService->update($data);
            //$this->logger->info(' created successfully', $data);

            return $jobService;
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
    public function delete($jobServiceId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $jobService = $this->jobService->find($jobServiceId);
            $data['is_deleted']='yes';
            return $jobService = $jobService->update($data);

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
        return $this->jobService->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug){
        return $this->jobService->whereIsDeleted('no')->whereSlug($slug)->first();
    }


}
