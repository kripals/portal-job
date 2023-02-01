<?php namespace

App\Modules\Service\Testimonial;

use App\Modules\Models\Testimonial\Testimonial;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class TestimonialService extends Service
{
    protected $testimonial;

    public function __construct(
        Testimonial $testimonial
    ){
        $this->testimonial = $testimonial;
    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->testimonial->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('visibility',function(Testimonial $testimonial){
                if($testimonial->visibility == 'visible'){
                    return '<span class="label label-info">Visible</span>';
                }else{
                    return '<span class="label label-danger">In Visible</span>';
                }
            })
            ->editColumn('visibility',function(Testimonial $testimonial){
                if($testimonial->visibility == 'visible'){
                    return '<span class="label label-info">Visible</span>';
                }else{
                    return '<span class="label label-danger">In Visible</span>';
                }
            })
            ->editColumn('availability',function(Testimonial $testimonial){
                if($testimonial->availability == 'available'){
                    return '<span class="label label-info" data-toggle="tooltip" title="Hooray!">Available</span>';
                }else{
                    return '<span class="label label-danger">Not Available</span>';
                }
            })
            ->editColumn('status',function(Testimonial $testimonial){
                if($testimonial->status == 'active'){
                    return '<span class="label label-info">Active</span>';
                }else{
                    return '<span class="label label-danger">In Active</span>';
                }
            })
            ->editColumn('actions', function(Testimonial $testimonial) {
                $editRoute = route('testimonial.edit',$testimonial->id);
                $deleteRoute = route('testimonial.destroy',$testimonial->id);
                $actions ='<div class="btn-group dropup">
		<button type="button" class="btn ink-reaction btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-up text-default-light"></i></button>
		<ul class="dropdown-menu animation-zoom" role="menu" style="margin-left: -71px;">
		
		<li><a href="'.$editRoute.'"  style="font-size: initial;"><i class="fa fa-pencil"></i>Edit</a></li>
	    <li class="divider"></li> 
		<li ><a data-url="'.$deleteRoute.'" class="item-delete" style="font-size: initial;cursor: pointer;" ><i class="fa fa-fw fa-times text-danger"></i>Delete</a></li>
	    </ul>
		</div>';
                return $actions;
            })->rawColumns(['visibility','availability','status','created_by','actions'])
            ->make(true);
    }

    public function create(array $data)
    {
        try {
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['created_by']= Auth::user()->id;
            //dd($data);
            $testimonial = $this->testimonial->create($data);
            return $testimonial;

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

        return $this->testimonial->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->testimonial->whereIsDeleted('no')->all();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($testimonialId)
    {
        try {
            return $this->testimonial->whereIsDeleted('no')->find($testimonialId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($testimonialId, array $data)
    {
        try {

            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['last_updated_by']= Auth::user()->id;
            $testimonial= $this->testimonial->find($testimonialId);

            $testimonial = $testimonial->update($data);
            //$this->logger->info(' created successfully', $data);

            return $testimonial;
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
    public function delete($testimonialId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $testimonial = $this->testimonial->find($testimonialId);
            $data['is_deleted']='yes';
            return $testimonial = $testimonial->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($name){
        return $this->testimonial->whereIsDeleted('no')->whereName($name);
    }

    public function getBySlug($slug){
        return $this->testimonial->whereIsDeleted('no')->whereSlug($slug)->first();
    }


    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/testimonial';
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

    public function updateImage($testimonialId, array $data)
    {
        try {
            $testimonial = $this->testimonial->find($testimonialId);
            $testimonial = $testimonial->update($data);

            return $testimonial;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }
}
