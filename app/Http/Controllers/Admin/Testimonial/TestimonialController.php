<?php

namespace App\Http\Controllers\Admin\Testimonial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\Testimonial\TestimonialRequest;
use App\Modules\Service\Testimonial\TestimonialService;

class TestimonialController extends Controller
{
    protected $testimonial;

    function __construct(TestimonialService $testimonial)
    {
        $this->testimonial = $testimonial;
    }/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        $testimonials = $this->testimonial->paginate();
        return view('admin.testimonial.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    public function getAllData()
    {
        return $this->testimonial->getAllData();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
        if($testimonial = $this->testimonial->create($request->all()))

        {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $testimonial);
            }

            Toastr::success('Testimonial created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('testimonial.index');
        }
        Toastr::error('Testimonial cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('testimonial.index');
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
    public function edit($id)
    {
        $testimonial = $this->testimonial->find($id);
        return view('admin.testimonial.edit',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->testimonial->update($id,$request->all()))
        {
            if ($request->hasFile('image')) {
                $testimonial = $this->testimonial->find($id);
                $this->uploadFile($request, $testimonial);
            }
            Toastr::success('Testimonial updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('testimonial.index');
        }
        Toastr::error('Testimonial cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->testimonial->delete($id))
        {
            Toastr::success('Testimonial deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('testimonial.index');
        }
        Toastr::error('Testimonial cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('testimonial.index');
    }
    function uploadFile(Request $request,  $testimonial)
    {
        $file = $request->file('image');
        $fileName = $this->testimonial->uploadFile($file);
        if (!empty($testimonial->image))
            $this->testimonial->__deleteImages($testimonial);


        $data['image'] = $fileName;
        $this->testimonial->updateImage($testimonial->id, $data);

    }
}
