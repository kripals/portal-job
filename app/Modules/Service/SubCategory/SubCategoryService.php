<?php namespace App\Modules\Service\SubCategory;

use App\Modules\Models\SubCategory\SubCategory;


use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class SubCategoryService extends Service
{
    protected $subCategory;
    protected $category;


    public function __construct(
        SubCategory $subCategory

    )
    {
        $this->subCategory = $subCategory;

    }


    /*For DataTable*/
    public function getAllData($categoryId)
    {

        $query = SubCategory::where('category_id', '=', $categoryId)
                              ->where('is_deleted', '=', 'no');

        $datas = DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('visibility',function(SubCategory $subcategory){
                if($subcategory->visibility == 'visible'){
                    return '<span class="label label-info">Visible</span>';
                }else{
                    return '<span class="label label-danger">In Visible</span>';
                }
            })
            ->editColumn('availability',function(SubCategory $subcategory){
                if($subcategory->availability == 'available'){
                    return '<span class="label label-info" data-toggle="tooltip" title="Hooray!">Available</span>';
                }else{
                    return '<span class="label label-danger">Not Available</span>';
                }
            })
            ->editColumn('status',function(SubCategory $subcategory){
                if($subcategory->status == 'active'){
                    return '<span class="label label-info">Active</span>';
                }else{
                    return '<span class="label label-danger">In Active</span>';
                }
            })
            ->editColumn('actions', function(SubCategory $subcategory) {
                $editRoute = route('category.subcategory.edit',[$subcategory->category->slug, $subcategory->id]);
                $deleteRoute = route('category.subcategory.destroy',[$subcategory->category->slug, $subcategory->id]);
                $actions ='<div class="btn-group dropup">
		<button type="button" class="btn ink-reaction btn-flat dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-up text-default-light"></i></button>
		<ul class="dropdown-menu animation-zoom" role="menu" style="margin-left: -71px;">
	
		<li><a href="'.$editRoute.'"  style="font-size: initial;"><i class="fa fa-pencil"></i>Edit</a></li>
	    <li class="divider"></li> 
		<li ><a data-url="'.$deleteRoute.'" class="item-delete" style="font-size: initial;cursor: pointer;" ><i class="fa fa-fw fa-times text-danger"></i>Delete</a></li>
	    </ul>
		</div>';
                return $actions;
            })->rawColumns(['image', 'visibility', 'availability','status', 'created_by', 'actions'])

            //            ->editColumn('actions', function (SubCategory $subcategory) {
//                $editRoute = route('category.subcategory.edit', [$subcategory->category->slug, $subcategory->id]);
//                $deleteRoute = route('category.subcategory.destroy', [$subcategory->category->slug, $subcategory->id]);
//                $uploadRoute = true;
//                $optionRoute = '';
//                $optionRouteText = '';
//
//                return getTableHtml($subcategory, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText, $uploadRoute);
//            })->rawColumns(['image', 'visibility', 'availability', 'has_groups', 'input_type', 'status', 'created_by', 'actions'])
            ->make(true);


        return $datas;
    }


    public function create(array $data, $categoryId)
    {
        try {
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['has_groups'] = (isset($data['has_groups']) ? $data['has_groups'] : '') == 'on' ? 'yes' : 'no';
            $data['created_by'] = Auth::user()->id;
            $data['category_id'] = $categoryId;
            $subcategory = $this->subCategory->create($data);
            return $subcategory;

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
        return $this->subCategory->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    public function getAllByCategory($categoryId, array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->subCategory->whereCategoryId($categoryId)->orderBy('id', 'DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->subCategory->all();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($subCategoryId)
    {
        try {
            return $this->subCategory->find($subCategoryId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($subCategoryId, array $data, $categoryId)
    {
        try {
//
            $data['visibility'] = (isset($data['visibility']) ? $data['visibility'] : '') == 'on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ? $data['availability'] : '') == 'on' ? 'available' : 'not_available';
            $data['has_groups'] = (isset($data['has_groups']) ? $data['has_groups'] : '') == 'on' ? 'yes' : 'no';
            $data['category_id'] = $categoryId;
            $data['last_updated_by'] = Auth::user()->id;
//            dd($data);
            $subCategory = $this->subCategory->find($subCategoryId);
            $subCategory = $subCategory->update($data);

            return $subCategory;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }


    public function updateImage($subCategoryId, array $data)
    {
        try {

            $subCategory = $this->subCategory->findOrFail($subCategoryId);
            $subCategory = $subCategory->update($data);

            return $subCategory;
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
    public function delete($subCategoryId)
    {
        try {
            $subcategory = $this->subCategory->find($subCategoryId);
            $data['is_deleted'] = 'yes';
            $data['last_deleted_by'] = Auth::user()->id;
            $data['deleted_at'] = Carbon::now();
            return $category = $subcategory->update($data);;

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->subCategory->whereName($name);
    }

    public function getBySlug($slug)
    {
        return $this->subCategory->whereIsDeleted('no')->whereSlug($slug)->first();
    }

    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/subcategory';
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
}
