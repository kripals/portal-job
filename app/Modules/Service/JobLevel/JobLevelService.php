<?php namespace

App\Modules\Service\JobLevel;

use App\Modules\Models\JobLevel\JobLevel;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class JobLevelService extends Service
{
    protected $jobLevel;

    public function __construct(
        JobLevel $jobLevel
    ){
        $this->jobLevel = $jobLevel;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->jobLevel->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status',function(JobLevel $jobLevel){
                return getTableHtml($jobLevel,'status');
            })
            ->editColumn('actions', function(JobLevel $jobLevel) {
                $editRoute = route('job-level.edit',$jobLevel->id);
                $deleteRoute = route('job-level.destroy',$jobLevel->id);
                $uploadRoute = false;
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($jobLevel,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['status','actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['created_by']= Auth::user()->id;
            //dd($data);
            $jobLevel = $this->jobLevel->create($data);
            return $jobLevel;

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

        return $this->jobLevel->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->jobLevel->whereIsDeleted('no')->get();
    }


    public function getJobLevelAdmin()
    {
        return $this->jobLevel->whereIsDeleted('no')->where('status','active')->get();
    }

    public function jobLevelFront()
    {
        return $this->jobLevel->whereIsDeleted('no')->where('status','active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($jobLevelId)
    {
        try {
            return $this->jobLevel->whereIsDeleted('no')->find($jobLevelId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($jobLevelId, array $data)
    {
        try {

            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['last_updated_by']= Auth::user()->id;
            $jobLevel= $this->jobLevel->find($jobLevelId);

            $jobLevel = $jobLevel->update($data);
            //$this->logger->info(' created successfully', $data);

            return $jobLevel;
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
    public function delete($jobLevelId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $jobLevel = $this->jobLevel->find($jobLevelId);
            $data['is_deleted']='yes';
            return $jobLevel = $jobLevel->update($data);

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
        return $this->jobLevel->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug){
        return $this->jobLevel->whereIsDeleted('no')->whereSlug($slug)->first();
    }


}
