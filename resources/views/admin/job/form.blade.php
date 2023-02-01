@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/admin/css/style_switcher.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/select2/select2.css?1424887856')}}"/>
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/bootstrap-datetimepicker.min.css') }}"/>
@endsection
@csrf
<div class="row">
    <div class="col-md-9">
        <div class="card card-underline">
            <div class="card-head">
                <ul class="nav nav-tabs pull-right" data-toggle="tabs">
                    <li class="active"><a href="#basic">Basic Info</a></li>
                    <li><a href="#specification">Specification</a></li>
                    <li><a href="#description">Description</a></li>
                    <li><a href="#vacancy">Vacancy Settings</a></li>
                </ul>
                <header>{!! $header !!}</header>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="basic">
                    @include('admin.job.partials.basic')
                </div>
                <div class="tab-pane" id="specification">
                    @include('admin.job.partials.specification')
                </div>
                <div class="tab-pane" id="description">
                    @include('admin.job.partials.description')
                </div>
                <div class="tab-pane" id="vacancy">
                    @include('admin.job.partials.vacancy-setting')
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-sidebar" data-spy="affix" data-offset-top="50">
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
                                <a class="btn btn-default btn-ink" href="{{ route('job.index') }}">
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
                                    <input type="checkbox" id="switch_demo_10" name="status"
                                           {{ old('status', isset($job->status) ? $job->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Availability</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_11" name="availability"
                                           {{ old('availability', isset($job->availability) ? $job->availability : '')=='available' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Visibility</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_12" name="visibility"
                                           {{ old('visibility', isset($job->visibility) ? $job->visibility : '')=='visible' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Verified</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_13" name="is_verified"
                                           {{ old('is_verified', isset($job->is_verified) ? $job->is_verified : '')=='yes' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Order</span>
                                </div>
                                <div class="label-body" style="width: 50px">
                                    <input type="number" name="order" min="0" class="form-control" data-rule-number="true"
                                           value="{{ old('order', isset($job->order) ? $job->order : 0) }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
                <div class="card panel">
                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1"
                         data-target="#accordion1-2">
                        <header>Job Image</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-2" class="collapse">
                        <div class="card-body">
                            @if(isset($job->image))
                                @if(!empty($job->image))
                                    <input type="file" name="image" class="dropify"
                                           data-default-file="{{ asset($job->thumbnail_path) }}"/>
                                @else
                                    <input type="file" name="image" class="dropify"/>
                                @endif
                            @else
                                <input type="file" name="image" class="dropify"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!--end .panel-group -->
        </div>
    </div>
</div>
@section('page-specific-scripts')
    <script src="{{asset('resources/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/select2/select2.min.js')}}"></script>
{{--    <script src="{{ asset('resources/admin/js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>--}}
    <script src="{{ asset('resources/admin/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{asset('resources/admin/js/bootstrap-datetimepicker.min.js') }}"></script>
{{--    <script src="{{asset('resources/admin/js/core/demo/DemoFormComponents.js')}}"></script>--}}

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.select2-list').select2();
        });
    </script>
    <script type="text/javascript">
        $(".datetime").datetimepicker({format: 'dd M yyyy HH:ii P',autoclose:true});
    </script>
    <script>
        $(document).ready(function () {
            $('#newspaper').hide();
            $('#apply_procedure').hide();
            $('#jobService').on('change', function () {
                var val = $(this).val();
                if (val == 3) {
                    $('#newspaper').show();
                }else{
                    $('#newspaper').hide();
                }
            })
            $('#online_toggle').on('change', function () {
                if($(this).prop("checked") == false) {
                    $('#apply_procedure').show();
                }else{
                    $('#apply_procedure').hide();
                }
            })
        });

    </script>
@endsection
