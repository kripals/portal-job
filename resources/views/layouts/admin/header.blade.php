{{--<!-- BEGIN HEADER-->--}}
<header id="header" >
    <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand" >
                    <div class="brand-holder">
                        <a href="#">
                            <span class="text-lg text-bold text-primary"><img src="{{asset('resources/frontend/assets/img/logo10.png/')}}" alt=""></span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="headerbar-right">
            <ul class="header-nav header-nav-profile">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <img src="{{asset('images/site-logo.jpg')}}" alt="" />
                        <span class="profile-info">
							{{config('app.name')}}
							<small>Administrator</small>
						</span>
                    </a>
                    <ul class="dropdown-menu animation-dock">

                        <li><a href="#">User Profile</a></li>
                        <li><a href="#">Site Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('admin.logout')}}"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
                    </ul><!--end .dropdown-menu -->
                </li><!--end .dropdown -->
            </ul><!--end .header-nav-edit-profile -->
        </div><!--end #header-navbar-collapse -->
    </div>
</header>
{{--<!-- END HEADER-->--}}


<!-- BEGIN HEADER-->
<header id="header" >
    <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand" >
                    <div class="brand-holder">
                        <a href="#">
                            <span class="text-lg text-bold text-primary"><img src="{{asset('resources/frontend/assets/img/logo10.png/')}}" alt=""></span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="headerbar-right">
            <ul class="header-nav header-nav-profile">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <img src="{{asset(auth()->user()->thumbnail_path)}}" alt="" />
                        <span class="profile-info">
							{{auth()->user()->full_name}}
							<small>Administrator</small>
						</span>
                    </a>
                    <ul class="dropdown-menu animation-dock">

                        <li><a href="#">User Profile</a></li>
{{--                        <li><a href="{{route('sitesetting.index')}}">Site Setting</a></li>--}}
                        <li class="divider"></li>
                        <li><a href="{{route('admin.logout')}}"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
                    </ul><!--end .dropdown-menu -->
                </li><!--end .dropdown -->
            </ul><!--end .header-nav-edit-profile -->
        </div><!--end #header-navbar-collapse -->
    </div>
</header>
<!-- END HEADER-->




