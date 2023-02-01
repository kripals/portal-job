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
                        @if($type == 'job')
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select class="form-control select2-list" name="display_type"
                                        data-placeholder="Select industry" required>
                                        <option
                                            value="top-job" {{ isset($package->display_type) ? $package->display_type == 'top-job' ? 'selected' : '' : '' }}>Top Job</option>
                                        <option
                                            value="hot-job" {{ isset($package->display_type) ? $package->display_type == 'hot-job' ? 'selected' : '' : '' }}>Hot Job</option>
                                        <option
                                            value="notice" {{ isset($package->display_type) ? $package->display_type == 'notice' ? 'selected' : '' : '' }}>Notice</option>
                                </select>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('display_type') }}</span>
                                <label for="Title">Display Type</label>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" required value="{{ old('title', isset($package->title) ? $package->title : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('title') }}</span>
                                <label for="Title">Package Title</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" name="quantity" class="form-control" min="0" required value="{{ old('quantity', isset($package->quantity) ? $package->quantity : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('quantity') }}</span>
                                @if($type == 'job')
                                <label for="Title">No. of Days</label>
                                    @endif
                                @if($type == 'resume')
                                    <label for="Title">No. of CV</label>
                                    @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" name="rate" class="form-control" min="0" required value="{{ old('rate', isset($package->rate) ? $package->rate : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('rate') }}</span>
                                <label for="Title">Rate</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="number" name="expiry" class="form-control" min="0" value="{{ old('expiry', isset($package->expiry) ? $package->expiry : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('expiry') }}</span>
                                <label for="Title">Expires After</label>
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
                                <a class="btn btn-default btn-ink" href="{{ route('job-level.index',$type) }}">
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
                                           {{ old('status', isset($package->status) ? $package->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                        </div>
                        <div class="card-head">
                            <div class="side-label">
                                <div class="label-head">
                                    <span>Visibility</span>
                                </div>
                                <div class="label-body">
                                    <input type="checkbox" id="switch_demo_1" name="visibility"
                                           {{ old('visibility', isset($package->visibility) ? $package->visibility : '')=='visible' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end .panel --><!--end .panel --><!--end .panel --><!--end .panel -->
            </div><!--end .panel-group -->
        </div>
    </div>
</div>
@section('page-specific-scripts')
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection

