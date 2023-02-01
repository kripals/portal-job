@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/admin/css/style_switcher.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/select2/select2.css?1424887856')}}"/>
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf

<div class="row">
    <div class="col-md-9">
        <div class="card card-underline">
            <div class="card-head">
                <ul class="nav nav-tabs pull-right" data-toggle="tabs">
                    <li class="active"><a href="#basic">Basic Info</a></li>
                    <li><a href="#contact_details">Contact Details</a></li>
                    <li><a href="#contact_persons">Contact Persons</a></li>
                    <li><a href="#social_accounts">Social Accounts</a></li>
                    <li><a href="#others">Others</a></li>
                </ul>
                <header>{!! $header !!}</header>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="basic">
                    @include('admin.company.partials.basic')
                </div>
                <div class="tab-pane" id="contact_details">
                    @include('admin.company.partials.contact-details')
                </div>
                <div class="tab-pane" id="contact_persons">
                    @include('admin.company.partials.contact-person')
                </div>
                <div class="tab-pane" id="social_accounts">
                    @include('admin.company.partials.social-accounts')
                </div>
                <div class="tab-pane" id="others">
                    @include('admin.company.partials.others')
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
                                <a class="btn btn-default btn-ink" href="{{ route('company.index') }}">
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
                                           {{ old('status', isset($company->status) ? $company->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Availability</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="availability"
                                           {{ old('availability', isset($company->availability) ? $company->availability : '')=='available' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Top Company</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="visibility"
                                           {{ old('visibility', isset($company->visibility) ? $company->visibility : '')=='visible' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Verified</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="is_verified"
                                           {{ old('is_verified', isset($company->is_verified) ? $company->is_verified : '')=='yes' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Order</span>
                                </div>
                                <div class="label-body" style="width: 50px">
                                    <input type="number" name="order" min="0" class="form-control" data-rule-number="true"
                                           value="{{ old('order', isset($company->order) ? $company->order : 0) }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
                <div class="card panel">
                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1"
                         data-target="#accordion1-2">
                        <header>Company Logo</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-2" class="collapse">
                        <div class="card-body">
                            @if(isset($company->image))
                                @if(!empty($company->image))
                                    <input type="file" name="image" class="dropify"
                                           data-default-file="{{ asset($company->image_path) }}"/>
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
    <script src="{{ asset('resources/admin/js/libs/select2/select2.min.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
            $('.select2-list').select2();
        });
    </script>
    <script>
        $(document).on("click", ".createClone", function (e) {
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            // var cloneInput = $('.clonedInput');
            var cloneClass = $(this).data('clone');
            var cloneInput = $(cloneClass);
            var appendTo = $($(this).data('appendto'));
            $.ajax({
                url: '{{route('company.cloneFields')}}',
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
@endsection
