<?php namespace

App\Modules\Service\JobSkill;

use App\Modules\Models\JobSkill\JobSkill;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class JobSkillService extends Service
{
    protected $jobSkill;

    public function __construct(JobSkill $jobSkill)
    {
        $this->jobSkill = $jobSkill;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->jobSkill->whereIsDeleted('no');

        return DataTables::of($query)->addIndexColumn()->editColumn('status', function (JobSkill $jobSkill) {
                return getTableHtml($jobSkill, 'status');
            })->editColumn('actions', function (JobSkill $jobSkill) {
                $editRoute       = route('job-skill.edit', $jobSkill->id);
                $deleteRoute     = route('job-skill.destroy', $jobSkill->id);
                $uploadRoute     = false;
                $optionRoute     = '';
                $optionRouteText = '';

                return getTableHtml($jobSkill, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText, $uploadRoute);
            })->rawColumns([ 'status', 'actions' ])->make(true);
    }

    public function create(array $data)
    {
        try
        {
            $data['status']     = ( isset($data['status']) ? $data['status'] : '' ) == 'on' ? 'active' : 'in_active';
            $data['created_by'] = Auth::user()->id;
            //dd($data);
            $jobSkill = $this->jobSkill->create($data);

            return $jobSkill;

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

        return $this->jobSkill->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->jobSkill->whereIsDeleted('no')->all();
    }

    public function getJobSkillAdmin()
    {
        return $this->jobSkill->whereIsDeleted('no')->where('status', 'active')->get();
    }

    public function jobSkillFront()
    {
        return $this->jobSkill->whereIsDeleted('no')->where('status', 'active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($jobSkillId)
    {
        try
        {
            return $this->jobSkill->whereIsDeleted('no')->find($jobSkillId);
        } catch (Exception $e)
        {
            return null;
        }
    }

    public function findBySlug($jobSkillSlug)
    {
        try
        {
            return $this->jobSkill->whereIsDeleted('no')->whereSlug($jobSkillSlug)->first();
        } catch (Exception $e)
        {
            return null;
        }
    }


    public function update($jobSkillId, array $data)
    {
        try
        {

            $data['status']          = ( isset($data['status']) ? $data['status'] : '' ) == 'on' ? 'active' : 'in_active';
            $data['last_updated_by'] = Auth::user()->id;
            $jobSkill                = $this->jobSkill->find($jobSkillId);

            $jobSkill = $jobSkill->update($data);

            //$this->logger->info(' created successfully', $data);

            return $jobSkill;
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
    public function delete($jobSkillId)
    {
        try
        {

            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at']      = Carbon::now();
            $jobSkill                = $this->jobSkill->find($jobSkillId);
            $data['is_deleted']      = 'yes';

            return $jobSkill = $jobSkill->update($data);

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
        return $this->jobSkill->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug)
    {
        return $this->jobSkill->whereIsDeleted('no')->whereSlug($slug)->first();
    }


}
