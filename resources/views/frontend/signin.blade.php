@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.page-specific-header')
    <!-- End Navigation -->
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url({{ asset('resources/frontend/assets/img/bn2.jpg') }});">
        <div class="container">
            <h1>Login</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Tab Section Start -->
    <section class="tab-sec gray">
        <div class="container">
{{--            <div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">--}}
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="new-logwrap">
                    <ul class="nav modern-tabs nav-tabs theme-bg" id="simple-design-tab">
                        <li class="active"><a href="#candidate">Candidate</a></li>
                        <li><a href="#employer">Employer/Agent</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="candidate" class="tab-pane fade in active">
                    <form action="{{route('user.signin')}}" method="post" data-parsley-validate="">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-with-icon">
                                <input type="email" name="email" class="form-control" placeholder="Enter Registered Email Adderss"
                                       required>
                                <i class="theme-cl ti-email"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $errors->first('email') }}</p>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="password" class="form-control" placeholder="Enter Your Password"
                                       data-parsley-minlength="8" required>
                                <i class="theme-cl ti-lock"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <p>{{ $errors->first('password') }}</p>
                                    </span>
                            @endif
                        </div>

                        <div class="form-groups">
                            <button type="submit" class="btn btn-primary theme-bg full-width">Sign In</button>
                        </div>
                    </form>
                        </div>
                    <div class="social-devider">
                        <span class="line"></span>
                        <span class="circle">Or</span>
                    </div>
                    <div class="social-login row">
                        <div class="col-md-12">
                            <a href="{{route('signup')}}" class="btn btn-info full-width"><i class="fa fa-pencil"></i>Create
                                An Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="signup-ad-section">
                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-2.jpg')}}" width="370" height="340" alt="">
                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-6.jpg')}}" width="370" height="340" alt="">
                    <img src="{{asset('resources/frontend/assets/img/job-list-ad-5.jpg')}}" width="370" height="340" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Tab section End -->
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
