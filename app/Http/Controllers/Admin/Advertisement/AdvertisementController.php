<?php

namespace App\Http\Controllers\Admin\Advertisement;

use App\Http\Requests\Admin\Advertisement\AdvertisementRequest;
use App\Modules\Service\Advertisement\AdvertisementService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class AdvertisementController extends Controller
{
    protected $advertisement;

    function __construct(AdvertisementService $advertisement)
    {
        $this->advertisement = $advertisement;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = $this->advertisement->paginate();
        return view('admin.advertisement.index',compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisement.create');
    }
    public function getAllData()
    {
        return $this->advertisement->getAllData();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {
        if($advertisement = $this->advertisement->create($request->all()))
        {
            if ($request->hasFile('image')) {
                $this->uploadFile($request, $advertisement);
            }
            Toastr::success('Advertisement created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('advertisement.index');
        }
        Toastr::error('Advertisement cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('advertisement.index');
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
        $advertisement = $this->advertisement->find($id);
        return view('admin.advertisement.edit',compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, $id)
    {
        if($this->advertisement->update($id,$request->all()))
        {
            if ($request->hasFile('image')) {
                $advertisement = $this->advertisement->find($id);
                $this->uploadFile($request, $advertisement);
            }
            Toastr::success('Advertisement updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('advertisement.index');
        }
        Toastr::error('Advertisement cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('advertisement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->advertisement->delete($id))
        {
            Toastr::success('Advertisement deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('advertisement.index');
        }
        Toastr::error('Advertisement cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('advertisement.index');
    }

    function uploadFile(Request $request, $advertisement)
    {
        $file = $request->file('image');
        $fileName = $this->advertisement->uploadFile($file);
        if (!empty($advertisement->image))
            $this->advertisement->__deleteImages($advertisement);


        $data['image'] = $fileName;
        $this->advertisement->updateImage($advertisement->id, $data);

    }

}
