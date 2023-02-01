@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header>{!! $header !!}</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required value="{{ old('name', isset($category->name) ? $category->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="keywords" data-role="tagsinput"
                                       value="{{ old('keywords', isset($category->keywords) ? $category->keywords : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('keywords') }}</span>
                                <label for="specialization">Keywords</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                <textarea name="description" id="" class="ckeditor">{{old('description',isset($category->description)?$category->description : '')}}</textarea>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="" data-spy="affix" data-offset-top="50">
            <div class="panel-group" id="accordion1">
                <div class="card panel expanded">
                    <div class="card-head" data-toggle="collapse" data-parent="#accordion1" data-target="#accordion1-1">
                        <header>Publish</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-1" class="collapse in">
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a class="btn btn-default btn-ink" href="{{ route('category.index',$type) }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-info ink-reaction" value="Save">
                            </div>
                        </div>
                        <div class="card-head">
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Status</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="status"
                                           {{ old('status', isset($category->status) ? $category->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Availability</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="availability"
                                           {{ old('status', isset($category->availability) ? $category->availability : '')=='available' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Featured</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="visibility"
                                           {{ old('status', isset($category->visibility) ? $category->visibility : '')=='visible' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
{{--                            <div class="side-label">--}}
{{--                                <div class="label-head">--}}
{{--                                    <span>Subcategories</span>--}}
{{--                                </div>--}}
{{--                                <div class="label-body">--}}
{{--                                    <input type="checkbox" id="switch_demo_1" name="has_subcategory"--}}
{{--                                           {{ old('status', isset($category->has_subcategory) ? $category->has_subcategory : '')=='yes' ? 'checked':'' }} data-switchery/>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
                {{--            </div><!--end .panel-group -->--}}
                {{--        <div class="panel-group" id="accordion1">--}}
                <div class="card panel">
                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#accordion1-2">
                        <header>Category Image</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-2" class="collapse">
                        <div class="card-body">
                            @if(isset($category->image))
                                @if(!empty($category->image))
                                    <input type="file" name="image" class="dropify"
                                           data-default-file="{{ asset($category->thumbnail_path) }}"/>
                                @else
                                    <input type="file" name="image" class="dropify"/>
                                @endif
                            @else
                                <input type="file" name="image" class="dropify"/>
                            @endif
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
            </div><!--end .panel-group -->
        </div>
    </div>
    </div>


@section('page-specific-scripts')
    <script src="{{asset('resources/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection
