@extends('layouts.frontend.app')
@section('content')
    @include('layouts.frontend.page-specific-header')
    <div class="clearfix"></div>
    <!-- Title Header Start -->
    <section class="inner-header-title"
             style="background-image:url({{ asset('resources/frontend/assets/img/bn2.jpg') }});">
        <div class="container">
            <h1>Restriction</h1>
        </div>
    </section>
    <div class="clearfix"></div>
        <section class="how-it-works">
            <div class="container">
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12">
                        <div class="main-heading">
                            <p>Working Process</p>
                            <h2>How It <span>Works</span></h2></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="working-process"><span class="process-img"><img
                                    src="{{asset('resources/frontend/assets/img/step-1.png')}}" class="img-responsive"
                                    alt=""/><span class="process-num">01</span></span>
                            <h4>Register as a Company</h4>
                            <p>Only employers can view this page to select better candidates.Register as employer and find suitable employees.</p>
                            <a href="{{route('signup')}}">Sign up here</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="working-process"><span class="process-img"><img
                                    src="{{asset('resources/frontend/assets/img/step-2.png')}}" class="img-responsive"
                                    alt=""/><span class="process-num">02</span></span>
                            <h4>Search Candidates</h4>
                            <p>Search for a better candidate through our advance search technique to find the right person for the right job.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="working-process"><span class="process-img"><img
                                    src="{{asset('resources/frontend/assets/img/step-3.png')}}" class="img-responsive"
                                    alt=""/><span class="process-num">03</span></span>
                            <h4>Save & Select</h4>
                            <p>Select our special packages for employers to get the perfect candidate for the job.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
{{--    <section class="wp-process home-three">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="main-heading">--}}
{{--                    <p>How We Work</p>--}}
{{--                    <h2>Our Work <span>Process</span></h2></div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-sm-6">--}}
{{--                <div class="work-process">--}}
{{--                    <div class="work-process-icon"><span class="icon-search"></span></div>--}}
{{--                    <div class="work-process-caption">--}}
{{--                        <h4>Search Job</h4>--}}
{{--                        <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="work-process">--}}
{{--                    <div class="work-process-icon"><span class="icon-mobile"></span></div>--}}
{{--                    <div class="work-process-caption">--}}
{{--                        <h4>Find Job</h4>--}}
{{--                        <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="work-process">--}}
{{--                    <div class="work-process-icon"><span class="icon-profile-male"></span></div>--}}
{{--                    <div class="work-process-caption">--}}
{{--                        <h4>Hire Employee</h4>--}}
{{--                        <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 hidden-sm"><img src="assets/img/wp-iphone.png" class="img-responsive" alt=""></div>--}}
{{--            <div class="col-md-4 col-sm-6">--}}
{{--                <div class="work-process">--}}
{{--                    <div class="work-process-icon"><span class="icon-layers"></span></div>--}}
{{--                    <div class="work-process-caption">--}}
{{--                        <h4>Start Work</h4>--}}
{{--                        <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="work-process">--}}
{{--                    <div class="work-process-icon"><span class="icon-wallet"></span></div>--}}
{{--                    <div class="work-process-caption">--}}
{{--                        <h4>Pay Money</h4>--}}
{{--                        <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="work-process">--}}
{{--                    <div class="work-process-icon"><span class="icon-happy"></span></div>--}}
{{--                    <div class="work-process-caption">--}}
{{--                        <h4>Happy</h4>--}}
{{--                        <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="signup-ad-section">--}}
{{--                    <img src="{{asset('resources/frontend/assets/img/sign-up-ad.jpg')}}" alt="">--}}
{{--                    <img src="{{asset('resources/frontend/assets/img/sign-up-ad.jpg')}}" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- Title Header End -->
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('resources/frontend/assets/js/validation/parsley.min.js') }}"></script>
@endsection
