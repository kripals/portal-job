<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Requests\Admin\Package\PackageRequest;
use App\Modules\Service\Package\PackageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kamaln7\Toastr\Facades\Toastr;

class PackageController extends Controller
{
    protected $package;

    function __construct(PackageService $package)
    {
        $this->package = $package;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
        $packages = $this->package->paginate();
        return view('admin.package.index',compact('packages','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        return view('admin.package.create',compact('type'));
    }
    public function getAllData($type = null)
    {
        return $this->package->getAllData($type);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request,$type = null)
    {
        if($package = $this->package->create($request->all(),$type))
        {
            Toastr::success('Package created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('package.index',$type);
        }
        Toastr::error('Package cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('package.index',$type);
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
    public function edit($type = null,$id)
    {
        $package = $this->package->find($id);
        return view('admin.package.edit',compact('package','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request,$type = null, $id)
    {
        if($this->package->update($id,$request->all()))
        {
            Toastr::success('Package updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('package.index',$type);
        }
        Toastr::error('Package cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('package.index',$type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->package->delete($id))
        {
            Toastr::success('Package deleted successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('package.index',$type);
        }
        Toastr::error('Package cannot be deleted.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
        return redirect()->route('package.index',$type  );
    }
}
