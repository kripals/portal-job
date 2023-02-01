<?php namespace

App\Modules\Service\Category;

use App\Modules\Models\Category\Category;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class CategoryService extends Service
{
    protected $category;

    public function __construct(
        Category $category
    ){
        $this->category = $category;
    }


    /*For DataTable*/
    public function getAllData($type)

    {
        $query = $this->category->whereIsDeleted('no')->whereType($type);
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('visibility',function(Category $category){
                if($category->visibility == 'visible'){
                    return '<span class="label label-info">Yes</span>';
                }else{
                    return '<span class="label label-danger">No</span>';
                }
            })
            ->editColumn('availability',function(Category $category){
                if($category->availability == 'available'){
                    return '<span class="label label-info" data-toggle="tooltip">Available</span>';
                }else{
                    return '<span class="label label-danger">Not Available</span>';
                }
            })
//            ->editColumn('has_subcategory',function(Category $category){
//                if($category->has_subcategory == 'yes'){
//                    return '<span class="label label-info">Yes</span>';
//                }else{
//                    return '<span class="label label-danger">No</span>';
//                }
//            })
            ->editColumn('status',function(Category $category){
                if($category->status == 'active'){
                    return '<span class="label label-info">Active</span>';
                }else{
                    return '<span class="label label-danger">In Active</span>';
                }
            })
            ->editColumn('actions', function(Category $category) {
                $editRoute = route('category.edit',[$category->type,$category->id]);
                $deleteRoute = route('category.destroy',[$category->type,$category->id]);
                $optionRoute='';
                $optionRouteText='';
                if($category->has_subcategory=='yes')
                {
                    $optionRoute = route('category.subcategory.index',$category->slug);
                    $optionRouteText = 'Manage Sub Category';
                }
                return getTableHtml($category,'actions',$editRoute,$deleteRoute,$optionRoute,$optionRouteText);
            })->rawColumns(['visibility','availability','input_type','status','created_by','actions'])
            ->make(true);
    }

    public function create(array $data,$type)
    {
        try {
            /* $data['keywords'] = '"'.$data['keywords'].'"';*/
            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['has_subcategory'] = (isset($data['has_subcategory']) ?  $data['has_subcategory'] : '')=='on' ? 'yes' : 'no';
            $data['created_by']= Auth::user()->id;
            $data['type'] = $type;
            $category = $this->category->create($data);
            return $category;

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

        return $this->category->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->category->whereIsDeleted('no')->all();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($categoryId)
    {
        try {
            return $this->category->whereIsDeleted('no')->find($categoryId);
        } catch (Exception $e) {
            return null;
        }
    }

    public function findBySlug($categorySlug)
    {
        try {
            return $this->category->whereIsDeleted('no')->where('slug',$categorySlug)->first();
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($categoryId, array $data)
    {
        try {

            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['has_subcategory'] = (isset($data['has_subcategory']) ?  $data['has_subcategory'] : '')=='on' ? 'yes' : 'no';
            $data['last_updated_by']= Auth::user()->id;
            $category= $this->category->find($categoryId);

            $category = $category->update($data);
            //$this->logger->info(' created successfully', $data);

            return $category;
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
    public function delete($categoryId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $category = $this->category->find($categoryId);
            $data['is_deleted']='yes';
            return $category = $category->update($data);

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
        return $this->category->whereIsDeleted('no')->whereName($name);
    }

    public function getBySlug($slug){
        return $this->category->whereIsDeleted('no')->whereSlug($slug)->first();
    }

    public function getCompanyCategories()
    {
        return $this->category->where('type','company')->where('status','active')->where('is_deleted','no')->get();
    }

    public function getCandidateCategories()
    {
        return $this->category->where('type','candidate')->where('status','active')->where('is_deleted','no')->get();
    }

    public function companyCategoriesFront()
    {
        return $this->category->where('type','company')->where('status','active')->where('is_deleted','no')->where('visibility','visible')->where('availability','available')->get();
    }

    public function candidateCategoriesFront()
    {
        return $this->category->where('type','candidate')->where('status','active')->where('is_deleted','no')->where('visibility','visible')->where('availability','available')->get();
    }

    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/category';
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

    public function updateImage($categoryId, array $data)
    {
        try {
            $category = $this->category->find($categoryId);
            $category = $category->update($data);

            return $category;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }
}
