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
                        <div id="candidate" class="tab-pane fade in active">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form action="{{ route('password.email') }}" method="post" data-parsley-validate="">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="input-with-icon">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter Registered Email Address"
                                               required autocomplete="email" autofocus>
                                        <i class="theme-cl ti-email"></i>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-groups">
                                    <button type="submit" class="btn btn-primary theme-bg full-width">Send Password Reset Link</button>
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
                    <a href="https://dtechtrading.com" target="_blank"><img src="{{asset('resources/frontend/assets/img/sign-in-ad-2.jpg')}}" width="370" height="340" alt=""></a>
                    <img src="{{asset('resources/frontend/assets/img/sign-in-ad-1.jpg')}}" width="370" height="340" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Tab section End -->
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
