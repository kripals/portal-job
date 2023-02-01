@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

{!! csrf_field() !!}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card card-underline">
                <div class="card-head">
                    <header>{!! $header !!}</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required value="{{ old('name', isset($testimonial->name) ? $testimonial->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="keywords" class="form-control" required value="{{ old('keywords', isset($testimonial->keywords) ? $testimonial->keywords : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('keywords') }}</span>
                                <label for="KeyWords">KeyWords</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                {{ Form::textarea('description',old('description'),['class' => 'ckeditor']) }}
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('description') }}</span>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="col-sm-12">--}}
                            {{--<strong>Image</strong>--}}
                            {{--@if(isset($testimonial) && $testimonial->image)--}}
                                {{--<input type="file" name="image" class="dropify"--}}
                                       {{--data-default-file="{{ asset($testimonial->image_path) }}" />--}}
                            {{--@else--}}
                                {{--<input type="file" name="image" class="dropify" />--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
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
                                <a class="btn btn-default btn-ink" href="{{ route('testimonial.index') }}">
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
                                           {{ old('status', isset($testimonial->status) ? $testimonial->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Availability</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="availability"
                                           {{ old('status', isset($testimonial->availability) ? $testimonial->availability : '')=='available' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Visibility</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="visibility"
                                           {{ old('status', isset($testimonial->visibility) ? $testimonial->visibility : '')=='visible' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
                {{--            </div><!--end .panel-group -->--}}
                {{--        <div class="panel-group" id="accordion1">--}}
                <div class="card panel">
                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1" data-target="#accordion1-2">
                        <header>Company Logo</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-2" class="collapse">
                        <div class="card-body">
                            <input type="file" name="image" class="dropify"
                                   data-default-file=""/>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
            </div><!--end .panel-group -->
        </div>
    </div>
</div>


@section('page-specific-scripts')
    <!-- common functions -->
    <script src="{{ asset('resources/admin/js/common.js')}}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ asset('resources/admin/js/altair_admin_common.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });
    </script>
@endsection