
@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/admin/css/style_switcher.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/select2/select2.css?1424887856')}}"/>
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
    <link href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858') }}" rel="stylesheet">
@endsection
@csrf
<div class="row">
    <div class="col-md-9">
        <div class="card card-underline">
            <div class="card-head">
                <ul class="nav nav-tabs pull-right" data-toggle="tabs">
                    <li class="active"><a href="#job">Basic/Job Info</a></li>
                    <li><a href="#education">Educations</a></li>
                    <li><a href="#experience">Experiences</a></li>
                    <li><a href="#training">Trainings</a></li>
                    <li><a href="#reference">References</a></li>
                    <li><a href="#others">Others</a></li>
                </ul>
                <header>{!! $header !!}</header>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="job">
                    @include('admin.candidate.partials.job')
                </div>
                <div class="tab-pane" id="education">
                    @include('admin.candidate.partials.education')
                </div>
                <div class="tab-pane" id="experience">
                    @include('admin.candidate.partials.experience')
                </div>
                <div class="tab-pane" id="training">
                    @include('admin.candidate.partials.training')
                </div>
                <div class="tab-pane" id="reference">
                    @include('admin.candidate.partials.reference')
                </div>
                <div class="tab-pane" id="others">
                    @include('admin.candidate.partials.other')
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
                                <a class="btn btn-default btn-ink" href="{{ route('candidate.index') }}">
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
                                           {{ old('status', isset($candidate->status) ? $candidate->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Availability</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_11" name="availability"
                                           {{ old('status', isset($candidate->availability) ? $candidate->availability : '')=='available' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Top Candidate</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_12" name="visibility"
                                           {{ old('status', isset($candidate->visibility) ? $candidate->visibility : '')=='visible' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Verified</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_13" name="is_verified"
                                           {{ old('status', isset($candidate->is_verified) ? $candidate->is_verified : '')=='yes' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Order</span>
                                </div>
                                <div class="label-body" style="width: 50px">
                                    <input type="number" name="order" min="0" class="form-control" data-rule-number="true"
                                           value="{{ old('order', isset($candidate->order) ? $candidate->order : 0) }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
                <div class="card panel">
                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1"
                         data-target="#accordion1-2">
                        <header>Candidate Resume</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-2" class="collapse">
                        <div class="card-body">
                            @if(isset($candidate->resume))
                                @if(!empty($candidate->resume))
                                    <a href="{{ asset($candidate->resume_path) }}" target="_blank" class="btn btn-info ink-reaction" style="width: 100%;margin-top: -30px;"><i class="md md-description"></i>View Resume</a>
                                    <input type="file" name="resume" class="dropify"
                                           data-default-file="{{ asset($candidate->resume_path) }}"/>
                                @else
                                    <input type="file" name="resume" class="dropify"/>
                                @endif
                            @else
                                <input type="file" name="resume" class="dropify"/>
                            @endif
                        </div>

                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
{{--                <div class="card panel">--}}
{{--                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1"--}}
{{--                         data-target="#accordion1-3">--}}
{{--                        <header>Resume</header>--}}
{{--                        <div class="tools">--}}
{{--                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="accordion1-3" class="collapse">--}}
{{--                        <div class="card-body">--}}
{{--                            <input type="file" name="resume" class="dropify"--}}
{{--                                   data-default-file=""/>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div><!--end .panel-group -->
        </div>
    </div>
</div>
@section('page-specific-scripts')
    <script src="{{asset('resources/admin/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/select2/select2.min.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{asset('resources/admin/js/core/demo/DemoFormComponents.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.select2-list').select2();
        });
    </script>
    <script>
        $(document).on("click", ".createClone", function (e) {
            e.preventDefault();
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // var cloneInput = $('.clonedInput');
            var cloneClass = $(this).data('clone');
            var cloneInput = $(cloneClass);
            var appendTo = $($(this).data('appendto'));
            $.ajax({
                url: '{{route('candidate.cloneFields')}}',
                method: 'post',
                data: {
                    // '_token': CSRF_TOKEN,
                    'div_count': cloneInput.length + 1,
                    'field_name': cloneInput.data('fieldname')
                },
            }).success(function (data) {
                var obj = JSON.parse(data);
                appendTo.after(obj);
            });
        });

        function removedClone(id) {
            // var r = confirm("Are you sure you want to delete?");
            // if (r == true) {
            $(id).remove();
            // }
        }
    </script>
    <script>
            $(document).on('change','.ifCheck',function(e){
                e.preventDefault();
                var hide = $(this).data('hide');
                if(this.checked)
                    $(hide).fadeOut('slow');
                else
                    $(hide).fadeIn('slow');
            });

            $(document).on('change','.expSalType',function(e){
                var typeVal = $(this).val();
                var curType = $('.curSalType');
                // alert(curType.val());
                if(typeVal == 'above'){
                    $('.curSalType').val('below');
                }
            });
    </script>
@endsection
