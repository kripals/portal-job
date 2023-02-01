@section('page-specific-styles')
    <link href="{{ asset('resources/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

{!! csrf_field() !!}
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <input type="text" name="name" class="form-control" required value="{{ old('name', isset($language->name) ? $language->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Title">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="reading" class="form-control" required value="{{ old('reading', isset($language->reading) ? $language->reading : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('reading') }}</span>
                                <label for="Title">Reading</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="writing" class="form-control" required value="{{ old('writing', isset($language->writing) ? $language->writing : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('writing') }}</span>
                                <label for="Title">Writing</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="speaking" class="form-control" required value="{{ old('speaking', isset($language->speaking) ? $language->speaking : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('speaking') }}</span>
                                <label for="Title">Speaking</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="listening" class="form-control" required value="{{ old('listening', isset($language->listening) ? $language->listening : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('listening') }}</span>
                                <label for="Title">Listening</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-actionbar page-bar">
                <div class="card-actionbar-row">
                    <a class="btn btn-default btn-ink" href="{{ route('language.index') }}">
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
                        <input type="checkbox" name="status" data-toggle="toggle" data-on="Active" data-off="Inactive"
                               data-onstyle="success"
                               data-offstyle="warning" {{ old('status', isset($language->status) ? $language->status : '')=='active' ? 'checked':'' }}>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('page-specific-scripts')
    <script src="{{ asset('resources/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
@endsection

