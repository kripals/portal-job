<!-- Start Navigation -->
<nav class="navbar navbar-default navbar-fixed navbar-light white bootsnav">

    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">

                <img src="{{asset('resources/frontend/assets/img/logo10.png')}}" class="logo logo-scrolled" alt=""
                     style="width: 150px;margin-top:-22px;">
                <!--                    <h2>Legends Zone</h2>-->
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
                <li class="active">
                    <form action="{{route('search')}}">
                        <input type="text" class="form-control" name="search_keyword" placeholder="Search">
                        <input type="hidden" name="search_for" value="job">
                    </form>
                <li>
                    <!--                    <li class="dropdown">-->
                    <a href="{{route('home')}}">Home</a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jobs</a>
                    <ul class="dropdown-menu animated fadeOutUp">
                        <li>
                            <a href="{{route('job.list','nepal')}}">Jobs
                                In Nepal</a>
                            <a href="{{route('job.list','abroad')}}">Jobs
                                Abroad</a>
                        </li>
                        {{--                            <li>--}}
                        {{--                                <a href="{{route('job-detail')}}" class="dropdown-toggle" data-toggle="dropdown">Job Detail</a>--}}
                        {{--                            </li>--}}
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
            </ul>
            @if(auth()->check() == false)
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li><a href="{{route('signup')}}"><i class="fa fa-pencil" aria-hidden="true"></i>SignUp</a></li>
                    <li class="left-br"><a href="{{route('login')}}" class="signin">SignIn</a></li>
                </ul>
            @endif
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
                                <li><a href="{{ route('candidate.profile') }}">User Profile</a></li>
                            @endif
                            @if(auth()->user()->hasRole(['ROLE_COMPANY']))
                                <li><a href="{{ route('company.profile') }}">User Profile</a></li>
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
            @endif
        </div>
    </div>
</nav>
<!-- End Navigation -->
