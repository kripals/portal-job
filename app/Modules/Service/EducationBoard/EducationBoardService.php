<?php namespace

App\Modules\Service\EducationBoard;

use App\Modules\Models\Education\EducationBoard;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class EducationBoardService extends Service
{
    protected $educationBoard;

    public function __construct(
        EducationBoard $educationBoard
    ){
        $this->educationBoard = $educationBoard;
    }

    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->educationBoard->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('status',function(EducationBoard $educationBoard){
                return getTableHtml($educationBoard,'status');
            })
            ->editColumn('actions', function(EducationBoard $educationBoard) {
                $editRoute = route('education-board.edit',$educationBoard->id);
                $deleteRoute = route('education-board.destroy',$educationBoard->id);
                $uploadRoute = false;
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($educationBoard,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText,$uploadRoute);
            })->rawColumns(['status','actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        try {
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['created_by']= Auth::user()->id;
            //dd($data);
            $educationBoard = $this->educationBoard->create($data);
            return $educationBoard;

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

        return $this->educationBoard->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->educationBoard->whereIsDeleted('no')->get();
    }


    public function getEducationBoardAdmin()
    {
        return $this->educationBoard->whereIsDeleted('no')->where('status','active')->get();
    }

    public function educationBoardFront()
    {
        return $this->educationBoard->whereIsDeleted('no')->where('status','active')->get();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($educationBoardId)
    {
        try {
            return $this->educationBoard->whereIsDeleted('no')->find($educationBoardId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($educationBoardId, array $data)
    {
        try {

            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['last_updated_by']= Auth::user()->id;
            $educationBoard= $this->educationBoard->find($educationBoardId);

            $educationBoard = $educationBoard->update($data);
            //$this->logger->info(' created successfully', $data);

            return $educationBoard;
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
    public function delete($educationBoardId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $educationBoard = $this->educationBoard->find($educationBoardId);
            $data['is_deleted']='yes';
            return $educationBoard = $educationBoard->update($data);

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
        return $this->educationBoard->whereIsDeleted('no')->whereTitle($title);
    }

    public function getBySlug($slug){
        return $this->educationBoard->whereIsDeleted('no')->whereSlug($slug)->first();
    }


}
