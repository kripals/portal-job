<?php namespace

App\Modules\Service\JobType;

use App\Modules\Models\JobType\JobType;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class JobTypeService extends Service
{
    protected $jobType;

    public function __construct(JobType $jobType)
    {
        $this->jobType = $jobType;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->jobType->whereIsDeleted('no');

        return DataTables::of($query)->addIndexColumn()->editColumn('status', function (JobType $jobType) {
                return getTableHtml($jobType, 'status');
            })->editColumn('actions', function (JobType $jobType) {
                $editRoute       = route('job-type.edit', $jobType->id);
                $deleteRoute     = route('job-type.destroy', $jobType->id);
                $uploadRoute     = false;
                $optionRoute     = '';
                $optionRouteText = '';

                return getTableHtml($jobType, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText, $uploadRoute);
            })->rawColumns([ 'status', 'actions' ])->make(true);
    }

    public function create(array $data)
    {
        try
        {
            $data['status']     = ( isset($data['status']) ? $data['status'] : '' ) == 'on' ? 'active' : 'in_active';
            $data['created_by'] = Auth::user()->id;
            //dd($data);
            $jobType = $this->jobType->create($data);

            return $jobType;

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

        return $this->jobType->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->jobType->whereIsDeleted('no')->get();
    }


    public function getJobTypeAdmin()
    {
        return $this->jobType->whereIsDeleted('no')->where('status', 'active')->get();
    }

    public function jobTypeFront()
    {
        return $this->jobType->whereIsDeleted('no')->where('status', 'active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($jobTypeId)
    {
        try
        {
            return $this->jobType->whereIsDeleted('no')->find($jobTypeId);
        } catch (Exception $e)
        {
            return null;
        }
    }


    public function update($jobTypeId, array $data)
    {
        try
        {

            $data['status']          = ( isset($data['status']) ? $data['status'] : '' ) == 'on' ? 'active' : 'in_active';
            $data['last_updated_by'] = Auth::user()->id;
            $jobType                 = $this->jobType->find($jobTypeId);

            $jobType = $jobType->update($data);

            //$this->logger->info(' created successfully', $data);

            return $jobType;
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
    public function delete($jobTypeId)
    {
        try
        {

            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at']      = Carbon::now();
            $jobType                 = $this->jobType->find($jobTypeId);
            $data['is_deleted']      = 'yes';

            return $jobType = $jobType->update($data);

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
        return $this->jobType->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug)
    {
        return $this->jobType->whereIsDeleted('no')->whereSlug($slug)->first();
    }

}
