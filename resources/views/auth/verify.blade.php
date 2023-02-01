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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a
                            href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Section Start -->
    <section class="tab-sec gray">
        <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">
                <div class="new-logwrap">
                    <form action="{{route('login')}}" method="post" data-parsley-validate="">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-with-icon">
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="Enter Registered Email Address"
                                       required autocomplete="email" autofocus>
                                <i class="theme-cl ti-email"></i>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-with-icon">
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Enter Your Password"
                                       data-parsley-minlength="8" required autocomplete="current-password">
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
                    <div class="forget-account text-center">
                        <a class="theme-cl" href="{{ route('password.request') }}">Forgot Password?</a>
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
        </div>
    </section>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
