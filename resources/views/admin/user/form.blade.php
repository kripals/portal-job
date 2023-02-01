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
                        <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control"
                               value="{{old('first_name', isset($user->first_name)?$user->first_name:'')}}" required/>
                        <label for="Name">First Name</label>
                        <span id="textarea1-error" class="help-block has-error">{{ $errors->first('first_name') }}</span>
                    </div>
                        </div>
                        <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="middle_name" class="form-control"
                               value="{{old('middle_name', isset($user->middle_name)?$user->middle_name:'')}}"/>
                        <label for="Name">Middle Name</label>
                        <span id="textarea1-error" class="text-danger">{{ $errors->first('middle_name') }}</span>
                    </div>
                        </div>
                        <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control"
                               value="{{old('last_name', isset($user->last_name)?$user->last_name:'')}}" required/>
                        <label for="Name">Last Name</label>
                        <span id="textarea1-error" class="text-danger">{{ $errors->first('last_name') }}</span>
                    </div>
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="username" class="form-control"--}}
{{--                               value="{{old('username', isset($user->username)?$user->username:'')}}" required/>--}}
{{--                        <label for="Username">Username</label>--}}
{{--                        <span id="textarea1-error" class="text-danger">{{ $errors->first('username') }}</span>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <input type="text" name="email" class="form-control"
                               value="{{old('email', isset($user->email)?$user->email:'')}}" required/>
                        <label for="Name">Email</label>
                        <span id="textarea1-error" class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    @if(empty($user->password))
                    <div class="form-group">
                        <input type="password" name="password" class="form-control"
                               value="{{old('password', isset($user->password)?$user->password:'')}}" required/>
                        <label for="Name">Password</label>
                        <span id="textarea1-error" class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control"
                               value="{{old('password_confirmation', isset($user->password_confirmation)?$user->password_confirmation:'')}}" required/>
                        <label for="Name">Confirm Password</label>
                        <span id="textarea1-error" class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                    @endif
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
                                <a class="btn btn-default btn-ink" href="{{ route('user.index') }}">
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
                                           {{ old('status', isset($user->status) ? $user->status : '')=='active' ? 'checked':'' }} data-switchery/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-specific-scripts')
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/admin/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
@endsection
