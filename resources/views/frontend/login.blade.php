@extends('layouts.frontend.app')

@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>

    <!-- Title Header Start -->
    <section class="inner-header-title" style="background-image:url(assets/img/bn2.jpg);">
        <div class="container">
            <h1>Login</h1>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- Title Header End -->

    <!-- Tab Section Start -->
    <section class="tab-sec gray">
        <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-2 col-md-offset-2">
                <div class="new-logwrap">

                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-with-icon">
                            <input type="text" class="form-control" placeholder="Enter Your Username">
                            <i class="theme-cl ti-user"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-with-icon">
                            <input type="email" class="form-control" placeholder="Enter Your Email">
                            <i class="theme-cl ti-email"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-with-icon">
                            <input type="password" class="form-control" placeholder="Enter Your Password">
                            <i class="theme-cl ti-lock"></i>
                        </div>
                    </div>

                    <!--                <div class="register-account text-center">-->
                    <!--                    By hitting the <span class="theme-cl">"Register"</span> button, you agree to the <a class="theme-cl" href="#">Terms conditions</a> and <a class="theme-cl" href="#">Privacy Policy</a>-->
                    <!--                </div>-->

                    <div class="form-groups">
                        <button type="submit" class="btn btn-primary theme-bg full-width">Login</button>
                    </div>
                    <div class="forget-account text-center">
                        <a class="theme-cl" href="#">Forget Password?</a>
                    </div>
                    <!--                <div class="social-devider">-->
                    <!--                    <span class="line"></span>-->
                    <!--                    <span class="circle">Or</span>-->
                    <!--                </div>-->

                    <!--                <div class="social-login row">-->
                    <!---->
                    <!--                    <div class="col-md-6">-->
                    <!--                        <a href="#" class="jb-btn-icon social-login-facebook"><i class="fa fa-facebook"></i>Facebook</a>-->
                    <!--                    </div>-->
                    <!---->
                    <!--                    <div class="col-md-6">-->
                    <!--                        <a href="#" class="jb-btn-icon social-login-google"><i class="fa fa-google-plus"></i>Google</a>-->
                    <!--                    </div>-->
                    <!---->
                    <!--                    <div class="col-md-6">-->
                    <!--                        <a href="#" class="jb-btn-icon social-login-twitter"><i class="fa fa-twitter"></i>Twitter</a>-->
                    <!--                    </div>-->
                    <!---->
                    <!--                    <div class="col-md-6">-->
                    <!--                        <a href="#" class="jb-btn-icon social-login-linkedin"><i class="fa fa-linkedin"></i>Linkedin</a>-->
                    <!--                    </div>-->
                    <!---->
                    <!--                </div>-->

                </div>
            </div>
        </div>
    </section>
    <!-- Tab section End -->
@endsection