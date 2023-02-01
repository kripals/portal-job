<?php

namespace App\Http\Controllers\Admin\SubCategory;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\SubCategory\SubCategoryRequest;
use App\Modules\Service\Category\CategoryService;
use App\Modules\Service\SubCategory\SubCategoryService;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class SubCategoryController extends Controller
{
    protected $category;
    protected $subcategory;

    function __construct(SubCategoryService $subcategory, CategoryService $category)
    {
        $this->category = $category;
        $this->subcategory = $subcategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {

        $category = $this->category->getBySlug($slug);
        $subcategories = $this->subcategory->getAllByCategory($category->id);
//        dd($subcategories);
        return view('admin.subcategory.index',compact('subcategories','category'));
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getAllData($slug)
    {
        $category=$this->category->getBySlug($slug);
        return $this->subcategory->getAllData($category->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category = null)
    {
        $category=$this->category->getBySlug($category);
        return view('admin.subcategory.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request,$categoryId)
    {
        $category=$this->category->find($categoryId);
        if($this->subcategory->create($request->all(),$categoryId))
        {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $categoryId);
            }
            Toastr::success('SubCategory created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('category.subcategory.index',$category->slug);
        }
        Toastr::error('SubCategory cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('category.subcategory.index',$category->slug);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$subcategoryId)
    {

        $category = $this->category->getBySlug($slug);
        $subcategory = $this->subcategory->find($subcategoryId);
        return view('admin.subcategory.edit',compact('subcategory','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request,$slug, $id)
    {
        $category = $this->category->getBySlug($slug);
        $subcategory=$this->subcategory->find($id);
        if($this->subcategory->update($id,$request->all(),$category->id))
        {
            if ($request->hasFile('image')) {
                $subcategory = $this->subcategory->find($id);
                $this->uploadFile($request, $subcategory);
            }
            Toastr::success('SubCategory updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('category.subcategory.index',$category->slug);
        }
        Toastr::error('SubCategory cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('category.subcategory.index',$category->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$id)
    {
        $category = $this->category->getBySlug($slug);
        if($this->subcategory->delete($id))
        {
            Toastr::success('Sub-Category deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('category.subcategory.index',$category->slug);
        }
        Toastr::error('Sub-Category cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('category.subcategory.index',$category->slug);
    }
    function uploadFile(Request $request,  $subcategory)
    {
        $file = $request->file('image');
        $fileName = $this->subcategory->uploadFile($file);
        if (!empty($subcategory->image))
            $this->subcategory->__deleteImages($subcategory);


        $data['image'] = $fileName;
        $this->subcategory->updateImage($subcategory->id, $data);

    }
}
