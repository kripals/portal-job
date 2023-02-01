@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/libs/dropify/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/admin/css/bootstrap-datetimepicker.min.css') }}"/>
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" required value="{{ old('title', isset($advertisement->title) ? $advertisement->title : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('title') }}</span>
                                <label for="Title">Title</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="link" class="form-control" required value="{{ old('link', isset($advertisement->link) ? $advertisement->link : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('link') }}</span>
                                <label for="Title">Link</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select name="type" class="form-control select2-list" required>
                                    <option
                                        value="job-list" {{ isset($advertisement->type) ? $advertisement->type == 'job-list' ? 'selected' : '' : '' }}>
                                        Job List (270x275)
                                    </option>
                                    <option
                                        value="candidate-list" {{ isset($advertisement->type) ? $advertisement->type == 'candidate-list' ? 'selected' : '' : '' }}>
                                        Candidate List (270x275)
                                    </option>
                                    <option
                                        value="login" {{ isset($advertisement->type) ? $advertisement->type == 'login' ? 'selected' : '' : '' }}>
                                        Login Page (370x340)
                                    </option>
                                    <option
                                        value="register" {{ isset($advertisement->type) ? $advertisement->type == 'register' ? 'selected' : '' : '' }}>
                                        Register Page (370x340)
                                    </option>
                                </select>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('type') }}</span>
                                <label for="Title">Type</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="expiry" class="form-control datetime" required value="{{ old('expiry', isset($advertisement->expiry) ? $advertisement->expiry : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('expiry') }}</span>
                                <label for="Title">Expiry Date</label>
                            </div>
                        </div>
                    </div>
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
                                <a class="btn btn-default btn-ink" href="{{ route('advertisement.index') }}">
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
                                           {{ old('status', isset($advertisement->status) ? $advertisement->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
                <div class="card panel">
                    <div class="card-head collapsed" data-toggle="collapse" data-parent="#accordion1"
                         data-target="#accordion1-2">
                        <header>Image</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-2" class="collapse">
                        <div class="card-body">
                            @if(isset($advertisement->image))
                                @if(!empty($advertisement->image))
                                    <input type="file" name="image" class="dropify"
                                           data-default-file="{{ asset($advertisement->thumbnail_path) }}"/>
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
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/dropify/dropify.min.js') }}"></script>
    <script src="{{asset('resources/admin/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
            $(".datetime").datetimepicker({format: 'dd M yyyy HH:ii P',autoclose:true});
        });
    </script
@endsection
