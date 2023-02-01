<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i
                class="fa fa-bars"></i></button>
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{asset('resources/frontend/assets/img/logo9.png')}}" class="logo logo-display" alt=""
                     style="width:150px;">

                <img src="{{asset('resources/frontend/assets/img/logo9.png')}}" class="logo logo-scrolled" alt=""
                     style="width:130px;margin-top:-11px;">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            @if(auth()->check())
                <ul class="nav navbar-nav navbar-right header-nav-profile" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle ink-reaction " data-toggle="dropdown">
                            @if(auth()->user()->hasRole(['ROLE_COMPANY']))
                                <img src="{{asset(auth()->user()->company()->first()->thumbnail_path)}}" alt=""
                                     style="width: 30px;border-radius: 50%"/>
                            @endif
                            @if(auth()->user()->hasRole(['ROLE_CANDIDATE']))
                                <img src="{{asset(auth()->user()->thumbnail_path)}}" alt=""
                                     style="width: 30px;border-radius: 50%"/>
                            @endif
                            <span class="profile-info">
                                @if(auth()->user()->hasRole(['ROLE_COMPANY']))
                                    <small>{{ auth()->user()->company()->first()->company_name }}</small>
                                @endif
                                @if(auth()->user()->hasRole(['ROLE_CANDIDATE']))
                                    <small>{{ auth()->user()->full_name }}</small>
                                @endif
						</span>
                        </a>
                        <ul class="dropdown-menu animation-dock">
                            @if (auth()->user()->hasRole(['ROLE_CANDIDATE']))
                                <li><a href="{{ route('candidate.dashboard') }}">Dashboard</a></li>
                            @endif
                            @if(auth()->user()->hasRole(['ROLE_COMPANY']))
                                <li><a href="{{ route('company.dashboard') }}">Dashboard</a></li>
                            @endif
                            {{--                            <li>--}}
                            {{--                                <a href="#">Site Setting</a>--}}
                            {{--                            </li>--}}
                            <li><a href="{{route('logout')}}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="signin">
                                    <i class="fa fa-fw fa-power-off text-danger"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @method('POST')
                                    @csrf
                                </form>
                            </li>
                        </ul><!--end .dropdown-menu -->
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li><a href="{{route('signup')}}"><i class="fa fa-pencil" aria-hidden="true"></i>SignUp</a></li>
                    <li class="left-br"><a href="{{route('login')}}" class="signin">SignIn</a></li>
                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                <li>
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobs</a>
                    <ul class="dropdown-menu animated fadeOutUp">
                        <li>
                            <!--                            <li class="dropdown">-->
                            <a href="{{route('job.list','nepal')}}">Jobs
                                In Nepal</a>
                            <a href="{{route('job.list','abroad')}}">Jobs
                                Abroad</a>
                        </li>
                        {{--                        <li>--}}
                        {{--                            <a href="{{route('job-detail')}}" class="dropdown-toggle" data-toggle="dropdown">Job--}}
                        {{--                                Detail</a>--}}
                        {{--                        </li>--}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Candidates</a>
                    <ul class="dropdown-menu animated fadeOutUp">
                        <li>
                            <a href="{{route('candidate.list','nepal')}}">Candidates in Nepal</a>
                            <a href="{{route('candidate.list','abroad')}}">Candidates Abroad</a>
                        </li>
                    </ul>
                </li>
                {{--                <li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse</a>--}}
                {{--                    <ul class="dropdown-menu megamenu-content" role="menu">--}}
                {{--                        <li>--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-menu col-md-4">--}}
                {{--                                    <h6 class="title">Main Pages</h6>--}}
                {{--                                    <div class="content">--}}
                {{--                                        <ul class="menu-col">--}}
                {{--                                            <li><a href="{{route('page.login')}}">New Login</a></li>--}}
                {{--                                            <li><a href="#">Search Job</a></li>--}}
                {{--                                            <li><a href="{{route('blog')}}">Blog</a></li>--}}
                {{--                                            <li><a href="{{route('pricing')}}">Pricing</a></li>--}}
                {{--                                        </ul>--}}
                {{--                                    </div>--}}
                {{--                                </div><!-- end col-3 -->--}}
                {{--                                <div class="col-menu col-md-4">--}}
                {{--                                    <h6 class="title">For Candidate</h6>--}}
                {{--                                    <div class="content">--}}
                {{--                                        <ul class="menu-col">--}}
                {{--                                            <li><a href="{{route('candidate.dashboard')}}">Candidate Dashboard</a></li>--}}
                {{--                                            <li><a href="{{route('browse-candidate-list')}}">Browse Candidates</a></li>--}}
                {{--                                            <li><a href="{{route('candidate.list')}}">Candidate List</a></li>--}}
                {{--                                            --}}{{--                                            <li><a href="{{route('candidate-detail')}}">Top Candidate detail</a></li>--}}
                {{--                                        </ul>--}}
                {{--                                    </div>--}}
                {{--                                </div><!-- end col-3 -->--}}
                {{--                                <div class="col-menu col-md-4">--}}
                {{--                                    <h6 class="title">For Employer</h6>--}}
                {{--                                    <div class="content">--}}
                {{--                                        <ul class="menu-col">--}}
                {{--                                            <li><a href="{{route('company.dashboard')}}">Employer Dashboard</a></li>--}}
                {{--                                            --}}{{--                                            <li><a href="{{asset('company-detail')}}">Company Detail</a></li>--}}
                {{--                                            --}}{{--                                            <li><a href="{{route('company.job.create')}}">Create Job</a></li>--}}
                {{--                                            --}}{{--                                            <li><a href="{{route('create-company')}}">Create Company</a></li>--}}
                {{--                                            <li><a href="{{route('company.listing')}}">Company List</a></li>--}}
                {{--                                            <li><a href="{{route('contact')}}">Get in Touch</a></li>--}}
                {{--                                        </ul>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>

{{--                <li class="dropdown megamenu-fw"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Browse</a>--}}
{{--                    <ul class="dropdown-menu megamenu-content" role="menu">--}}
{{--                        <li>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-menu col-md-4">--}}
{{--                                    <h6 class="title">Main Pages</h6>--}}
{{--                                    <div class="content">--}}
{{--                                        <ul class="menu-col">--}}
{{--                                            <li><a href="{{route('page.login')}}">New Login</a></li>--}}
{{--                                            <li><a href="#">Search Job</a></li>--}}
{{--                                            <li><a href="{{route('blog')}}">Blog</a></li>--}}
{{--                                            <li><a href="{{route('pricing')}}">Pricing</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div><!-- end col-3 -->--}}
{{--                                <div class="col-menu col-md-4">--}}
{{--                                    <h6 class="title">For Candidate</h6>--}}
{{--                                    <div class="content">--}}
{{--                                        <ul class="menu-col">--}}
{{--                                            <li><a href="{{route('candidate.dashboard')}}">Candidate Dashboard</a></li>--}}
{{--                                            <li><a href="{{route('browse-candidate-list')}}">Browse Candidates</a></li>--}}
{{--                                            <li><a href="{{route('candidate-list')}}">Candidate List</a></li>--}}
{{--                                            <li><a href="{{route('candidate-detail')}}">Top Candidate detail</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div><!-- end col-3 -->--}}
{{--                                <div class="col-menu col-md-4">--}}
{{--                                    <h6 class="title">For Employer</h6>--}}
{{--                                    <div class="content">--}}
{{--                                        <ul class="menu-col">--}}
{{--                                            <li><a href="{{route('company.dashboard')}}">Employer Dashboard</a></li>--}}
{{--                                            <li><a href="{{asset('company-detail')}}">Company Detail</a></li>--}}
{{--                                            <li><a href="{{route('create.job')}}">Create Job</a></li>--}}
{{--                                            <li><a href="{{route('create-company')}}">Create Company</a></li>--}}
{{--                                            <li><a href="{{route('company-listing')}}">Company List</a></li>--}}
{{--                                            <li><a href="{{route('contact')}}">Get in Touch</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


{{--                            </div><!-- end row -->--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

<!-- End Navigation -->
